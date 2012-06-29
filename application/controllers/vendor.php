<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of authentication
 *
 * @author lpaulger
 */
class Vendor extends CI_Controller {

    var $vendorId = 1;

    //Vendor dashboard
    public function index() {
        $this->load->model('itemmodel');
        $this->load->model('vendorModel');

        //TODO: implement vendor login and session create
        $vendorId = $this->vendorId;

        $data['vendor'] = $this->vendorModel->get_vendor($vendorId);
        $data['items'] = $this->itemmodel->get_items_for_vendor($vendorId);

        $data['viewLocation'] = 'vendor/dashboard';
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }

    public function add_item() {

        $this->load->model('itemmodel');

        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');

        //TODO: implement vendor login and session create
        $vendorId = $this->vendorId;

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('initPrice', 'Initial Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('basePrice', 'Base Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'vendor/addItem';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        } else {
            $data['item'] = $this->itemmodel->add_item();
            $data['items'] = $this->itemmodel->get_items_for_vendor($vendorId);
            $data['viewLocation'] = 'vendor/addItemSuccess';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        }
    }

    public function create_deal($itemId) {
        $this->load->model('itemmodel');
        $this->load->model('deal');

        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');

        //TODO: implement vendor login and session create
        $vendorId = $this->vendorId;

        $this->form_validation->set_rules('startDate', 'Start Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('endDate', 'End Date', 'trim|required|xss_clean');
        $data['item'] = $this->itemmodel->get_item($itemId);
        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'vendor/deal/create';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        } else {
            try {
                $data['deal'] = $this->deal->create_deal($itemId);
            } catch (Exception $e) {
                $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
            }



            $data['viewLocation'] = 'vendor/deal/createSubmit';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        }
    }

}
