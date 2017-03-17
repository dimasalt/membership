<?php

namespace Area\Ipn;

use Membership\Libraries;

/**
 * --------------------------------------------------------------------------------------------
 * You have to change the code in your listener to post your response to the Sandbox URL
 * https://www.sandbox.paypal.com/cgi-bin/webscr
 * instead of the live URL:
 * https://www.paypal.com/cgi-bin/webscr
 *
 * Sandbox login:
 * https://www.sandbox.paypal.com
 * -------------------------------------------------------------------------------------------
 */


class PaypalIPN
{
    protected $log_file;
    protected $config;
    public function __construct()
    {
        $this->log_file = INC_ROOT . '/Logs/paypal.log';
        $this->config = include CONFIG_URL;
    }


    public function Index($request, $response, $args)
    {
        //        ini_set("log_errors", 1);
        //        ini_set("error_log", INC_ROOT . '/Area/Ipn/ipn.log');


        $paypal_url =  $this->config["paypal"]["url"];  //'https://www.sandbox.paypal.com/cgi-bin/webscr';
        //$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }


        $ch = curl_init($paypal_url);
        if ($ch == FALSE) {
            return FALSE;
        }

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        $res = curl_exec($ch);
        //curl_close($ch);
        if (curl_errno($ch) != 0) // cURL error
        {
            error_log(date('[Y-m-d H:i e] '). "The error is: " . $res . PHP_EOL, 3, $this->log_file);
            curl_close($ch);
            exit;
        } else {
            curl_close($ch);
        }
        // Inspect IPN validation result and act accordingly
        // Split response headers and payload, a better way for strcmp
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));



        if (strcmp ($res, "VERIFIED") == 0) {
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment and mark item as paid.
            // assign posted variables to local variables


            $contact_details =      array(
                "txn_id"                => isset($_POST['txn_id']) ? $_POST['txn_id'] : "",
                "payer_email"           => isset($_POST['payer_email']) ? $_POST['payer_email'] : "",
                "first_name"            => isset($_POST['first_name']) ? $_POST['first_name'] : "",
                "last_name"             => isset($_POST['last_name']) ? $_POST['last_name'] : "",
                "address_street"        => isset($_POST["address_street"]) ? $_POST["address_street"] : "" ,
                "address_city"          => isset($_POST["address_city"]) ? $_POST["address_city"] : "",
                "address_state"         => isset($_POST["address_state"]) ? $_POST["address_state"] : "",
                "address_country"       => isset($_POST["address_country"]) ? $_POST["address_country"] : "",
                "address_zip"           => isset($_POST["address_zip"]) ? $_POST["address_zip"] : "",
                "contact_phone"         => isset($_POST['contact_phone']) ? $_POST['contact_phone'] : ""
            );


            $payment_details =      array(
                "txn_id"                => isset($_POST['txn_id']) ? $_POST['txn_id'] : "",
                "txn_type"              => isset($_POST['txn_type']) ? $_POST['txn_type'] : "",
                "payment_type"          => isset($_POST['payment_type']) ? $_POST['payment_type'] : "",
                "payment_status"        => isset($_POST['payment_status']) ? $_POST['payment_status'] : "",
                "payment_source"        => "PayPal", //where the payment came from //need for database record
                "item_name"             => isset($_POST['item_name']) ? $_POST['item_name'] : "",
                "payment_amount"        => isset($_POST['mc_gross']) ? $_POST['mc_gross'] : "",
                "date"                  => isset($_POST["payment_date"]) ? $_POST["payment_date"] : ""
            );


            //add order record
            $ord = new Libraries\OrderLibrary();
            $ord->PlaceOrder($contact_details, $payment_details);


            //to process the payment the only thing we need is to check the payment notification status
            //we don't really care about payment type or transaction type
            $payment_status = $_POST["payment_status"] ;
            if($payment_status == "Completed")
            {
                //add to membership
                $ac = new Libraries\MembershipLibrary();
                $ac->AddToMembership($contact_details['first_name'], $contact_details['last_name'], $contact_details['payer_email']);
                $ac->AddUserToProgram($contact_details['payer_email'], $payment_details["item_name"]);

                //add to auto responder
                $au = new Libraries\CRMLibrary();
                $au->AddToProgram($payment_details['item_name'], $contact_details['payer_email'], $contact_details['first_name'], $contact_details['last_name']);
            }
            else if($payment_status == "Refunded" || $payment_status == "Reversed")
            {

                //membership
                $ac = new Libraries\MembershipLibrary();
                $ac->RemoveUserFromProgram($contact_details['payer_email'], $payment_details["item_name"]);

                //remove from auto responder
                $au = new Libraries\CRMLibrary();
                $au->RemoveFromProgram($payment_details['item_name'], $contact_details['payer_email'], $contact_details['first_name'], $contact_details['last_name']);
            }
        }
        else if (strcmp ($res, "INVALID") == 0) {
            error_log(date('[Y-m-d H:i e] '). "The response from IPN was: " .$res . PHP_EOL, 3, $this->log_file);
        }

        http_response_code(200);
    }
}