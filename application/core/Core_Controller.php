<?php

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Core_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();

		//constants
		require_once 'application/config/http_codes.php';
		require_once 'application/config/consts.php';
		$this->site_author = 'SoftBytech';
		$this->author_linkedin = 'https://www.linkedin.com/in/nwankwoikemefuna';
        //trashed?
		$this->trashed = trashed_record_list();
		//company details
		$this->set_company_info();
		$this->company_id = $this->session->company_id;
		$this->company_curr = $this->session->company_currency;
		$this->company_name = $this->session->company_name;
		$this->site_name = $this->session->company_name;
		$this->site_description = $this->session->company_short_description;
		//get current controller class 
		$this->c_controller = $this->router->fetch_class();
		$this->c_method = $this->router->fetch_method();
		//current page
		$this->page = $this->c_method;
		//page scripts
		$this->page_scripts = [];
		//module
		$this->module = '';
		//table
		$this->table = ''; //required esp for bulk action
		//max data 
		$this->max_data = '';
		//crud buttons
		$this->butts = [];
		//bulk action options
		$this->ba_opts = [];
		//sidebar and breadcrumbs
		$this->show_sidebar = true;
		$this->show_bcrumbs = true;
		$this->bcrumbs = [];
		
        //set CSRF
		$this->set_csrf();
	}


	private function set_company_info() {
		$id = 1;
		$sql = $this->company_model->sql($id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where'], $sql['group_by']);
		if ( ! $row) return;
		$fields = $tables = $this->db->list_fields(T_COMPANIES);
		$data = [];
		//create keys from column names with prefix: company_
		foreach ($fields as $field) {
			$field_key = 'company_' . $field;
			if ( ! isset($_SESSION[$field_key])) {
				$data[$field_key] = $row->$field;
			}
		}
		$data = array_merge($data, [
			'company_currency' => get_currency_symbol($row->curr_code),
			'company_currency_name' => $row->curr_name,
			'company_owner_fullname' => $row->full_name,
			'company_home_slider' => $row->home_slider,
			'company_shop_slider' => $row->shop_slider,
			'company_sidebar_slider' => $row->sidebar_slider,
			'company_shop_sidebar_position' => $row->shop_sidebar_position,
			'company_blog_sidebar_position' => $row->blog_sidebar_position,
			'company_logo_site' => $row->s_logo,
			'company_logo_portal' => $row->p_logo
		]);
		$this->session->set_userdata($data);
	}


	private function set_csrf() {
		//get array of controllers to be excluded
		$excluded_controllers = [];
		//get current controller class and check if it's in the array of controllers to be excluded
		$current_class = $this->router->fetch_class();
		if ( ! in_array($current_class, $excluded_controllers) ) {
			$this->config->set_item('csrf_protection', TRUE); //allow CSRF
		} else {
			$this->config->set_item('csrf_protection', FALSE); //disable CSRF
		}
	}


	protected function web_header($page_title) {
		$data['page_title'] = $page_title;
		$sql = $this->product_model->cats_sql($this->company_id);
        $data['product_cats'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
		return $this->load->view('web/layout/header', $data);
	}
	

	protected function web_footer($current_page = '') {
		$data['current_page'] = $current_page;
		return $this->load->view('web/layout/footer', $data);
	}
	
	
	protected function guest_header($page_title) {
		$data['page_title'] = $page_title;
		return $this->load->view('guest/layout/header', $data);
	}
	

	protected function guest_footer($current_page = '') {
		$data['current_page'] = $current_page;
		return $this->load->view('guest/layout/footer', $data);
	}


	protected function dash_header($page_title, $record_count = '', $crud_rec_id = '', $max_data = '', $meta_tags = '') {
		//unset user login request data
		$this->auth->unset_request_data();
		$data['page_title'] = $page_title;
		$data['record_count'] = $record_count;
		$data['crud_rec_id'] = $crud_rec_id;
		$data['max_data'] = $max_data;
		$data['meta_tags'] = $meta_tags;
		return $this->load->view('dash/layout/header', $data);
	}
	

	protected function dash_footer($current_page = '') {
		$data['current_page'] = $current_page;
		return $this->load->view('dash/layout/footer', $data);
	}


	public function unique_data($table, $field, $is_edit = false, $edit_id = '', $where = []) {
		$found = $this->common_model->get_unique_row($table, $field, $is_edit, $edit_id, $where);
		if ( ! $found) return TRUE;
		json_response(xpost($field).' already exists!', false);
	}


	public function company_unique_data($table, $field, $is_edit = false, $edit_id = '', $where = []) {
		$where = array_merge(['company_id' => $this->company_id], $where);
		$found = $this->common_model->get_unique_row($table, $field, $is_edit, $edit_id, $where);
		if ( ! $found) return TRUE;
		json_response(xpost($field).' already exists!', false);
	}


	public function company_max_data($table, $max, $where = []) {
		if ($max == -1) return TRUE; //not limited
		$where = array_merge(['company_id' => $this->company_id], $where);
		$count = $this->common_model->count_rows($table, $where, -1);
		if ($count < $max) return TRUE;
		json_response('Limit exceeded!', false);
	}


	protected function check_data($table, $param, $where = [], $column = 'id', $redirect = 'error_404') { 
		$found = $this->common_model->get_row($table, $param, $column, 0, [], '', $where);
		if ($found) return TRUE;
		$page = get_requested_page();
		$this->session->set_flashdata('error_msg', "The resource you tried to access at <b>{$page}</b> was not found. It may not exist, have been deleted, or you may not have permission to view it.");
		$redirect .= '?page='.$page;
		redirect($redirect);
    }


    protected function check_company_data($table, $param, $where = [], $column = 'id', $redirect = 'error_404') { 
    	$where = array_merge($where, ['company_id' => $this->company_id]);
		$found = $this->common_model->get_row($table, $param, $column, 0, [], '', $where);
		if ($found) return TRUE;
		$page = get_requested_page();
		$this->session->set_flashdata('error_msg', "The resource you tried to access at <b>{$page}</b> was not found. It may not exist, have been deleted, or you may not have permission to view it.");
		$redirect .= '?page='.$page;
		redirect($redirect);
    }

	
}