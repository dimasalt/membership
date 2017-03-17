<?php

namespace Area\Admin\Helpers;

use Membership\Libraries\DBConnection;

class SystemHelper
{
    public function getLogs($order_by = 'date', $search_by = '', $page = 0, $page_size = 25)
    {
        $order_string = '';
        $search_string = '';
        $limit_string = '';

        $query = "SELECT logs.id, logs.username, user_details.first_name, user_details.last_name, logs.page, logs.action, logs.ip, logs.created_at  
                      FROM logs 
                      INNER JOIN users ON logs.username = users.email
                      INNER JOIN user_details ON users.user_id = user_details.user_id";
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


    //get number of logs records
    public function getLogsCount($search_by = '')
    {
        $search_string = '';

        $query = "SELECT count(logs.id)  
                      FROM logs 
                      INNER JOIN users ON logs.username = users.email
                      INNER JOIN user_details ON users.user_id = user_details.user_id";


        //search by
        if(!empty($search_by)) {
            $search_string =
                "WHERE logs.username LIKE '%" . $search_by . "%' or 
                    user_details.first_name LIKE '%" . $search_by . "%' or 
                    user_details.last_name LIKE '%" . $search_by . "%' or 
                    logs.page LIKE '%" . $search_by . "%' or 
                    logs.action LIKE '%" . $search_by . "%'";
        }

        //finalize query
        $query =  $query . ' ' . $search_string;

        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_NUM);

        return $result[0];
    }


    //removes all logs
    public function removeAllLogs()
    {
        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare("DELETE FROM logs");
        $stmt->execute();

        $result = $stmt->rowCount();

        if($result > 0) return true;
        else return false;
    }

    //removes selected logs
    public function removeSelectedLogs($logs)
    {
        $is_removed = true;

        //perform the actual search
        $db = new DBConnection();
        $pdo = $db->getPDO();

        foreach ($logs as $log) {
            $stmt = $pdo->prepare("DELETE FROM logs WHERE logs.id = ?");
            $stmt->execute(array($log["id"]));

            $result = $stmt->rowCount();
            if($result == 0)
            {
                $is_removed = false;
                break;
            }
        }

        return $is_removed;
    }
}