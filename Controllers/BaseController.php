<?php

namespace Membership\Controllers;

use Membership\Models;
use Membership\Helpers;

use Interop\Container\ContainerInterface;

class BaseController
{
    private $view;
    private $user;
    protected $config;

    //Constructor
    protected $ci;
    public function __construct(ContainerInterface $c) {
        $this->ci = $c;
        
        $this->config = include CONFIG_URL;
    }


    /**
     * -------------------------------------------------------------
     *  get view
     * ------------------------------------------------------------*/
    protected function getView()
    {
        if(is_null($this->view))
        {
            $loader = new \Twig_Loader_Filesystem(INC_ROOT . '/Views');

            $this->view = new \Twig_Environment($loader, array(
                //'cache' => '/path/to/compilation_cache',
                'cache' => false
            ));
        }


        //if user logged in add it to the
        if($this->isUserLoggedIn())
            $this->view->addGlobal("user", $this->user);

        //var_dump($this->user);

        //return view
        return $this->view;
    }

    /**
     * ----------------------------------------------------------------------
     *  checks if user logged in and if user is found assigns him to
     *  the $this->user variable
     * ---------------------------------------------------------------------*/
    protected function isUserLoggedIn()
    {
        if(is_null($this->user))
            $this->getUser();

        if(is_null($this->user)) return false;
        else return true;
    }


    /**
     * -------------------------------------------------------------------------
     *  gets all user details
     * -------------------------------------------------------------------------*/
    protected function getUser()
    {
        if(!is_null($this->user)) return $this->user;

        //if user logged in add it to the
        if(isset($_SESSION["token"]) && !empty($_SESSION["token"]))
        {
            $this->user = new Models\UserModel();

            //get user details
            $acHelper = new Helpers\AccountHelper();
            $user_details = $acHelper->getUserByToken($_SESSION["token"]);

            if($user_details != false)
            {
                $this->user->user_id = $user_details["user_id"];
                $this->user->email = $user_details["email"];
                $this->user->roles = $acHelper->getUserRoles($this->user->user_id);
            }
        }

        return $this->user;
    }

    /**
     * ---------------------------------------------------------
     *  gets path for specific route based on name
     * --------------------------------------------------------*/
    protected function getPathFor($route_name)
    {
        return $this
            ->ci
            ->get('router')
            ->pathFor($route_name);
    }
}