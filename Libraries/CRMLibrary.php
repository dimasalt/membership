<?php
/**
 * -----------------------------------------------------------------
 * submits and changes information on a contact management system
 * that at the moment is Active Campaign
 * -----------------------------------------------------------------
 */


namespace Membership\Libraries;

class CRMLibrary
{
    protected $tags, $purchace_tag, $refund_tag, $list;
    private $active_campaign_url, $active_campaign_key;

    function __construct()
    {
        //list of all the programs and their respective tags and lists in CRM
        $this->tags = array(
            array(
                "item_name"         => "Instant Anxiety Relief",
                "purchace_tag"      => "purchase: Instant Anxiety Relief",
                "refund_tag"        => "refund: Instant Anxiety Relief",
                "list"              => 1
            ),
            array(
                "item_name"         => "Meditation: A Complete Guide From A to Z",
                "purchace_tag"      => "purchase: Meditation: A Complete Guide From A to Z",
                "refund_tag"        => "refund: Meditation: A Complete Guide From A to Z",
                "list"              => 7
            )
        );


        //setting up active campaing url and api key
        $config = include CONFIG_URL;
        $this->active_campaign_url = $config["crm"]["url"];
        $this->active_campaign_key = $config["crm"]["key"];
    }


    /*----------------------------------------------------
            Add to a specific autoresponder list
    -----------------------------------------------------*/
    public function AddToProgram($item_name, $email, $fname, $lname)
    {
        $this->SortTags($item_name);

        //add or update contact
        $contact = array(
            'email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,

            //add tag
            "tags" => $this->purchace_tag,

            //lists
            'p[$this->list_id_regular]' => (int)$this->list,
            'status[$this->list_id_regular]' => 1 // 1: active, 2: unsubscribed
        );

        //$ac = new \ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);
        $ac = new \ActiveCampaign($this->active_campaign_url, $this->active_campaign_key);
        $result = $ac->api("contact/sync", $contact);

        //if contact been added or found
        if($result->result_code == 1) return true;
        else return false;
    }



    /**
     * ----------------------------------------------------
     *       Remove subscriber from the list
     * -----------------------------------------------------
     */
    public function RemoveFromProgram($item_name, $email, $fname, $lname)
    {
        $this->SortTags($item_name);

        //add or update contact
        $contact = array(
            'email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,

            //add tag
            "tags" => $this->refund_tag,

            //lists
            'p[$this->list_id_regular]' => (int)$this->list,
            'status[$this->list_id_regular]' => 1 // 1: active, 2: unsubscribed
        );

        $ac = new \ActiveCampaign($this->active_campaign_url, $this->active_campaign_key);
        $result = $ac->api("contact/sync", $contact);

        //if contact been added or found
        if($result->result_code == 1) return true;
        else return false;
    }


    /**
     * -----------------------------------------------------
     *    Sort out list to add and list to remove from
     * ------------------------------------------------------
     */
    public function SortTags($item_name)
    {
        foreach ($this->tags as $tag)
        {
            if($tag["item_name"] == $item_name)
            {
                $this->purchace_tag = $tag["purchace_tag"];
                $this->refund_tag = $tag["refund_tag"];
                $this->list = $tag["list"];
                break;
            }
        }
    }
}
