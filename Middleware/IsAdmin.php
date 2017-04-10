<?php

/**
 * *************************************************************
 * Checks if user is Admin. If yes then continue to the page
 * if not redirect to the login page
 * ************************************************************
 */

namespace Membership\Middleware;

use Membership\Helpers\AccountHelper;

class IsAdmin
{
    private $router;
    public function __construct($router)
    {
        $this->router = $router;
    }


    public function __invoke($request, $response, $next)
    {
        // ------------ BEFORE ACTION ---------------------
       //if no token send to login page
        //        if(isset($_SESSION['token']) && isset($_COOKIE['token']))
        //        {
        //            $acHelper = new AccountHelper();
        //            $user = $acHelper->getUserByToken($_SESSION['token']);
        //
        //            //if admin then continue to the page
        //            if($acHelper->is_inRole($user['user_id'], 'admin' ))
        //            {
        //                $response = $next($request, $response);
        //                return $response;
        //            }
        //        }

        if(isset($_SESSION['token']))
        {
            $acHelper = new AccountHelper();
            $user = $acHelper->getUserByToken($_SESSION['token']);

            //if admin then continue to the page
            if($acHelper->is_inRole($user['user_id'], 'admin' ))
            {
                $response = $next($request, $response);
                return $response;
            }
        }

        return $response->withRedirect($this->router->pathFor('login'));
    }
}