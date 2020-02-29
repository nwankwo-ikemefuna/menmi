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
	}

	
	public function index() { 
		$this->portal_header('Dashboard');
		$view = 'portal/' . ( company_user() ? 'company' : 'customer') . '/index';
		$this->load->view($view); 
		$this->portal_footer();
	}


	public function reset_pass() { 
		//buttons
		$this->butts = ['save' => ['form' => 'reset_pass_form']];
		$this->portal_header('Reset Password');
		$this->load->view('portal/account/reset_pass');
		$this->portal_footer();
	}


	public function reset_pass_ajax() { 
        $this->form_validation->set_rules('curr_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_check_pass_strength');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[password]', ['matches'   => 'Passwords do not match']);
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        //is current password correct?
        if ( ! password_verify(xpost('curr_password'), $this->session->user_password))
        	json_response('Current password not correct', false);
       	//is current password same as new password
       	if (xpost('curr_password') == xpost('password'))
        	json_response('New password cannot be same as current password', false);
        $data = ['password' => password_hash(xpost('password'), PASSWORD_DEFAULT), 'password_set' => 1];
        $this->common_model->update(T_USERS, $data, ['id' => $this->session->user_id]);
        json_response(['redirect' => 'user']);
    }

}