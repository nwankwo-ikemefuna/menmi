<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/


class Guest extends Core_controller {
    public function __construct() {
        parent::__construct();
        $this->page_scripts = ['guest'];
    }


    public function register() {
        $this->guest_header('Sign Up');
        $this->load->view('portal/guest/register');
        $this->guest_footer();
    }


    public function customer_register_ajax() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique['.T_USERS.'.email]', ['is_unique' => 'Email is already registered with us. Please login or use a different email']);
        $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_check_pass_strength');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[password]', ['matches'   => 'Passwords do not match']);
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'usergroup' => CUSTOMER,
            'first_name' => ucwords(xpost('first_name')),
            'last_name' => ucwords(xpost('last_name')),
            'email' => xpost('email'),
            'phone' => xpost('phone'),
            'password' => password_hash(xpost('password'), PASSWORD_DEFAULT)
        ];
        $this->common_model->insert(T_USERS, $data);
        json_response();
    }


    public function login() {
        $this->auth->is_logged_in();
        $this->guest_header('Login');
        $this->load->view('portal/guest/login');
        $this->guest_footer();
    }


    public function login_ajax() {
        $this->auth->login('email');
    }


    public function logout() {
        $this->auth->logout('login');
    }


    public function forgot_pass() {
        $this->guest_header('Password Recovery');
        $this->load->view('portal/guest/forgot_pass');
        $this->guest_footer();
    }


    public function forgot_pass_ajax() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'email' => xpost('email')
        ];
        $this->common_model->insert(T_USERS, $data);
        json_response();
    }
    
}