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
class deal extends CI_Controller {
    public function index() {
        
    }
    public function view_deal($dealId){
        $this->load->model('deal');
        
        try {
            $data['item'] = $this->itemmodel->get_item_for_deal($dealId);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        
        $data['viewLocation'] = 'template/item/details';
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }
}