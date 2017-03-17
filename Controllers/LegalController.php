<?php
/**
 * Created by PhpStorm.
 * User: dsaltanovich
 * Date: 6/9/2016
 * Time: 1:45 PM
 */

namespace Membership\Controllers;


class LegalController extends BaseController
{
    /**************************************
     *              Terms
     *****************************************/
    public function Terms()
    {
        return $this->getView()->render('Legal/terms.twig');
    }


    /*******************************************
     *              Desclimer
     ******************************************/
    public function Disclaimer()
    {
        return $this->getView()->render('Legal/disclaimer.twig');
    }

    /*******************************************
     *              Privacy
     ******************************************/
    public function Privacy()
    {
        return $this->getView()->render('Legal/privacy.twig');
    }
}