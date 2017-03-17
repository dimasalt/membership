<?php

namespace Membership\Controllers;

use Membership\Helpers\ProgramHelper;

class HomeController extends BaseController
{
    public function index($request, $response, $args) {

        $progHelper = new ProgramHelper();
        $programs = $progHelper->getAllPrograms();
        $promotion = $progHelper->getPromotion();

        //get programs for currently logged in member
        if($this->isUserLoggedIn())
        {
            $user = $this->getUser();
            $userPrograms = $progHelper->getUserPrograms($user->user_id);

            // mark user membership programs
            if($userPrograms != false) {
                foreach ($programs as &$program) //accessing by reference
                {
                    $program_id = $program['program_id'];

                    foreach ($userPrograms as $member_item){
                        if($member_item['program_id'] == $program_id)
                        {
                            $program['is_member'] = 1;
                            break;
                        }
                    }
                }
            }
        }

        // if user if not found or not logged in mark it as non member programs
        foreach ($programs as &$i) { //accessing by reference
            if(!isset($i['is_member']))
                $i['is_member'] = 0;
        }
        unset($i);


        //$uid1 = uniqid();
        //return $response->withRedirect('/login');
        //to access items in the container... $this->ci->get('');
        //$response->getBody()->write("Hello2");

        return $this->getView()->render('Home/index.twig', array(
            'programs' => $programs,
            'promotion' => $promotion
        ));
    }
}