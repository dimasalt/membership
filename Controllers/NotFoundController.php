<?php

namespace Membership\Controllers;


class NotFoundController extends BaseController
{
    public function Index()
    {
        return $this->getView()->render('NotFound/index.twig');
    }
}