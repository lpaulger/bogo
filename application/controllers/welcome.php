<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author lpaulger
 */
class Welcome extends CI_Controller {

    public function index() {
        $this->load->model('deal');
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');

        $data = array();

        try {
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }

        $data['viewLocation'] = 'welcome';
        $data['pageTitle'] = "Karrrma";
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }

}