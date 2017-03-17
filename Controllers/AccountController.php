<?php

namespace Membership\Controllers;

use Membership\Libraries\AuthenticationTokens;
use Membership\Helpers;
use Membership\Libraries;

class AccountController extends BaseController
{

    //main login page
    public function Index($request, $response, $args)
    {
        if(isset($_SESSION["token"]) && isset($_COOKIE["token"]))
            return $response->withRedirect('/');

        return $this->getView()->render('Account/index.twig', array('login_page' => true));
    }
    

    //main forgot password page
    public function ForgotPassword()
    {
        //has to be new on each page load
        $csrf = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $csrf;

        return $this->getView()->render('Account\forgotpassword.twig', array('csrf' => $csrf));
    }


    /**
     * -------------------------------------
     * user profile page
     * -------------------------------------
     */
    public function UserProfile($request, $response)
    {
        if(isset($_SESSION['token']) && isset($_COOKIE['token'])) {
            $acHelper = new Helpers\AccountHelper();
            $user = $acHelper->getUserByToken($_SESSION['token']);
            $user_profile = $acHelper->getUserProfile($user['user_id']);


            //set up csrf and it has to be new on each page load
            $csrf = bin2hex(random_bytes(32));
            $_SESSION['csrf'] = $csrf;

            //log member action
            $logger = new Libraries\LoggingLibrary();
            $logger->LogMemberAction('Profile Page', 'visit');

            return $this->getView()->render('Account\profile.twig', array('csrf' => $csrf, 'user_profile' => $user_profile));
        }
        else return $response->withRedirect($this->getPathFor('login'));
    }


    /**
     * ---------------------------------------------------
     * Change user profile details (including password)
     * ($user_id, $password, $fname, $lname, $avatar_url)
     * ---------------------------------------------------
     */
    public function ChangeUserProfile($request, $response, $args)
    {
        if(isset($_SESSION['token']) && isset($_COOKIE['token'])) {
            $request_args = json_decode( file_get_contents('php://input') );
            $csrf = $request_args->csrf;
            $fname = $request_args->fname;
            $lname = $request_args->lname;
            $password = $request_args->password;
            $avatar_url = $request_args->avatar_url;
            
            //if tokens do not match
            if(!isset($_SESSION['csrf']) || !isset($csrf) || $_SESSION['csrf'] != $csrf)
            {
                $data = array('is_success' => false, 'message' => 'Please login to update your member profile');
                return $response->withJson($data, 200);
            }

            $acHelper = new Helpers\AccountHelper();
            $user = $acHelper->getUserByToken($_SESSION['token']);
            
            //change user password
            $password_changed = true;
            if(!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
                $password_changed = $acHelper->ChangeUserPassword($user['user_id'], $hashed_password);
            }

            //update details
            $user_details_changed = $acHelper->UpdateUserDetails($user['user_id'], $fname, $lname, $avatar_url);

            if($password_changed && $user_details_changed) {
                $data = array('is_success' => true, 'message' => 'Your profile has been successfully changed');

                //log member action
                $logger = new Libraries\LoggingLibrary();
                $logger->LogMemberAction('Profile Page', 'update');

                return $response->withJson($data, 200);
            }
            else{
                $data = array(
                    'is_success' => false,
                    'message' => 'Ops! It appears we had and issue changing your profile. <br />We have logged the issue and will look into it right away'
                );
                return $response->withJson($data, 200);
            }
        }
    }


    //login
    public function DoLogin($request, $response, $args)
    {
        //get ajax request variables
        $request_args = json_decode( file_get_contents('php://input') );
        $useremail = $request_args->useremail;
        $userpassword = $request_args->userpassword;

        //setting up the errors
        $errors = [];

        if(!is_null($useremail) && !empty($useremail) && !is_null($userpassword) && !empty($userpassword))
        {
            $acHelper = new Helpers\AccountHelper();
            $result = $acHelper->getUserByEmail($useremail);

            //check if valid and verify user
            if(password_verify($userpassword, $result["password"]))
            {
                //                $user = new Models\UserModel();
                //                $user->user_id = $result["user_id"];
                //                $user->email = $result["email"];
                //                $user->roles = $acHelper->getUserRoles($user->user_id);

                //set token in the remember me cookie
                $token = bin2hex(random_bytes(32)); //random string
                $_SESSION["token"] = $token;
                $_COOKIE["token"] = $token;
                setcookie("token", $token, time() + 60*60*24*14, "/", HOST_NAME); //set cookie for 14 days

                //$acHelper->AddNewToken($user->user_id, $token);
                $auTokens = new AuthenticationTokens();
                $auTokens->AddNewToken($result["user_id"], $token);

                //check if uses old generated password
                if($this->config["temp_password"] == $userpassword)
                    $result_set = array('is_success' => true, 'pass_redirect' => true);
                else $result_set = array('is_success' => true, 'pass_redirect' => false);

                $logger = new Libraries\LoggingLibrary();
                $logger->LogMemberAction('Login Page', 'login');

                return $response->withJson($result_set, 200);


                //header('Content-Type: application/json');
                //echo json_encode($result_set);
            }
            else {
                $errors[] = "The email or password you entered is incorrect.";

                $result_set = array('is_success' => false, 'errors' => $errors);
                //echo json_encode($result_set);
                return $response->withJson($result_set, 200);
            }
        }
        else {
            if(empty($_POST["useremail"]))
                $errors[] = "Email is required";
            if(empty($_POST["userpassword"]))
                $errors[] = "A password is required";

            $result_set = array('is_success' => false, 'errors' => $errors);
            //echo json_encode($result_set);
            return $response->withJson($result_set, 200);
            //return $this->getView()->render('Account\login.html', array( 'errors' => $errors));
        }
    }


    /**
     * -------------------------------------------------
     * get forgoten password
     * -------------------------------------------------
     */
    public function GetPassword($request, $response, $args)
    {
        //get config
        //$config = include INC_ROOT . '/app/config.php';
        
        //get ajax request variables
        $request_args = json_decode( file_get_contents('php://input') );
        $email = $request_args->useremail;
        $csrf = $request_args->csrf;

        //if no security key or they don't match
        if(!isset($_SESSION['csrf']) || !isset($csrf) || $_SESSION['csrf'] != $csrf)
            return $response->withJson(array('is_success' => false, 'message' =>  'Logins are supported only through web form'), 200);


        //if no email has been filled
        if(is_null($email) || empty($email))
            return $response->withJson(array('is_success' => false, 'message' =>  'No email has been provided'), 200);

        
        $acHelper = new Helpers\AccountHelper();
        $user = $acHelper->getUserByEmail($email);

        //no user found
        if($user == false)
            return $response->withJson(array('is_success' => false, 'message' =>  'No member found for the email you entered.'), 200);


        $password = bin2hex(random_bytes(8)); //random string
        $hashed_password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));

        //change password and send email to the user
        $acHelper = new Helpers\AccountHelper();
        if($acHelper->ChangeUserPassword($user["user_id"], $hashed_password))
        {
            //send email functionality
            $emHelper = new Helpers\EmailHelper();
            $subject = "Your new password for the membership website";

            //html body
            $body = "Hello dear member <br /><br />"
                  . "Your new password for http://www.memberstr.com is: " . $password ."<br/><br/>"
                  . "Thank you, <br /><br />"
                  . "Better Life Membership Team";

            //plain text body
            $body_text = "Hello dear member \r\n\r\n"
                        . "Your new password for http://www.memberstr.com is: " . $password ."\r\n\r\n"
                        . "Thank you, \r\n\r\n"
                        . "Better Life Membership Team";

            if($emHelper->SendEmail($subject, $body, $body_text, $email))
                return $response->withJson(
                    array(
                        'is_success' => true,
                        'message' =>  'Great! A new password has been sent to your email.'),
                    200);
            else return $response->withJson(
                array(
                    'is_success' => false,
                    'message' =>  'Ops! Something went wrong on our side of things. <br /> We have logged the issue and will investigate it right away.'),
                200);
        }
        else //we have failed to change the user password
            return $response->withJson(
                array(
                    'is_success' => false,
                    'message' =>  'Ops! Something went wrong on our side of things. <br /> We have logged the issue and will investigate it right away.'),
                200);
    }

    /**
     * *****************************
     * New password page
     * *****************************
     */
    public function NewPassword($request, $response, $args)
    {
        //set up csrf and it has to be new on each page load
        $csrf = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $csrf;

        $logger = new Libraries\LoggingLibrary();
        $logger->LogMemberAction('Password Change Page', 'visit');

        return $this->getView()->render('Account\password_change.twig', array('csrf' => $csrf));
    }

    /**
     **********************************
     * AJAX change the actual password
     * ********************************
     */
    public function ChangePassword($request, $response, $args)
    {
        $request_args = json_decode( file_get_contents('php://input') );
        $password = $request_args->password;
        $csrf = $request_args->csrf;


        if(isset($_SESSION['csrf']) && isset($csrf) && $_SESSION['csrf'] == $csrf)
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));

            $user = $this->getUser();

            //return $response->withJson($user, 200);

            $acHelper = new Helpers\AccountHelper();
            $password_changed = $acHelper->ChangeUserPassword($user->user_id, $hashed_password);


            // return results
            if($password_changed == true) {
                $data = array(
                    'is_success' => true,
                    'message' => 'Your password has been successfully changed'
                );

                //write member actions logs
                $logger = new Libraries\LoggingLibrary();
                $logger->LogMemberAction('Password Change Page', 'changed password');
            }
            else {
                $data = array(
                    'is_success' => false,
                    'message' => 'Ops! It appears there is a problem on our end. We have logged the issue and will investigate it right away'
                );

                //write member actions logs
                $logger = new Libraries\LoggingLibrary();
                $logger->LogMemberAction('Password Change Page', 'failed to change password');
            }

            return $response->withJson($data, 200);
        }

        return $response->withJson(array('is_success' => false, 'message' => 'Something went wrong with your password submission. Please refresh the page and try again'), 200);
    }




    /**
     * ****************************
     * logout
     * ***************************
     */
    public function Logout($request, $response, $args)
    {
        if(isset($_SESSION["token"]) && !empty($_SESSION["token"]))
        {
            //write action log
            $logger = new Libraries\LoggingLibrary();
            $logger->LogMemberAction('Logout', 'logged out');


            $token = $_SESSION["token"];

            // remove token from database and from cookie
            $auTokens = new AuthenticationTokens();
            $auTokens->RemoveToken($token);
            unset($_SESSION["token"]);
            unset($_COOKIE['token']);
            setcookie("token", "", 1, "/", HOST_NAME);

        }

        return $response->withRedirect($this->getPathFor('home'));
        //return $response->withRedirect($this->ci->get('router')->pathFor('home'));
        //return $this->getView()->render('Home\index.html');
    }


}



//to return json
//echo json_encode(array('is_success' => false, 'message' =>  'Ops! Something went wrong on our side of things. <br /> We have logged the issue and will investigate it right away.'));
//exit();