<?php

namespace Membership\Libraries;

use Membership\Helpers;

/**
 * -------------------------------------------------------------------------------------------
 * Remember me functionality
 * Authenticates returning user as long as all three token, user agent and user ip do match.
 * In case if match is not found we just going to remove token all together and unset cookie
 * ------------------------------------------------------------------------------------------
 */
class Authentication
{
    public function RememberMeAuthenticate()
    {
        if(isset($_COOKIE["token"]) && !empty($_COOKIE["token"]))
        {
            $auHelper = new AuthenticationTokens();

            $current_token = $_COOKIE["token"];
            //if token is valid and user agent and user ip do match
            if($auHelper->TokenCheck($current_token))
            {
                $new_token = bin2hex(random_bytes(32)); //random string
                //$encrypted_token = hash('sha256', $new_token, true);

                $auHelper->ReplaceToken($current_token, $new_token);

                //change token in session as well
                $_SESSION["token"] = $new_token;
                $_COOKIE["token"] = $new_token;
                setcookie("token", $new_token, time() + 60*60*24*14, "/", HOST_NAME); //set cookie for 14 days
            }
            else {
                //if token did not match we are removing token and cookie
                $auHelper->RemoveOldTokens();
                unset($_COOKIE['token']);
                setcookie("token", "", 1, "/", HOST_NAME);
            }
        }
    }
}