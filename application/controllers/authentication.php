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
class Authentication extends CI_Controller {

    public function index() {
        
    }

    public function signup_user() {
        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');
        
        $this->load->model('userModel');
        $this->load->model('vendorModel');
        
        $session = $this->session->all_userdata();
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordConfirm]|md5');
        $this->form_validation->set_rules('passwordConfirm', 'Password Confirm', 'trim|required');
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('state', 'State', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|required|alpha|xss_clean');
        $stringStates = read_file('assets/js/states.json');
        $stateObject = json_decode($stringStates, true);
        $data['states'] = array_keys($stateObject);
        //TODO: Get cities for states
        $data['cities'] = $this->vendorModel->get_vendor_cities_for_state($data['states'][0]);

        if ($this->form_validation->run() == FALSE) {
            try{
            if(isset($session['logged_in'])){
                throw new exception("already signed in.");
            }
            $data['viewLocation'] = 'authentication/user/register';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
            }
            catch(Exception $e){
                $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
                $data['viewLocation'] = 'welcome';
                $data['data'] = $data;
                $this->load->view('layout/index', $data);
            }
        } else {
            try {
                $data['user'] = $this->userModel->create_user();
            } catch (Exception $e) {
                $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
            }

            $data['viewLocation'] = 'authentication/user/registerSuccess';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        }
    }

    public function signin_user() {
        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');

        $this->load->model('userModel');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'authentication/user/signin';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        } else {
            try {
                $isAuthenticated = $this->userModel->signin_user();
            } catch (Exception $e) {
                $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
            }
            if($data['exception'] == null){
                redirect('/user', 'location');
            }
            $data['viewLocation'] = 'authentication/user/signinSuccess';
            $data['data'] = $data;
            $this->load->view('layout/index', $data);
        }
    }

    public function signout_user() {
        $this->session->unset_userdata('logged_in');

        $data['viewLocation'] = 'welcome';
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }
}