<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author lpaulger
 */
class user extends CI_Controller {
    
    //View Current Deals
    public function index() {
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');
        $this->load->model('deal');
        
        $data = array();

        try {
            //$data['items'] = $this->itemmodel->get_all_items();
            $data['deals'] = $this->deal->get_all_deals();
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $data['viewLocation'] = 'user/currentDeals';
        $data['pageTitle'] = "Current Deals";
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }

    //View Vendors for user
    public function view_vendors() {
        $this->load->model('userModel');
        
        $data = array();

        try {
            $session = $this->session->all_userdata();
            if(!isset($session['username']) || (!isset($session['logged_in']))){
                throw new exception("user must be logged in");
            }
            $data['vendors'] = $this->userModel->get_vendors();
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $data['viewLocation'] = 'user/viewVendors';
        $data['pageTitle'] = "Vendors";
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }

     public function view_dashboard() {
        $this->load->model('userModel');
        
        $data = array();

        try {
            $data['session'] = $session = $this->session->all_userdata();
            if(!isset($session['username']) || (!isset($session['logged_in']))){
                throw new exception("user must be logged in");
            }
            $data['vendors'] = $this->userModel->get_vendors();
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $data['viewLocation'] = 'user/viewDashboard';
        $data['pageTitle'] = "Dashboard";
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }
}