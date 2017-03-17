<?php

namespace Membership\Area\Admin;

use Area\Admin\Helpers\TransactionHelper;


class TransactionController extends BaseController
{
    public function index($request, $response, $args)
    {
        return $this->getView()->render('Transactions/index.twig');
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

        return $response->withJson([
            'transactions' => $transactions,
            'transactions_count' => $transactions_count
        ], 200);
    }
}