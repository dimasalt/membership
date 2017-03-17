<?php

namespace Membership\Area\Admin;

use Membership\Helpers\AccountHelper;

class HomeController extends BaseController
{
    public function Index($request, $response, $args) {
        return $this->getView()->render('Home/index.twig', array(
            //            'programs' => $programs,
            //            'promotion' => $promotion
        ));


        //        select sum by date group
        //--------------------------------------------------------------------------------------
        //        Cast the datetime to a date, then GROUP BY using this syntax:
        //
        //        SELECT SUM(foo), DATE(mydate) FROM a_table GROUP BY DATE(a_table.mydate);
        //        Or you can GROUP BY the alias as @orlandu63 suggested:
        //
        //        SELECT SUM(foo), DATE(mydate) DateOnly FROM a_table GROUP BY DateOnly;
        //        Though I don't think it'll make any difference to performance, it is a little clearer.
        //-------------------------------------------------------------------------------------
        //      Select sum by months (for a year long totals
        //--------------------------------------------------------------------------------------
        //        SELECT DATE_FORMAT(date, "%m-%Y") AS Month, SUM(numofsale)
        //        FROM <table_name>
        //        WHERE <where-cond>
        //        GROUP BY DATE_FORMAT(date, "%m-%Y")
        //-------------------------------------------------------------------------------------
        //        Calculate date difference in PHP
        //-------------------------------------------------------------------------------------
        //                From PHP Version 5.3 and up, new date/time functions have been added to get difference:
        //
        //                $datetime1 = new DateTime("2010-06-20");
        //
        //                $datetime2 = new DateTime("2011-06-22");
        //
        //                $difference = $datetime1->diff($datetime2);
        //
        //                echo 'Difference: '.$difference->y.' years, '
        //                    .$difference->m.' months, '
        //                    .$difference->d.' days';
        //
        //                print_r($difference);
        //                Result as below:
        //
        //                Difference: 1 years, 0 months, 2 days
        //
        //                DateInterval Object
        //                        (
        //                            [y] => 1
        //                    [m] => 0
        //                    [d] => 2
        //                    [h] => 0
        //                    [i] => 0
        //                    [s] => 0
        //                    [invert] => 0
        //                    [days] => 367
        //                )
        //-----------------------------------------------------------------------------------------
    }


    //gets admin full name and picture (called from master page by Jquery code)
    public function getProfile($request, $response, $args){
        if(isset($_SESSION["token"]) && !empty($_SESSION["token"])){

            $acHelper = new AccountHelper();
            $user = $acHelper->getUserByToken($_COOKIE["token"]);

            $admin_profile = $acHelper->getUserProfile($user["user_id"]);

            if(is_null($admin_profile["avatar_url"]))
                $admin_profile["avatar_url"] = "/assets/images/avatar.jpg";

            return $response->withJson([
                'admin_profile' => $admin_profile,
                'is_success' => true
            ], 200);
        }

        else return $response->withJson([
            'is_success' => false
        ], 200);
    }
}