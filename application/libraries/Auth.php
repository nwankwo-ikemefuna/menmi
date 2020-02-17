<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	private $ci;
	private $license_enabled = TRUE;
	private $token_enabled = TRUE;

	public function __construct() {
		$this->ci =& get_instance();
	}


	public function login($username_key, $success_msg = 'Login successful') {
		$this->ci->form_validation->set_rules($username_key, ucfirst($username_key), 'trim|required');
        $this->ci->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->ci->form_validation->run() === FALSE) 
            json_response(validation_errors(), false);    

        $username = xpost($username_key);
        $password = xpost('password');
        $row = $this->ci->common_model->get_row(T_USERS, $username, $username_key);
		//user exists, is not trashed, and password is correct...
        if ($row && password_verify($password, $row->password)) {
        	$this->ci->session->set_userdata($this->login_data($row->id));
            json_response($success_msg);
        }
        json_response('Invalid login! ' . ucwords($username_key) . ' or password not correct', false);
    }


    public function login_data($id) {
    	$select = 'u.*, c.name AS company, ' . full_name_select('u');
    	$joins = [T_COMPANIES.' c' => ['u.company_id = c.id']];
		$row = $this->ci->common_model->get_row(T_USERS.' u', $id, 'id', 0, $joins, $select);
		$fields = $tables = $this->ci->db->list_fields(T_USERS);
		$data = [];
		if ( ! $row) return;
		$hide_me = ['password'];
		//create keys from column names with prefix: user_
		foreach ($fields as $field) {
			$field_key = 'user_' . $field;
			if ( ! isset($_SESSION[$field_key]) && ! in_array($field, $hide_me)) {
				$data[$field_key] = $row->$field;
			}
		}
		//others
		$photo = base_url(get_file(company_file_path(PIX_USERS, $row->photo), USER_AVATAR));
		$data = array_merge($data, [
			'user_loggedin' => TRUE,
			'user_company' => $row->company,
			'user_fullname' => $row->full_name,
			'user_photo' => $photo,
		]);
		return $data;
    } 


    public function logout($redirect = 'login') {
    	$data = array_keys($this->login_data($this->ci->session->user_id));
    	$this->ci->session->unset_userdata($data);
        redirect($redirect);
    }


	public function is_logged_in($redirect = 'user', $msg = 'You are already logged in!') {
    	if ($this->ci->session->user_loggedin) {
            $this->ci->session->set_flashdata('info_msg', $msg);
            redirect($redirect);
        }
    }


    private function set_request_data() {
		//create a session to hold the current requested page
		$data = array(
			'login_redirect' => TRUE,
			'requested_page' => get_requested_page()
		);
		$this->ci->session->set_userdata($data);
		return $data;
	}


	public function unset_request_data() {
		$data = array_keys($this->set_request_data());
		$this->ci->session->unset_userdata($data);
	}


	public function requested_page_input($dashboard = 'user') {
		$redirect = $this->ci->session->login_redirect ? $this->ci->session->requested_page : base_url($dashboard);
		form_input('requested_page', 'hidden', $redirect);
	}


	/**
	* Restrict access to pages requiring user to be logged in
	* redirect to login page if user is not logged
	* @return boolean
	*/
	public function login_restricted($redirect = 'login') {
		if ($this->ci->session->user_loggedin) return TRUE;
		//create a session to hold the current requested page
		$this->set_request_data();
		//redirect to login page
		$this->ci->session->set_flashdata('error_msg', 'You are not logged in. Please login to continue.');
		$this->logout($redirect);
	}


	/**
	* Restrict access to pages without the right user group and permissions
	* @return boolean
	*/
	public function vet_access($module, $right, $usergroups = null) {
		//level 1 user here?
		if (intval($this->ci->session->user_level) === 1) return true;

		//user group 
		$group = $this->ci->session->user_usergroup;
		//is usergroup an array? Cast into array if not
		$usergroups = is_array($usergroups) ? $usergroups : (array) $usergroups;
		if ( count($usergroups) > 0 && ! in_array($this->ci->session->user_usergroup, $usergroups) ) return false;
		
		//user permissions
		$permissions = $this->ci->session->user_permissions;
	    if ( ! strlen($permissions)) return false;
	    //let's work on the permissions
	    // eg 1#1|2|3|4&2#1|2|3|4
	    // module#right1|right2|...&, ++
	    $perms_arr = explode('&', $permissions);
	    if ( count($perms_arr) === 0) return false;
	    $mods_arr = [];
	    foreach ($perms_arr as $perm) {
	        $ex = explode('#', $perm);
	        $mod = intval($ex[0]);
	        $rights = $ex[1];
	        $arr = explode('|', $rights);
	        $mods_arr[$mod] = array_map('intval', $arr);
	    }
	    $modules = array_keys($mods_arr);
	    $grant_access = false;
	    foreach ($modules as $mod) {
	        //user has right to module?
	        if ( $module === $mod && in_array($right, $mods_arr[$mod]) ) {
	            $grant_access = true;
	        }
	    }
	    return $grant_access;
	}


	/**
	 * [_insert_permissions description] NOT IN USE YET, JUST SAVED HERE
	 * @return [type] [description]
	 */
	function _insert_permissions() {
		//modules
	    $feat_count = count($_POST['feat_idx']);
	    for ($i = 0; $i < $feat_count; $i++) { 
	        $feat_id = $_POST['feat_idx'][$i];
	        $l_types = "";
	        $j = 1;
	        foreach ($log_types as $type) {
	            //if type is checked, get the first letter
	            if (isset($_POST[$type['code']][$feat_id])) {
	                //append types to feat id, using # as delim, and | as separator for types
	                $l_types .= ($j == 1 ? $feat_id.'#' : '|') . $type['CategoryID'];
	                $j++;
	            }
	        }
	        if (strlen($l_types)) $features_arr[] = $l_types;
	    }

	    //implode the features, using & as delim
	    $features = join('&', $features_arr);
	    if ( ! strlen($features)) {
	        stackErrors(array("Error", "No feature selected!"));
	        exit;
	    }
	}


	/**
	* Restrict access to pages without the right permissions
	* redirect to forbidden page
	* @return boolean
	*/
	public function module_restricted($module, $right, $usergroups = null, $ajax = false, $redirect = 'forbidden') {
		$grant_access = $this->vet_access($module, $right, $usergroups);
		//var_dump($usergroups);
		if ($grant_access) return TRUE;
		if ($ajax) {
			json_response('Action not allowed! Insufficient permissions!', false);
		} else {
			$this->ci->session->set_flashdata('error_msg', 'You do not have sufficient permissions to perform the action you attempted.');
			redirect($redirect);
		}
	}


	/**
	* Redirect to homepage page if license is invalid or expired
	* @return boolean
	*/
	public function license_restricted($redirect = '') {
		if ( ! $this->license_enabled) return TRUE;
		$license_period = strlen($this->ci->session->company_license_period) ? $this->ci->session->company_license_period : '2 HOUR';
		$license_period = strtoupper($license_period);
        $where = [
            "license" => $this->session->company_license,
            "license_date >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL {$license_period})" => ''
        ];
        $query = $this->ci->common_model->get_row(T_COMPANIES, $this->ci->session->company_id, 'id', 0, [], '', $where);
        if ($query) return TRUE;
        $this->ci->session->set_flashdata('error_msg', 'Invalid or has expired license');
        redirect(site_url($redirect));
	}


	/**
	* Redirect to login page if token is invalid or expired
	* @return boolean
	*/
	public function token_restricted($redirect = 'login') {
		if ( ! $this->token_enabled) return TRUE;
		$token_period = strlen($this->ci->session->user_token_period) ? $this->ci->session->user_token_period : '2 HOUR';
		$token_period = strtoupper($token_period);
        $where = [
            "token" => $this->ci->session->user_token,
            "token_date >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL {$token_period})" => ''
        ];
        $query = $this->ci->common_model->get_row(T_USERS, $this->ci->session->user_id, 'id', 0, [], '', $where);
        // echo $this->ci->db->last_query(); die;
        if ($query) return TRUE;
        $this->ci->session->set_flashdata('error_msg', 'Your token is invalid or has expired');
		$this->logout($redirect);
	}


}