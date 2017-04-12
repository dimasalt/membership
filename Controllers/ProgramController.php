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
        if($this->isUserLoggedIn())
        {
            $user = $this->getUser();

            var_dump($user);

            $acHelper = new AccountHelper();
            $is_admin = $acHelper->is_inRole($user->user_id, 'admin');
            $has_access = $progHelper->is_UserInProgram($user->user_id, $program_id);

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


        //write member actions logs
        $logger = new Libraries\LoggingLibrary();
        $logger->LogMemberAction('Program page', 'Visited program: ' . $program_info["name"] . ', item: ' . $program_item["name"]);

        return $this->getView()->render('Program/item.twig', array(
            'program_info' => $program_info,
            'program_item' => $program_item
        ));
    }
}
