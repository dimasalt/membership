<?php
/**
 * *******************************************
 * Accepts refund notifications from stripe
 * code example: https://gist.github.com/boucher/1708172
 * hooks: https://www.masteringmodernpayments.com/stripe-webhook-event-cheatsheet
 * custom payment form: https://stripe.com/docs/custom-form
 * *******************************************
 */

namespace Area\WebHooks;

use Stripe\Stripe;
use Membership\Libraries;


class StripeHooks
{
    protected $log_file;
    public function __construct()
    {
        $this->log_file = INC_ROOT . '/Logs/stripehooks.log';
    }

    public function Index()
    {
        ini_set("log_errors", 1);
        ini_set("error_log", $this->log_file);

        $config = include CONFIG_URL;
        Stripe::setApiKey($config["stripe"]["secret_key"]);

        // retrieve the request's body and parse it as JSON
        $event_json = json_decode(file_get_contents('php://input'));


        // for extra security, retrieve from the Stripe API
        $event = \Stripe\Event::retrieve($event_json->id); //\Stripe\Event::retrieve($event_json->id);

        //error_log(date('[Y-m-d H:i e] '). "The object is: " . print_r($event, true) . PHP_EOL, 3, $this->log_file);

        $txn_id = $event->data->object->id . '.' . $event->type;

        $contact_details =  [
            "txn_id"                => $txn_id,
            "payer_email"           => isset($event->data->object->metadata->email) ? $event->data->object->metadata->email : "",
            "first_name"            => isset($event->data->object->source->name) ? $event->data->object->source->name : "",
            "last_name"             => "",
            "address_street"        => isset($event->data->object->source->address_line1) ? $event->data->object->source->address_line1 : "",
            "address_city"          => isset($event->data->object->source->address_city) ? $event->data->object->source->address_city : "",
            "address_state"         => isset($event->data->object->source->address_state) ? $event->data->object->source->address_state : "",
            "address_country"       => isset($event->data->object->source->address_country) ? $event->data->object->source->address_country : "",
            "address_zip"           => isset($event->data->object->source->address_zip) ? $event->data->object->source->address_zip : "",
            "contact_phone"         => ""
        ];


        $payment_details =      array(
            "txn_id"                => $txn_id,
            "txn_type"              => isset($event->data->object->object) ? $event->data->object->object : "",
            "payment_type"          => isset($event->type) ? $event->type : "",
            "payment_status"        => isset($event->data->object->status) ? $event->data->object->status : "",
            "payment_source"        => "Stripe", //where the payment came from //need for database record
            "item_name"             => isset($event->data->object->description) ? $event->data->object->description : "",
            "payment_amount"        => isset($event->data->object->amount) ? $event->data->object->amount /100 : "",
            "date"                  => ""
        );


        // add order record
        $ord = new Libraries\OrderLibrary();
        $ord->PlaceOrder($contact_details, $payment_details);

        // This will send receipts on succesful invoices
        if($event->type == 'charge.succeeded') {

            //add to membership
            $ac = new Libraries\MembershipLibrary();
            $ac->AddToMembership($event->data->object->source->name, '', $event->data->object->metadata->email);
            $ac->AddUserToProgram($event->data->object->metadata->email, $event->data->object->description);

            //add to auto responder
            $au = new Libraries\CRMLibrary();
            $au->AddToProgram($event->data->object->description, $event->data->object->metadata->email, $event->data->object->source->name, '');
        }
        if ($event->type == 'charge.refunded' || $event->type == 'charge.dispute.created') {

            //remove from membership and from program
            $ac = new Libraries\MembershipLibrary();
            $ac->RemoveUserFromProgram($event->data->object->metadata->email, $event->data->object->description );

            //add to auto responder
            $au = new Libraries\CRMLibrary();
            $au->RemoveFromProgram($event->data->object->description, $event->data->object->metadata->email,$event->data->object->source->name, '');

            //add member to a baned transaction list
            //$ord->AddToBanList($event->data->object->metadata->email, '', '');
        }

        http_response_code(200);
    }
}