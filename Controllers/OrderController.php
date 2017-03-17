<?php
/**
 * ***********************************************
 * Product order form and check out
 * http://stackoverflow.com/questions/31173255/perform-a-stripe-transaction-without-js-to-retrieve-token (without using JavaScript)
 * **********************************************
 */

namespace Membership\Controllers;

use Membership\Helpers;
use Membership\Libraries;
use Stripe\Stripe;

class OrderController extends BaseController
{
    /**
     * Opens order form and sets variables
     */
    public function Index($request, $response, $args)
    {
        $program_id = $args["program_id"];

        $chkHelper = new Helpers\OrderHelper();
        $program_info = $chkHelper->getProgramCheckoutInformation($program_id);


        //if nothing came in return
        if($program_info == false) {
            return $response->withRedirect('/');
        }

        //getting publishable stripe key
        $publishable_key = $this->config["stripe"]["publishable_key"];


        return $this->getView()->render(
            'Order\order.twig',
            array(
                'program_info' => $program_info,
                'publishable_key' => $publishable_key,
                'nomenu' => true
            )
        );
    }


    public function Charge($request, $response, $args)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['stripeToken']))
        {
            //get program information
            $program_id = $args["program_id"];

            $chkHelper = new Helpers\OrderHelper();
            $program_info = $chkHelper->getProgramCheckoutInformation($program_id);

            $program_price = (int)$program_info["price"] * 100; //convert to cents


            $secret_key = $this->config["stripe"]["secret_key"];

            Stripe::setApiKey($secret_key);
            $token = $_POST['stripeToken'];

            // Create a charge: this will charge the user's card
            try {

//                // Create a Customer
//                $customer = \Stripe\Customer::create(array(
//                        "source" => $token,
//                        "description" => "Example customer")
//                );

                $contact_details =      array(
                    "txn_id"                => "",
                    "payer_email"           => isset($_POST["email"]) ? $_POST["email"] : "",
                    "first_name"            => isset($_POST['full_name']) ? $_POST['full_name'] : "",
                    "last_name"             => "",
                    "address_street"        => isset($_POST["address"]) ? $_POST["address"] : "" ,
                    "address_city"          => isset($_POST["city"]) ? $_POST["city"] : "",
                    "address_state"         => isset($_POST["state"]) ? $_POST["state"] : "",
                    "address_country"       => isset($_POST["country"]) ? $_POST["country"] : "",
                    "address_zip"           => isset($_POST["zip_code"]) ? $_POST["zip_code"] : "",
                    "contact_phone"         => ""
                );

                $charge = \Stripe\Charge::create(array(
                    "amount" => $program_price, // Amount in cents
                    "currency" => "usd",
                    "source" => $token,
                    "receipt_email" => $_POST["email"],
                    "description" => $program_info['full_name'],
                    "metadata" => array("email" => $_POST["email"])
                ));

                // setting up transaction id
                $txn_id = $charge->id . '.' . 'charge.succeeded';

                // set transaction id for contact_details array
                $contact_details["txn_id"] = $txn_id;

                $payment_details =      array(
                    "txn_id"                => $txn_id,
                    "txn_type"              => isset($charge->object) ? $charge->object : "",
                    "payment_type"          => "charge.succeeded", //isset($charge->object) ? $charge->object : "",
                    "payment_status"        => isset($charge->status) ? $charge->status : "",
                    "payment_source"        => "Stripe", //where the payment came from //need for database record
                    "item_name"             => isset($program_info['full_name']) ? $program_info['full_name'] : "",
                    "payment_amount"        => isset($program_info["price"]) ? $program_info["price"] : "",
                    "date"                  => ""
                );

                // place order
                $ord = new Libraries\OrderLibrary();
                $ord->PlaceOrder($contact_details, $payment_details);

                if($charge->status == 'succeeded')
                {
                    // add to membership
                    $ac = new Libraries\MembershipLibrary();
                    $ac->AddToMembership($contact_details['first_name'], $contact_details['last_name'], $contact_details['payer_email']);
                    $ac->AddUserToProgram($contact_details['payer_email'], $payment_details["item_name"]);

                    //add to auto responder
                    $au = new Libraries\CRMLibrary();
                    $au->AddToProgram($payment_details['item_name'], $contact_details['payer_email'], $contact_details['first_name'], $contact_details['last_name']);

                    // everything is fine so lets get path for thank you page and redirect
                    $thank_youPagePath = $this->getPathFor('thankyou') . '/' . $charge->id;
                    return $response->withRedirect($thank_youPagePath);
                }
            }
            catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];

                //                print('Status is:' . $e->getHttpStatus() . "\n");
                //                print('Type is:' . $err['type'] . "\n");
                //                print('Code is:' . $err['code'] . "\n");
                //                // param is '' in this case
                //                print('Param is:' . $err['param'] . "\n");
                //                print('Message is:' . $err['message'] . "\n");
            }
            catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly

                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];
            }
            catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API

                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];
            }
            catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)

                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];
            }
            catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed

                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];
            }
            catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email

                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];
            }
            catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe

                $body = $e->getJsonBody();
                $err  = $body['error'];

                $error_message = $err['message'];
            }
        }
        else
        {
            $error_message = 'Something went wrong with your request, please make sure all field are filled and try again';
            //$this->Index($request, $response, $args);
        }


        return $this->getView()->render(
            'Order\order.twig',
            array(
                'program_info' => $program_info,
                'publishable_key' => $this->config["stripe"]["publishable_key"],
                'form_info' => $contact_details,
                'error' => isset($error_message) ? $error_message : ''
            )
        );
    }


    //-----------------------------------------------------------
    // Thank you page after payment has been made
    //----------------------------------------------------------

    public function ThankYouPage($request, $response, $args)
    {
        //get program information
        $txn_id = $args["txn_id"];

        $ordHelper = new Helpers\OrderHelper();
        $transaction_info = $ordHelper->GetThankYouPageInformation($txn_id);

        if($transaction_info != false) {

            return $this->getView()->render(
                'Order\thankyou.twig',
                array(
                    'txn_id' => $txn_id,
//                    'nomenu' => true
                )
            );
        }
        else return $response->withRedirect('/');

    }


    //-----------------------------------------------------------
    //          Sales page
    //-----------------------------------------------------------
    public function SalesPage($request, $response, $args)
    {
        $page_id = $args["page_id"];

        $orHelper = new Helpers\OrderHelper();
        $page_info = $orHelper->GetSalesPageInformation($page_id);


        return $this->getView()->render(
            'Order\sales.twig',
            array(
                'nomenu' => true,
                'page_info' => $page_info
            )
        );

    }
}