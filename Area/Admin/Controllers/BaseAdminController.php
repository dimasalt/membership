<?php

namespace Membership\Area\Admin;

use Interop\Container\ContainerInterface;


class BaseController
{
    private $view;
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
            $loader = new \Twig_Loader_Filesystem(INC_ROOT . '/Area/Admin/Views');

            $this->view = new \Twig_Environment($loader, array(
                //'cache' => '/path/to/compilation_cache',
                'cache' => false
            ));
        }


       //return view
        return $this->view;
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