<?php
/**
 * -------------------------------------------
 * Logs errors and actions into database
 * --------------------------------------
 */

namespace Membership\Libraries;

use Membership\Helpers;


class LoggingLibrary
{
    /**
     * -----------------------------------------------------------------
     * logs errors for transactions that did not go through
     * -----------------------------------------------------------------
     */
    public static function LogTransactionError($type, $message, $code, $param, $email, $full_name)
    {
        //        $db = new DBConnection();
        //        $pdo = $db->getPDO();
        //
        //        $stmt = $pdo->prepare('INSERT INTO order_errors (error_code, message, type, param, email, full_name ) VALUES(?, ?, ?, ?, ?, ?)');
        //        $stmt->execute(array($type, $message, $code, $param, $email, $full_name));
    }


    /**
     * --------------------------------------------
     * logs member actions
     * --------------------------------------------
     */
    public function LogMemberAction($page_name, $action_type)
    {

        $user_agent_info = $_SERVER['HTTP_USER_AGENT'];
        $ip = $this->get_ip();


        $acHelper = new Helpers\AccountHelper();
        $user = $acHelper->getUserByToken($_SESSION["token"]);

        $db = new DBConnection();
        $pdo = $db->getPDO();

        $stmt = $pdo->prepare('INSERT INTO logs (username, page, action, agent, ip) VALUES(?, ?, ?, ?, ?)');
        $stmt->execute(array(
            $user == false ? 'n/a' : $user["email"],
            $page_name,
            $action_type,
            $user_agent_info,
            $ip
        ));
    }




    /**
     * ----------------------------------------------------------
     *          get user ip address
     * ----------------------------------------------------------
     */
    protected function get_ip() {
        //Just get the headers if we can or else use the SERVER global
        if ( function_exists( 'apache_request_headers' ) ) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }
        //Get the forwarded IP if it exists
        if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
            $the_ip = $headers['X-Forwarded-For'];
        } elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
        ) {
            $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
        } else {

            $the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
        }
        return $the_ip;
    }
}
