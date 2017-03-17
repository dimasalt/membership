<?php

namespace Membership\Libraries;

use Membership\Helpers;

class OrderLibrary
{
    public function PlaceOrder($contact_details, $payment_details)
    {
        try {

            //start transaction
            $db = new DBConnection();
            $pdo = $db->getPDO();

            //check if transaction has not been submitted previously
            $transaction = $pdo->prepare('SELECT txn_id FROM order_transactions WHERE txn_id = ?');
            $transaction->execute(array($payment_details['txn_id']));
            $trans_found = $transaction->fetch(\PDO::FETCH_ASSOC);

            //if not found then it is new transaction and we can commit
            if($trans_found == false)
            {
                //start transaction
                $pdo->beginTransaction();

                //insert order values
                $order = $pdo->prepare('Insert 
                                  into order_transactions(txn_id, txn_type, payment_type, payment_status, payment_source, item_name, amount) 
                                  values(?, ?, ?, ?, ?, ?, ?)');
                $order->execute(array(
                    $payment_details['txn_id'],
                    $payment_details['txn_type'],
                    $payment_details['payment_type'],
                    $payment_details['payment_status'],
                    $payment_details['payment_source'],
                    $payment_details['item_name'],
                    (string)$payment_details['payment_amount']));


                //enter buyer details
                $buyer = $pdo->prepare('Insert 
                                  into order_buyers(txn_id, email, fname, lname, address, state, country, postal ) 
                                  values(?, ?, ?, ?, ?, ?, ?, ?)');
                $buyer->execute(array(
                    $contact_details['txn_id'],
                    $contact_details['payer_email'],
                    $contact_details['first_name'],
                    $contact_details['last_name'],
                    $contact_details['address_street'] . ',' . $contact_details['address_city'],
                    $contact_details['address_state'],
                    $contact_details['address_country'],
                    $contact_details['address_zip']));

                //commit changes to the database
                $pdo->commit();
            }
            else { // if we already have transaction in than no point in repeat the action
                http_response_code(200);
                die();
            }
        }
        catch (PDOException $ex) {
            //error_log(date('[Y-m-d H:i e] '). "database error is: " . $ex->getMessage() . PHP_EOL, 3, 'ipn.log');
            //var_dump($ex->getMessage());
        }
    }


    /**
     * ------------------------------------------------------------
     *         Check if buyer is ban list and a repeated
     *              refund offender
     * ------------------------------------------------------------
     */
    public function isUserBanned($email, $fname, $lname)
    {
        $db = new DBConnection();
        $pdo = $db->getPDO();

        //check if transaction has not been submitted previously
        $stmt = $pdo->prepare('SELECT email FROM order_ban_list WHERE lower(email) = ? or lower(fname) = ? or lower(lname) = ?');
        $stmt->execute(array( strtolower($email), strtolower($fname), strtolower($lname) ));

        $bans_found = $stmt->fetch(\PDO::FETCH_ASSOC);

        //if nothing found than user is not in ban list
        if($bans_found != false) return true;
        else return false;
    }


    /**
     * ------------------------------------------------------------
     *      Check if refunder needs to be added to transaction
     *                      ban list as a repeaded offender
     * ------------------------------------------------------------
     */
     public function AddToBanList($email, $fname, $lname)
     {
         //find user
         $acHelper = new Helpers\AccountHelper();
         $usr = $acHelper->getUserByEmail($email);

         //check if he is in more than 1 program. if yes leave it be, if not return true as someone who needs to be added to the ban list
         $prHelper = new Helpers\ProgramHelper();
         $programs_num = $prHelper->getUserPrograms($usr['user_id']);

         if($programs_num == 0)
         {
             $db = new DBConnection();
             $pdo = $db->getPDO();

             //check if transaction has not been submitted previously
             $stmt = $pdo->prepare('Insert INTO order_ban_list(email, fname, lname) VALUES (?, ?, ?)');
             $stmt->execute(array(
                 empty($email) ? null : $email,
                 empty($fname) ? null : $fname,
                 empty($lname) ? null : $lname
             ));
         }
     }

}