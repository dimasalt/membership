<?php

namespace Membership\Helpers;

use Membership\Libraries;

class ProgramHelper
{
    /************************************************
     *      get promotion for the main index page
     * *********************************************/
    public function getPromotion()
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT promotion_id, name, description, media_link, details_link, media_type FROM promotions WHERE is_active = 1 LIMIT 1');
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;

    }

    
    /*************************************************
     *          gets all available published programs
     * ***********************************************/
    public function getAllPrograms()
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select program_id, name, excert, program_img from programs where is_published = 1 order by place ASC');
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**********************************************************
     *     gets all program id's to which user has access
     * ********************************************************/
    public function getUserPrograms($user_id)
    {
        if(isset($_SESSION['token']) && isset($_COOKIE['token']))
        {
            $db = new Libraries\DBConnection();
            $pdo = $db->getPDO();
            $stmt = $pdo->prepare('Select program_id from programs_to_users where user_id = ?');
            $stmt->execute(array($user_id));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        }
        else return false;
    }

    /********************************************
     *          general program information
     * ******************************************/
    public function getProgramInfoById($program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('
                Select program_id, name, full_name, excert, program_img, sales_url, is_free, is_published from programs where program_id = ?');
        $stmt->execute(array($program_id));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /*********************************************************
     *          general program information
     * *******************************************************/
    public function getProgramInfoByName($program_name)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select program_id, name, full_name, excert, program_img, sales_url, is_free, is_published from programs where name = ? or full_name = ?');
        $stmt->execute(array($program_name, $program_name));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }


    /******************************************************
     *              get program items
     * ***************************************************/
    public function getProgramItems($program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select category_id, name from program_items_category where program_id = ? ORDER BY place ASC');
        $stmt->execute(array($program_id));

        $categories = [];
        $count = 0;
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
        {
            $categories[$count]['name'] = $row['name'];
            $categories[$count]['items'] = $this->getCategoryItems($row['category_id'], $program_id);

            $count = $count + 1;
        }

        return $categories;
    }

    /*************************************************
     *              get category items
     * **********************************************/
    public function getCategoryItems($category_id, $program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select item_id, name from program_items where program_id = ? and category_id = ? ORDER BY place ASC');
        $stmt->execute(array($program_id, $category_id));
        
        $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $items;
    }


    /****************************************************
     *      gets specific item from the program
     *      video, texts, list of attachments etc...
     * **************************************************/
    public function getSpecificItem($item_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select item_id, name, folder, file, description, type from program_items where item_id = ?');
        $stmt->execute(array($item_id));

        $item = $stmt->fetch(\PDO::FETCH_ASSOC);

        //get array of download files
        $item['files'] = $this->getItemAttachments($item_id);

        //var_dump($item);

        return $item;
    }

    /************************************************
     *     get list of all attachments for
     *      a specific lesson (item) in program
     * **********************************************/
    public function getItemAttachments($item_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('SELECT file_id, folder, file, name, type FROM  program_item_files WHERE item_id = ? ORDER BY place ASC');
        $stmt->execute(array($item_id));

        $item_files = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $item_files;
    }

    /**********************************************************
     *        gets 1 specific attachment for download
     * *******************************************************/
    public function getDownloadFile($item_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select file_id, folder, file, name, type from program_item_files where file_id = ?');
        $stmt->execute(array($item_id));

        $item_files = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $item_files;
    }


    /*********************************************************
     *         checks if user belongs to specific program
     * ******************************************************/
    public function is_UserInProgram($user_id, $program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Select user_id, program_id from programs_to_users where user_id = ? and program_id = ?');
        $stmt->execute(array($user_id, $program_id));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($result == false) return false;
        else return true;
    }


    /***************************************************
     *              adds user to program
     **************************************************/
    public function addUserToProgram($user_id, $program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('Insert into programs_to_users(user_id, program_id ) values(?, ?)');
        $stmt->execute(array($user_id, $program_id));

        $result_details =  $stmt->rowCount();

        if($result_details > 0) return true;
        else return false;
    }


    /***************************************************
     *             remove member from program
     * ************************************************/
    public function removeUserToProgram($user_id, $program_id)
    {
        $db = new Libraries\DBConnection();
        $pdo = $db->getPDO();
        $stmt = $pdo->prepare('DELETE FROM programs_to_users WHERE user_id = ? AND program_id = ?');
        $stmt->execute(array($user_id, $program_id));

        $result_details =  $stmt->rowCount();

        if($result_details > 0) return true;
        else return false;
    }

    /**
     * ------------------------------------------------------
     *          Returns number of programs user belongs to
     * -------------------------------------------------------
     */
//    public function getUserPrograms($user_id)
//    {
//        $db = new Libraries\DBConnection();
//        $pdo = $db->getPDO();
//        $stmt = $pdo->prepare('Select program_id FROM programs_to_users WHERE user_id = ?');
//        $stmt->execute([$user_id]);
//
//        $result_details =  $stmt->fetchAll(\PDO::FETCH_ASSOC);
//
//        return count($result_details);
//    }
}