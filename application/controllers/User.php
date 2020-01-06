<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class User extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->auth->login_restricted();
		$this->auth->token_restricted();
	}

	
	public function index() { 
		$this->user_header('Dashboard');
		$this->load->view('user/dashboard/index'); 
		$this->user_footer();
	}

	
}