<?php
/**
 * ---------------------------------------------------
 * Allow to create new user account and add members to
 * membership programs
 * ----------------------------------------------------
 */

namespace Membership\Libraries;

use Membership\Helpers;


class MembershipLibrary
{
    /**---------------------------------------------------------
    register user and place in database
    ----------------------------------------------------------*/
    public function AddToMembership($fname, $lname, $email)
    {
        //get config file
        $config = include CONFIG_URL;

        $acHelper = new Helpers\AccountHelper();
        if(!$acHelper->CheckIfUserExists($email))
        {
            //$password = bin2hex(random_bytes(8)); //random string
            $password = $config['temp_password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));

            $acHelper->CreateNewUser($email, $hashed_password, 'member', $fname, $lname);
        }
    }

    /**
     * --------------------------------------------------
     * Add user to specific membership program
     * --------------------------------------------------
     */
    public function AddUserToProgram($email, $item_name)
    {
        $acHelper = new Helpers\AccountHelper();
        if($acHelper->CheckIfUserExists($email))
        {
            $user = $acHelper->getUserByEmail($email);

            $pHelper = new Helpers\ProgramHelper();
            $program = $pHelper->getProgramInfoByName($item_name);

            if(isset($program["program_id"]) && !$pHelper->is_UserInProgram($user["user_id"], $program["program_id"]))
                $pHelper->addUserToProgram($user["user_id"], $program["program_id"]);
        }
    }


    /**
     * ------------------------------------------------------------
     * Remove user from specific membership program
     * ------------------------------------------------------------
     */
    public function RemoveUserFromProgram($email, $item_name)
    {
        $acHelper = new Helpers\AccountHelper();
        if($acHelper->CheckIfUserExists($email))
        {
            $user = $acHelper->getUserByEmail($email);

            $pHelper = new Helpers\ProgramHelper();
            $program = $pHelper->getProgramInfoByName($item_name);

            if(isset($program["program_id"]))
                $pHelper->removeUserToProgram($user["user_id"], $program["program_id"]);
        }

    }
}