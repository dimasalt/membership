<?php

namespace Area\Admin\Helpers;


class TransactionHelper
{
    //get all transactions withing date
    function getTransactions($order_by, $search_by, $page, $page_size, $start_date, $end_date)
    {
        $order_string = '';
        $search_string = '';
        $limit_string = '';

        $query = "SELECT order_transactions.txn_id, 
                         order_transactions.amount, 
                         order_transactions.item_name, 
                         order_transactions.created_at,
                         order_transactions.payment_source,
                         order_transactions.payment_status,
                         order_buyers.fname,
                         order_buyers.lname,
                         order_buyers.email,
                         order_buyers.country
                      FROM order_transactions 
                      INNER JOIN order_buyers ON order_transactions.txn_id = order_buyers.txn_id";
        // ORDER BY logs.created_at DESC";


        //search by
        if(!empty($search_by)) {
            $search_string =
                "WHERE logs.username LIKE '%" . $search_by . "%' or 
                    user_details.first_name LIKE '%" . $search_by . "%' or 
                    user_details.last_name LIKE '%" . $search_by . "%' or 
                    logs.page LIKE '%" . $search_by . "%' or 
                    logs.action LIKE '%" . $search_by . "%'";
        }


        //order by
        if($order_by == 'date' || empty($order_by))
            $order_string = "ORDER BY logs.created_at DESC";
        else if($order_by == 'page')
            $order_string = "ORDER BY logs.page ASC";
        else if($order_by == "user")
            $order_string = "ORDER BY user_details.first_name ASC, user_details.last_name ASC";


        //calculate limit and how many records to take
        $skip = $page * $page_size;
        $limit_string = "LIMIT " . $skip . "," . $page_size;

        //finalize query
        $query =  $query . ' ' . $search_string . ' ' . $order_string . ' ' . $limit_string;


        //        if($order_by == 'user')
        //        {
        //            $order_string = "ORDER BY logs.created_at DESC";
        //            $variables = array($value);
        //        }
        //        else if($order_by == 'page')
        //        {
        //            $query = 'Select id, page, username, agent, ip, action FROM logs WHERE page = ? ORDER BY created_at DESC';
        //            $variables = array($value);
        //        }
        //        else if($order_by == 'date')
        //        {
        //            $query = 'Select id, page, username, agent, ip, action FROM logs WHERE created_at >= ? and created_at <= ?  ORDER BY created_at DESC';
        //            $variables = array($value, $value2);
        //        }



        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

}