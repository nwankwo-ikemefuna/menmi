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


    public function index() {
        $this->auth->is_logged_in();
        $this->guest_header('Login');
        $this->load->view('guest/login');
        $this->guest_footer();
    }


    public function login_ajax() {
        $this->auth->login('email');
    }


    public function logout() {
        $this->auth->logout('login');
    }
    
}