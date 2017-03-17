<?php

namespace Membership\Helpers;

use Membership\Libraries;

class OrderHelper
{
    //--------------------------------------------------------
    // Gets program information for the checkout pages
    //--------------------------------------------------------
    public function getProgramCheckoutInformation($program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT 
                                  programs.program_id,
                                  programs.name,
                                  programs.full_name,
                                  checkout_pages.info,
                                  checkout_pages.price,
                                  checkout_pages.real_price,
                                  checkout_pages.paypal_link
                                FROM programs 
                                  LEFT JOIN checkout_pages ON (programs.program_id = checkout_pages.program_id)       
                                WHERE programs.program_id = ?');
        $stmt->execute(array($program_id));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    //--------------------------------------------------------------
    // Gets thank you page information and checks if order exists
    //--------------------------------------------------------------
    public function GetThankYouPageInformation($txn_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT 
                                  txn_id, 
                                  payment_status,
                                  item_name,
                                  amount,
                                  created_at
                                FROM order_transactions                                 
                                WHERE txn_id LIKE ?');
        $stmt->execute(array('%' . $txn_id . '%'));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    //get sales page
    public function GetSalesPageInformation($page_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT       
                                  price,
                                  real_price,
                                  sales_page_info
                                FROM checkout_pages                                 
                                WHERE id = ?');
        $stmt->execute(array($page_id));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}