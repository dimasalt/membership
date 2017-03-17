<?php

namespace Membership\Controllers;

use Membership\Helpers;

class AdminMembersController extends BaseController
{
    //main login page
    public function Index($request, $response, $args)
    {
        return $this->getView()->render('Admin/members.twig');
    }


    /**
     * --------------------------------------------------
     *      add new user from admin panel
     * -------------------------------------------------*/
    public function AddUser($request, $response, $args)
    {
        //if form has been submited
        if(isset($_POST['submituser']))
        {
            //$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, array('options' => array('default' => '')));
            $email = $_POST['email'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $password = $_POST['password'];

            
            //if password is defined
            if(strlen($password) > 0)
            {
                $password = bin2hex(random_bytes(8)); //random string
                $hashed_password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
            }

            //add new member
            $acHelper = new Helpers\AccountHelper();
            $acHelper->CreateNewUser($email, $hashed_password, 'member', $fname, $lname);

            //if inform user is checked
            if(isset($_POST['chk_inform']) && $_POST['chk_inform']==='inform')
            {
                //send email functionality
                $emHelper = new Helpers\EmailHelper();
                $subject = "Welcome to membership website";

                //html body
                $body = "Hello dear member <br /><br />"
                    . "You have been added to http://www.memberstr.com membership website.<br/><br/>"
                    . "You can now login using following credentials: <br /><br />"
                    . "UserName: " . $email . "<br />"
                    . "password: " . $password . "<br /><br />"
                    . "Better Life Membership Team";

                //plain text body
                $body_text = "Hello dear member \r\n\r\n"
                    . "You have been added to http://www.memberstr.com membership website \r\n\r\n"
                    . "You can now login using following credentials: \r\n\r\n"
                    . "UserName: " . $email . "\r\n\r\n"
                    . "password: " . $password . "\r\n\r\n"
                    . "Better Life Membership Team";

                if($emHelper->SendEmail($subject, $body, $body_text, $email))
                    return $response->withJson(array('is_success' => true, 'message' =>  'Great! A new password has been sent to your email.'), 200);
                else return $response->withJson(array('is_success' => false, 'message' =>  'Ops! Something went wrong on our side of things. <br /> We have logged the issue and will investigate it right away.'), 200);
            }

        }

        //redirect member back to members page
        $router = $this->ci->get('router');
        return $response->withRedirect($router->pathFor('members'));
        //return $this->getView()->render('Admin/members.twig');
    }
}