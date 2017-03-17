<?php
/**
 * ---------------------------------------------
 * Creates S3 signed links and CloudFront signed Links
 */

namespace Membership\Libraries;

use Aws\S3\S3Client;
use Aws\CloudFront\CloudFrontClient;

class AmazonAWSLibrary
{
    private $s3Client;
    private $cloudFront;

    //get cloudfront signed URL
    public function getSignedUrlCannedPolicy($folder, $file)
    {
        $config = include CONFIG_URL;


        //if cloudfront client not set then set it
        if(!isset($this->cloudFront))
            $this->setCloudFront();

        // Setup parameter values for the resource
        $streamHostUrl = $config['aws_cloudfront']['url'];

        //create full path to the file
        if(!is_null($folder) && !empty($folder))
            $resourceKey = $folder .'/'. $file;
        else $resourceKey = $file;

        $expires = time() + 60 * 60;

        // Create a signed URL for the resource using the canned policy
        $signedUrlCannedPolicy = $this->cloudFront->getSignedUrl([
            'url'         => $streamHostUrl . '/' . $resourceKey,
            'expires'     => $expires,
            'private_key' =>  $config['aws_cloudfront']['private_key'],
            'key_pair_id' => $config['aws_cloudfront']['key_pair_id']
        ]);

        return $signedUrlCannedPolicy;
    }

    //get S3 signed url
    public function getS3SignedUrl($folder, $file)
    {
        $config = include CONFIG_URL;

        //check if s3 client is set
        if(!isset($this->s3Client))
            $this->setS3Client();

        //create full path to the file
        if(!is_null($folder) && !empty($folder))
            $key = $folder .'/'. $file;
        else $key = $file;


        $cmd = $this->s3Client->getCommand('GetObject', [
            'Bucket' => $config['aws_s3']['bucket'],
            'Key'    => $key
        ]);

        $url = $this->s3Client->createPresignedRequest($cmd, '+60 minutes');
        $presignedUrl = (string) $url->getUri();

        return $presignedUrl;

        //return $this->getView()->render('Account/index.twig', array('login_page' => true));
    }



    /***
     * --------------------------------------------------------
     *              HELPERS
     * -------------------------------------------------------
     */
    private function setS3Client()
    {
        $config = include CONFIG_URL;

        $this->s3Client = new S3Client([
            'version'     => '2006-03-01',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => $config['aws_s3']['key'],
                'secret' => $config['aws_s3']['secret']
            ]
        ]);
    }


    private function setCloudFront(){
        $this->cloudFront = new CloudFrontClient([
            'region'  => 'us-east-1',
            'version' => '2014-11-06'
        ]);
    }
}