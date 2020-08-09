<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Portal extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->auth->login_restricted();
		$this->page_scripts = ['portal'];
	}

	
	public function index() { 
		$this->portal_header('Dashboard');
		$this->load->view('portal/index'); 
		$this->portal_footer();
	}

}