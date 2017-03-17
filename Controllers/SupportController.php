<?php

namespace Membership\Controllers;

use Membership\Helpers\AccountHelper;
use Membership\Helpers\EmailHelper;
use Membership\Libraries;

class SupportController extends BaseController
{
    /**
     * ------------------------------------------------------
     * Support main page
     * if user logged in then it will use his email
     * ------------------------------------------------------
     */
    public function Index($request, $response, $args)
    {
        //set up csrf and it has to be new on each page load
        if (isset($_SESSION['csrf'])) unset($_SESSION['csrf']);
        $csrf = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $csrf;

        //if user logged in then get its email
        $email = '';
        if(isset($_SESSION['token']) && isset($_COOKIE['token']))
        {
            $acHelper = new AccountHelper();
            $user = $acHelper->getUserByToken($_SESSION['token']);

            $email = $user['email'];

            //write member actions logs
            $logger = new Libraries\LoggingLibrary();
            $logger->LogMemberAction('Support Page', 'visit');
        }

        return $this->getView()->render('Home/contact.twig', array('csrf' => $csrf, 'email' => $email));
    }

    /**
     * ------------------------------------------------------
     * Send support email message
     * ------------------------------------------------------
     */
    public function SendSupportMessage($request, $response, $args)
    {
        $request_args = json_decode( file_get_contents('php://input') );
        $name = $request_args->name;
        $email = $request_args->email;
        $subject = $request_args->subject;
        $message = $request_args->message;
        
        $email_from = $this->config['mail']['from'];

        //send email functionality
        $emHelper = new EmailHelper();
        $subject = $subject;

        //html body
        $body = $message . '<br /><br />from: ' . $name . '<br />Email: ' .$email;
        //plain text body
        $body_text = '';

        if($emHelper->SendEmail($subject, $body, $body_text, $email_from))
            return $response->withJson(array('is_success' => true, 'message' =>  'Great! Your message has been sent. Thank you'), 200);
        else return $response->withJson(array('is_success' => false, 'message' =>  'Ops! Something went wrong on our side of things. <br /> We have logged the issue and will investigate it right away.'), 200);
    }
}