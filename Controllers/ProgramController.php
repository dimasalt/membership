<?php

namespace Membership\Controllers;

use Membership\Helpers\AccountHelper;
use Membership\Helpers\ProgramHelper;
use Membership\Libraries;

use Aws\S3\S3Client;
use Aws\CloudFront\CloudFrontClient;


class ProgramController extends BaseController
{
    /******************************************************
     * //              main product page
     *******************************************************/
    public function Index($request, $response, $args)
    {
        $program_id = $args['program_id'];
        $has_access = false;
        $is_admin = false;

        //get program information
        $progHelper = new ProgramHelper();
        $program_info = $progHelper->getProgramInfoById($program_id);


        //if program is free program
        if ($program_info['is_free'] == 1) {
            $program_categories = $progHelper->getProgramItems($program_id);
            return $this->getView()->render('Program/index.twig', array(
                'program_categories' => $program_categories,
                'program_info' => $program_info
            ));
        }

        //if user logged in, belongs to program or is admin
        if (isset($_SESSION['token']) && isset($_COOKIE['token'])) {
            $acHelper = new AccountHelper();
            $user = $acHelper->getUserByToken($_SESSION['token']);

            $is_admin = $acHelper->is_inRole($user['user_id'], 'admin');
            $has_access = $progHelper->is_UserInProgram($user['user_id'], $program_id);

            //check if user has access to program and if yes get the program items
            if ($has_access || $is_admin) {

                //write member actions logs
                $logger = new Libraries\LoggingLibrary();
                $logger->LogMemberAction('Program page', 'Visited program: ' . $program_info["name"]);

                //get categories to display
                $program_categories = $progHelper->getProgramItems($program_id);
                return $this->getView()->render('Program/index.twig', array(
                    'program_categories' => $program_categories,
                    'program_info' => $program_info
                ));
            }
        }

        if($has_access == false && $is_admin == false) {
            return $response->withRedirect($program_info["sales_url"]);
        }

        //return $response->withRedirect('/login');

        //if nothing of the above is true
        //        return $this->getView()->render('Program/index.twig', array(
        //            'program_info' => $program_info
        //        ));
    }


    /******************************************
     *          display specific video
     * *****************************************/
    public function DisplayItem($request, $response, $args)
    {
//        $config = include CONFIG_URL;

        //get variable
        $program_id = $args['program_id'];
        $item_id = $args['item_id'];


        //get program information
        $progHelper = new ProgramHelper();

        $program_info = $progHelper->getProgramInfoById($program_id);
        $program_item = $progHelper->getSpecificItem($item_id);

        //get signed cloudfront url
        $aws = new Libraries\AmazonAWSLibrary();
        $program_item['url'] = $aws->getSignedUrlCannedPolicy($program_item['folder'], $program_item['file']);

        //get signed S3 url
        foreach ($program_item['files'] as &$file_item)
            $file_item['url'] = $aws->getS3SignedUrl($file_item['folder'], $file_item['file']);

        //var_dump($program_item['files']);

//        /***
//         * Add cloudfront to main display item
//         */
//        $cloudFront = new CloudFrontClient([
//            'region'  => 'us-east-1',
//            'version' => '2014-11-06'
//        ]);
//
//        // Setup parameter values for the resource
//        $streamHostUrl = $config['aws_cloudfront']['url'];
//        $resourceKey = $program_item['folder'] . '/' . $program_item['file'];
//        $expires = time() + 30 * 60;
//
//        // Create a signed URL for the resource using the canned policy
//        $signedUrlCannedPolicy = $cloudFront->getSignedUrl([
//            'url'         => $streamHostUrl . '/' . $resourceKey,
//            'expires'     => $expires,
//            'private_key' =>  $config['aws_cloudfront']['private_key'],
//            'key_pair_id' => $config['aws_cloudfront']['key_pair_id']
//        ]);

//        $program_item['url'] = $signedUrlCannedPolicy;


        //write member actions logs
        $logger = new Libraries\LoggingLibrary();
        $logger->LogMemberAction('Program page', 'Visited program: ' . $program_info["name"] . ', item: ' . $program_item["name"]);

        return $this->getView()->render('Program/item.twig', array(
            'program_info' => $program_info,
            'program_item' => $program_item
        ));
    }


    /******************************************************
     *              download item attachment
     * ***************************************************/
//    public function DownloadFile($request, $response, $args)
//    {
//        $config = include CONFIG_URL;
//
////        $program_id = $args['program_id'];
////        $file_id = $args['file_id'];
//        $request_args = json_decode( file_get_contents('php://input') );
//        $file_id = $request_args->id;
//
//        $progHeler = new ProgramHelper();
//        $file_item = $progHeler->getDownloadFile($file_id);//
//
//
//        /***
//         * Add S3 for file download
//         */
//        $s3Client = new S3Client([
//            'version'     => '2006-03-01',
//            'region'      => 'us-east-1',
//            'credentials' => [
//                'key'    => $config['aws_s3']['key'],
//                'secret' => $config['aws_s3']['secret']
//            ]
//        ]);
//
//        $cmd = $s3Client->getCommand('GetObject', [
//            'Bucket' => $config['aws_s3']['bucket'],
//            'Key'    => $file_item['folder'] .'/'. $file_item['file']
//        ]);
//
//        $url = $s3Client->createPresignedRequest($cmd, '+1 minutes');
//
//        $presignedUrl = (string) $url->getUri();
//
//        //write member actions logs
//        $logger = new Libraries\LoggingLibrary();
//        $logger->LogMemberAction('File Download', 'downloaded file: ' . $file_item["name"]);
//
//        $data = array('url' => $presignedUrl);
//        return $response->withJson($data, 200);
//
////        header("Content-Type: application/octet-stream");
////        header("Content-Disposition: attachment; filename=" . $file_item['name']);
////        readfile($presignedUrl);
//
////----------------------------------------------------------------------------------------------
//
////        $fp = fopen($presignedUrl, 'rb');
////
////        header("Content-Type: application/octet-stream");
////        header("Content-Disposition: attachment; filename=" . $file_item['name']);
////        header("Content-Length: " . filesize($presignedUrl));
////
////        fpassthru($fp);
//
//    }
}
