<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author lpaulger
 */
class userModel extends CI_Model {

    var $username = '';
    var $password = '';
    var $passwordConfirm = '';
    var $firstName = '';
    var $lastName = '';
    var $email = '';
    var $state = '';
    var $city = '';
    var $lastLoggedIn = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function create_user() {
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->passwordConfirm = $this->input->post('passwordConfirm');
        $this->firstName = $this->input->post('firstName');
        $this->lastName = $this->input->post('lastName');
        $this->email = $this->input->post('email');
        $this->state = $this->input->post('state');
        $this->city = $this->input->post('city');

        $exists = $this->check_user_exists($this->username);

        if (!$exists) {

            $this->db->trans_start();
            $this->db->query("INSERT INTO tblUser (pkUsername, fldPassword, fldFirstName, fldLastName, fldEmail ) VALUES ('$this->username','$this->password','$this->firstName','$this->lastName','$this->email')");

            $locationResult = $this->db->query("SELECT DISTINCT pkLocationId FROM tblLocation WHERE fldState = '$this->state' AND fldCity = '$this->city'");
            if ($locationResult->num_rows() == 0) {
                $this->db->query("INSERT INTO tblLocation (fldState, fldCity) VALUES ('$this->state','$this->city')");
                $locationId = $this->db->insert_id();
                $this->db->query("INSERT INTO tblUserLocation (fkUsername, fkLocationId) VALUES ('$this->username','$locationId')");
            } else if ($locationResult->num_rows() > 1) {
                throw new exception("Duplicate location");
            } else {//Just update userLocation if location exists
                foreach ($locationResult->result_array() as $row) {
                    $locationId = $row['pkLocationId'];
                }
                $this->db->query("INSERT INTO tblUserLocation (fkUsername, fkLocationId) VALUES ('$this->username','$locationId')");
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                // generate an error... or use the log_message() function to log your error
                throw new exception("transaction fail");
            }
        } else {
            throw new exception("this username: $this->username already exists");
        }

        return $this;
    }

    function get_user($username) {
        throw new exception("not implemented");
    }

    function signin_user() {
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');

        $queryString = "SELECT pkUsername, fldPassword, fldFirstName, fldLastName,fldEmail, fldCity, fldState FROM tblUser 
                        INNER JOIN tblUserLocation ON tblUser.pkUsername= tblUserLocation.fkUsername
                        INNER JOIN tblLocation ON tblLocation.pkLocationId = tblUserLocation.fkLocationId
                        WHERE pkUsername = '$this->username' AND fldPassword = '$this->password'";
        $query = $this->db->query($queryString);
        if ($query->num_rows() == 1) {
            $user = $query->row();
            $this->username = $user->pkUsername;
            $this->password = $user->fldPassword;
            $this->firstName = $user->fldFirstName;
            $this->lastName = $user->fldLastName;
            $this->email = $user->fldEmail;
            $this->city = $user->fldCity;
            $this->state = $user->fldState;
            //TODO: set last logged in
            //$this->lastLoggedIn = date();
            //set session
            $sessionData = array(
                'username' => $this->username,
                'firstname' => $this->firstName,
                'email' => $this->email,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($sessionData);

            return $this;
        } else if ($query->num_rows() > 1) {
            throw new exception("Too many results");
        } else {
            throw new Exception("Username:$this->username or Password incorrect");
        }
    }

    function user_update_user($username) {
        throw new exception("not implemented");
    }

    private function check_user_exists($username) {
        $queryString = "SELECT pkUsername FROM tblUser WHERE pkUsername = '$username'";
        $query = $this->db->query($queryString);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_vendors() {
        $this->load->model('vendorModel');

        $session = $this->session->all_userdata();

        $this->db->trans_start();
        /*
         * Get Vendors
         */
        $queryString = "SELECT pkVendorId, fldName, fldStreetAddress, fldCity, fldState, fldZipCode
                        FROM tblVendor
                        INNER JOIN tblVendorLocation ON tblVendor.pkVendorId = tblVendorLocation.fkVendorId
                        INNER JOIN tblLocation ON tblLocation.pkLocationId = tblVendorLocation.fkLocationId";
        $query = $this->db->query($queryString);
        $vendors_all = array();
        foreach ($query->result() as $vendor) {
            $vendorObject = new vendorModel();
            $vendorObject->id = $vendor->pkVendorId;
            $vendorObject->name = $vendor->fldName;
            $vendorObject->streetAddress = $vendor->fldStreetAddress;
            $vendorObject->city = $vendor->fldCity;
            $vendorObject->state = $vendor->fldState;
            $vendorObject->zipcode = $vendor->fldZipCode;
            array_push($vendors_all, $vendorObject);
        }
        /*
         * Get the points a user has for vendors
         */
        $queryString = "SELECT fkVendorId, fldkarma FROM tblUserVendor WHERE fkUsername = '" . $session['username'] . "'";
        $query = $this->db->query($queryString);
        foreach ($vendors_all as $vendor) {
            $vendor->karma = 0;
            foreach ($query->result() as $vendorPoints) {
                if ($vendorPoints->fkVendorId == $vendor->id) {
                    $vendor->karma = $vendorPoints->fldkarma;
                }
            }
        }
        $this->db->trans_complete();

        return $vendors_all;
    }

}
