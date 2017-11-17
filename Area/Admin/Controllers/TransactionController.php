<?php

namespace Membership\Area\Admin;

use Area\Admin\Helpers\TransactionHelper;


class TransactionController extends BaseController
{
    public function index($request, $response, $args)
    {
        $transHelper = new TransactionHelper();
        $transaction_chart = $transHelper->getTransactionsGraph('', "01-01-2016", "31-12-2016");
//        var_dump($transaction_chart);

        //$this->getTransactionStatsNoJSON();
        return $this->getView()->render('Transactions/index.twig');
    }


    //get transaction statistic for specific time period
    public function getTransactionStats($request, $response, $args){
        $request_args = json_decode( file_get_contents('php://input') );

        $start_date = $request_args->start_date;
        $end_date = $request_args->end_date;

        $transHelper = new TransactionHelper();
        $transaction_stats = $transHelper->getTransactionStats($start_date, $end_date);

        return $response->withJson([
            'transaction_stats' => $transaction_stats
        ], 200);

        //calculate amount of days
        //$datediff = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
    }

    //get transaction statistic for specific time period
    public function getTransactionStatsNoJSON(){

        $start_date = '2016-01-01';
        $end_date = '2016-12-31';

        $transHelper = new TransactionHelper();
        $transaction_stats = $transHelper->getTransactionStats($start_date, $end_date);

        //calculate amount of days
        //$datediff = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
    }

    //get all transactions within specific dates
    public function getTransactions($request, $response, $args){
        $request_args = json_decode( file_get_contents('php://input') );

        $start_date = $request_args->start_date;
        $end_date = $request_args->end_date;

        $search_by = $request_args->search_by;
        $order_by = $request_args->order_by;
        $page = $request_args->page;
        $page_size = $request_args->page_size;

        //get transactions and check how many of them
        $transHelper = new TransactionHelper();
        $transactions = $transHelper->getTransactions($order_by, $search_by, $page, $page_size, $start_date, $end_date);
        $transactions_count = $transHelper->getTransactionsCount($search_by, $start_date, $end_date);

        return $response->withJson([
            'transactions' => $transactions,
            'transactions_count' => $transactions_count
        ], 200);
    }


    //get today's transaction list
    public function getTodayTransactions($request, $response, $args)
    {
        $transHelper = new TransactionHelper();
        $todayTransactions = $transHelper->getTodayTransactions();

        return $response->withJson([
            'today_transactions' => $todayTransactions
        ]);
    }
}