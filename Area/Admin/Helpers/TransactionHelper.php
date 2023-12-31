<?php

namespace Area\Admin\Helpers;


use function FastRoute\TestFixtures\empty_options_cached;
use Membership\Libraries\DBConnection;

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
                "WHERE order_transactions.txn_id LIKE '%" . $search_by . "%' or 
                    order_transactions.item_name LIKE '%" . $search_by . "%' or 
                    order_transactions.payment_source LIKE '%" . $search_by . "%' or 
                    order_transactions.payment_status LIKE '%" . $search_by . "%' or 
                    order_buyers.fname LIKE '%" . $search_by . "%' or
                    order_buyers.lname LIKE '%" . $search_by . "%' or
                    order_buyers.email LIKE '%" . $search_by . "%' or
                    order_buyers.country LIKE '%" . $search_by . "%'";
        }

        //limit results by between dates
        $start_date = Date('Y-m-d', strtotime($start_date));
        $end_date = Date('Y-m-d', strtotime($end_date));

        if(!empty($start_date) && !empty($end_date)){
            if(empty($search_string)) {
                $query = $query . " WHERE order_transactions.created_at >= '" . $start_date . "' and 
                    order_transactions.created_at <= '" . $end_date . "'";
            }
            else {
                $query = $query . " and (order_transactions.created_at >= '" . $start_date . "' and 
                    order_transactions.created_at <= '" . $end_date . "'')";
            }
        }


        //order by
        if($order_by == 'date' || empty($order_by))
            $order_string = "ORDER BY order_transactions.created_at DESC";
        else if($order_by == 'item_name')
            $order_string = "ORDER BY order_transactions.item_name ASC";
        else if($order_by == "country")
            $order_string = "ORDER BY order_buyers.country ASC";
        else if($order_by == "name")
            $order_string = "ORDER BY order_buyers.fname ASC";
        else if($order_by == "email")
            $order_string = "ORDER BY order_buyers.email ASC";


        //calculate limit and how many records to take
        $skip = $page * $page_size;
        $limit_string = "LIMIT " . $skip . "," . $page_size;

        //finalize query
        $query =  $query . ' ' . $search_string . ' ' . $order_string . ' ' . $limit_string;


        //echo $query;

        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        //format numbers and dates
        for($i = 0; $i < count($result); $i++) {
            $result[$i]['amount'] = number_format($result[$i]['amount'], 2);
            $result[$i]['created_at'] = date('M d, Y', strtotime($result[$i]['created_at']));
        }

        return $result;
    }


    //counts total number of transactions based on search and order parameters
    public function getTransactionsCount($search_by, $start_date, $end_date){
        $search_string = '';

        $query = "SELECT count(order_transactions.txn_id)
                      FROM order_transactions 
                      INNER JOIN order_buyers ON order_transactions.txn_id = order_buyers.txn_id";


        //search by
        if(!empty($search_by)) {
            $search_string =
                "WHERE order_transactions.txn_id LIKE '%" . $search_by . "%' or 
                    order_transactions.item_name LIKE '%" . $search_by . "%' or 
                    order_transactions.payment_source LIKE '%" . $search_by . "%' or 
                    order_transactions.payment_status LIKE '%" . $search_by . "%' or 
                    order_buyers.fname LIKE '%" . $search_by . "%' or
                    order_buyers.lname LIKE '%" . $search_by . "%' or
                    order_buyers.email LIKE '%" . $search_by . "%' or
                    order_buyers.country LIKE '%" . $search_by . "%'";
        }

        //limit results by between dates
        if(!empty($start_date) && !empty($end_date)){
            if(empty($search_string)) {
                "WHERE order_transactions.created_at >= " . $start_date . " and 
                    order_transactions.created_at <= " . $end_date;
            }
            else {
                " and (order_transactions.created_at >= " . $start_date . " and 
                    order_transactions.created_at <= " . $end_date . ")";
            }
        }

        //finalize query
        $query =  $query . ' ' . $search_string;


        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_NUM);

        return $result[0];
    }


    public function getTransactionStats($start_date, $end_date)
    {
        //limit results by between dates
        $start_date = Date('Y-m-d', strtotime($start_date));
        $end_date = Date('Y-m-d', strtotime($end_date));

        $query = "
            SELECT
              (Select count(txn_id) from order_transactions where order_transactions.created_at >= '" . $start_date . "' and order_transactions.created_at <= '" . $end_date . "') as transaction_count,
              (Select count(txn_id) from order_transactions where order_transactions.payment_status NOT LIKE 'Refunded' and (order_transactions.created_at >= '" . $start_date . "' and order_transactions.created_at <= '" . $end_date . "')) as sales_num,              
              (Select IFNULL(sum(amount),0) from order_transactions where order_transactions.payment_status NOT LIKE 'Refunded' and (order_transactions.created_at >= '" . $start_date . "' and order_transactions.created_at <= '" . $end_date . "')) as sales,
              (Select IFNULL(sum(amount),0) from order_transactions where order_transactions.payment_status LIKE 'Refunded' and (order_transactions.created_at >= '" . $start_date . "' and order_transactions.created_at <= '" . $end_date . "')) as refunds
        ";

        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    //today transactions
    public function getTodayTransactions()
    {
        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare('
                                  SELECT order_buyers.fname, order_buyers.lname, order_transactions.item_name, order_transactions.amount
                                  FROM order_buyers 
                                  INNER JOIN order_transactions ON order_transactions.txn_id = order_buyers.txn_id
                                  WHERE DATE(order_buyers.created_at) = DATE(now())
                                  ORDER BY order_buyers.created_at DESC 
                                  LIMIT 0, 5
                              ');
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        //format amount
        for($i = 0; $i < count($result); $i++) {
            $result[$i]['amount'] = number_format($result[$i]['amount'], 2);
        }

        return $result;
    }

    //gets transaction statistics
    public function getTransactionsGraph($search_by, $start_date, $end_date)
    {
        $search_string = '';
        $sql_date = 'DATE_FORMAT(order_transactions.created_at,\'%d/%m/%Y\')'; //regular date format


        //check time diff between two dates
        $s_date = new \DateTime($start_date);
        $e_date = new \DateTime($end_date);
        $interval = $e_date->diff($s_date);

        //set mysql parameter to extract
        if($interval->m > 1)
            $sql_date = 'DATE_FORMAT(order_transactions.created_at,\'%m/%Y\')';
        else if($interval->y > 1)
            $sql_date = 'DATE_FORMAT(order_transactions.created_at,\'%Y\')';


        $query = "SELECT sum(order_transactions.amount) as money, " . $sql_date . " as date 
                   FROM order_transactions INNER JOIN order_buyers ON order_transactions.txn_id = order_buyers.txn_id";
                    //ORDER BY logs.created_at DESC";

        //var_dump($query);

        //search by
        if(!empty($search_by)) {
            $search_string =
                "WHERE order_transactions.txn_id LIKE '%" . $search_by . "%' or 
                    order_transactions.item_name LIKE '%" . $search_by . "%' or 
                    order_transactions.payment_source LIKE '%" . $search_by . "%' or 
                    order_transactions.payment_status LIKE '%" . $search_by . "%' or 
                    order_buyers.fname LIKE '%" . $search_by . "%' or
                    order_buyers.lname LIKE '%" . $search_by . "%' or
                    order_buyers.email LIKE '%" . $search_by . "%' or
                    order_buyers.country LIKE '%" . $search_by . "%'";
        }

        //limit results by between dates
        $start_date = Date('Y-m-d', strtotime($start_date));
        $end_date = Date('Y-m-d', strtotime($end_date));

        if(!empty($start_date) && !empty($end_date)){
            if(empty($search_string)) {
                $query = $query . " WHERE order_transactions.created_at >= '" . $start_date . "' and 
                    order_transactions.created_at <= '" . $end_date . "'";
            }
            else {
                $query = $query . " and (order_transactions.created_at >= '" . $start_date . "' and 
                    order_transactions.created_at <= '" . $end_date . "'')";
            }
        }

        //set group by and order by
        if(!empty($query))
            $query = $query . " Group by " . $sql_date . " Order By " . $sql_date . " ASC";


        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        var_dump($result);

        return $result;
    }
}