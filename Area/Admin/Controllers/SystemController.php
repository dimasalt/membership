<?php

namespace Membership\Area\Admin;

use Area\Admin\Helpers\SystemHelper;

class SystemController extends BaseController
{
    /**
     * **************************************************
     * get logs page
     * **************************************************
     */
    public function Logs($request, $response, $args)
    {
        return $this->getView()->render('System/logs.twig');
    }

    // getting list of all the logs
    public function getLogs($request, $response, $args)
    {
        $request_args = json_decode( file_get_contents('php://input') );
        $search_by = $request_args->search_by;
        $order_by = $request_args->order_by;
        $page = $request_args->page;
        $page_size = $request_args->page_size;

        //get result and get count of total records
        $sysHelper = new SystemHelper();
        $logs = $sysHelper->getLogs($order_by, $search_by, $page, $page_size);
        $logs_count = $sysHelper->getLogsCount($search_by);

        return $response->withJson([
            'logs' => $logs,
            'logs_count' => $logs_count
        ], 200);
    }

    //remove selected logs
    public function removeSelectedLogs($request, $response, $args){
        $request_args = json_decode( file_get_contents('php://input'), true );
        $logs = $request_args["log_items"];

        $sysHelper = new SystemHelper();
        $result = $sysHelper->removeSelectedLogs($logs);

        return $response->withJson(['result' => $result], 200);
    }

    //remove all logs
    public function removeAllLogs($request, $response, $args){
        $sysHelper = new SystemHelper();

        $result = $sysHelper->removeAllLogs();

        return $response->withJson(['result' => $result], 200);
    }

    /***
     * *******************************************************************
     *  Mysql BackUp
     * *******************************************************************
     */
    public function SQLBackup(){
        return $this->getView()->render('System/sqlbackup.twig');
    }

    public function GetSqlBackup()
    {
        $DBUSER= "root";
        $DBPASSWD= $this->config["db"]["password"];
        $DATABASE= $this->config["db"]["database"];

        $filename = "backup-" . $DATABASE . "_" . date("d-m-Y") .".sql.gz";
        $mime = "application/x-gzip";

        header( "Content-Type: " . $mime );
        header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

        $cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best";

        passthru( $cmd );

        exit(0);
    }
}