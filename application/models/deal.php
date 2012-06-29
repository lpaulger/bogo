<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of deal
 *
 * @author lpaulger
 */
class deal extends CI_Model {

    var $item;
    var $dealId;
    var $startDate;
    var $endDate;
    var $vendorId = 1;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('itemmodel');
        $this->item = new itemModel();
    }

    function get_all_deals() {
        $all_deals = array();
     
        $available_deals = $this->get_available_deals_for_user();
        
        return $all_deals;
    }
    
    
    /*
     * get_available_deals_for_user
     * 
     * gets all deals for all vendors
     * 
     */
    
    //TODO: Rework this method for new db schema
    function get_available_deals_for_user(){
        //$queryString = "";
        //$query = $this->db->query($queryString);
        $deals_all = array();
//        foreach ($query->result() as $item) {
//            $itemObject = new itemModel();
//            $deal = new deal();
//            $itemObject->itemId = $item->pkItemId;
//            $itemObject->name = $item->fldName;
//            $itemObject->initPrice = $item->fldInitialPrice;
//            $itemObject->basePrice = $item->fldBasePrice;
//            $itemObject->rateDecrease = $item->fldRateDecrease;
//            $itemObject->totalQty = $item->fldTotalQty;
//            $itemObject->currentQty = $item->fldCurrentQty;
//            $itemObject->vendorId = $item->fkVendorId;
//            $deal->dealId = $item->fkdealId;
//            $deal->startDate = $item->fldStartDate;
//            $deal->endDate = $item->fldEndDate;
//            $itemObject->userInCohort = 0;
//            $deal->item = $itemObject;
//            array_push($deals_all, $deal);
//        }
        return $deals_all;
    }

    function create_deal($itemId) {
        $this->item->itemId = $itemId;
        $this->startDate = $this->input->post('startDate');
        $this->endDate = $this->input->post('endDate');

        $now = strtotime('now');

        //Check that dates are not in the past
        if (strtotime($this->startDate) < $now) {
            print_r(strtotime($this->startDate));
            echo "<br>";
            print_r($now);
            throw new Exception('start date before now');
        }


        if (strtotime($this->startDate) > strtotime($this->endDate)) {
            throw new Exception('start date after end date');
        }
        
        
       
        
        $this->db->trans_start();

        //check that no other deals are running during the dates specified
        $query = $this->db->query("SELECT pkdealId, fldStartDate, fldEndDate FROM tbldeal WHERE fkVendorId = $this->vendorId");
        foreach ($query->result() as $deal) {
            //check if start date or end date clashses
            if ($this->check_in_range($deal->fldStartDate, $deal->fldEndDate, $this->startDate) || $this->check_in_range($deal->fldStartDate, $deal->fldEndDate, $this->endDate)) {
                throw new Exception('date collision');
            }
        }

        //validate that item has enough qty to create a new deal
        $itemQty = $this->db->query("SELECT fldCurrentQty FROM tblItem WHERE pkItemId = " . $this->item->itemId);
        $currentQty = $itemQty->row()->fldCurrentQty;
        if ($currentQty < 5) {
            throw new Exception('Not Enough Items to create deal (Min: 5)');
        }
        $this->db->query("INSERT INTO tbldeal (fkVendorId, fldStartDate, fldEndDate) VALUES('$this->vendorId','$this->startDate', '$this->endDate')");
        $this->dealId = $this->db->insert_id();
        $this->db->query("INSERT INTO tblItemDeal (fkItemId, fkdealId) VALUES('" . $this->item->itemId . "', '$this->dealId')");
        $this->db->trans_complete();

        return $this;
    }

    private function check_in_range($start_date, $end_date, $date_from_user) {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

}
