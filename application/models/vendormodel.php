<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author lpaulger
 */
class vendorModel extends CI_Model{
    
    var $id = '';
    var $name = '';
    var $streetAddress = '';
    var $city = '';
    var $state = '';
    var $zipcode = '';
    
     function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function create_vendor(){
        throw new exception("not implemented");
    }
    
    function get_vendor($vendorId){
        $queryString = "SELECT pkVendorId, fldName, fldStreetAddress, fldCity, fldState, fldZipCode FROM tblVendor 
                        INNER JOIN tblVendorLocation ON tblVendor.pkVendorId = tblVendorLocation.fkVendorId
                        INNER JOIN tblLocation ON tblLocation.pkLocationId = tblVendorLocation.fkLocationId
                        WHERE pkVendorId = $vendorId";
        $query = $this->db->query($queryString);
        if($query->num_rows() == 1){
            $vendor = $query->row();
            $this->id = $vendor->pkVendorId;
            $this->name = $vendor->fldName;
            $this->streetAddress = $vendor->fldStreetAddress;
            $this->city = $vendor->fldCity;
            $this->state = $vendor->fldState;
            $this->zipcode = $vendor->fldZipCode;
            return $this;
        }
        else if($query->num_rows() > 1){
            throw new exception("Too many results");
        }
        else{
            throw new Exception("No Vendors found");
        }
    }
    
    function get_vendor_states(){
        $queryString = "SELECT fldState FROM tblVendor";
        $query = $this->db->query($queryString);
        $states = array();
        foreach($query->result()  as $state){
            array_push($states, $state->fldState);
        }
        return $states;
    }
    
    function get_vendor_cities_for_state($state){
        $queryString = "SELECT fldCity FROM tblLocation WHERE fldState = '$state'";
        $query = $this->db->query($queryString);
        $cities = array();
        if($query->num_rows() == 1){
            foreach($query->result()  as $city){
                array_push($cities, $city->fldCity);
            }
            return $cities;
        }
        else{
            return array("");
        }
    }
    
    function get_all_vendors(){
        $queryString = "SELECT pkVendorId, fldName, fldStreetAddress, fldCity, fldState, fldZipCode
                        FROM tblVendor
                        INNER JOIN tblVendorLocation ON tblVendor.pkVendorId = tblVendorLocation.fkVendorId
                        INNER JOIN tblLocation ON tblLocation.pkLocationId = tblVendorLocation.fkLocationId";
        $query = $this->db->query($queryString);
        $vendors_all = array();
        if($query->num_rows() < 1){
            throw new exception("no vendors");
        }
        foreach($query->result()  as $vendor){
            $vendorObject = new vendorModel();
            $vendorObject->id = $vendor->pkVendorId;
            $vendorObject->name = $vendor->fldName;
            $vendorObject->streetAddress = $vendor->fldStreetAddress;
            $vendorObject->city = $vendor->fldCity;
            $vendorObject->state = $vendor->fldState;
            $vendorObject->zipcode = $vendor->fldZipCode;
            array_push($vendors_all, $vendorObject);
        }
        return $vendors_all;
    }
    
    function update_vendor($name){
        throw new exception("not implemented");
    }
    
    function create_deal_vendor($itemId){
        throw new exception("not implemented");
    }
}