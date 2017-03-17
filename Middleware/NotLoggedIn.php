<?php

/**
 * *********************************************************
 * Middleware that checks that user is not logged in.
 * If user is not logged in than he will have access to the page
 * otherwise he will be redirected to a main website page.
 * This is for pages such as login page, forgot password page etc...
 * ***********************************************************
 */

namespace Membership\Middleware;

class NotLoggedIn
{
    public function __invoke($request, $response, $next)
    {
        // ------------ BEFORE ACTION ---------------------
        //if page is only for authorized users and our member
        //is not logged in then redirect to login page
        if(!isset($_SESSION["token"]) || !isset($_COOKIE['token'])) {
            $response = $next($request, $response);
            return $response;
        }
        else return $response->withRedirect('/');

    }
}