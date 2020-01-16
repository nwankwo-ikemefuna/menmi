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
		$this->table = '';
		//crud buttons
		$this->butts = [];
		//bulk action options
		$this->ba_opts = null;
		
        //set CSRF
		$this->set_csrf();
	}


	private function set_company_info() {
		$id = 1;
		//if (isset($_SESSION['company_id'])) return;
		$select = 'c.*, cu.name AS curr_name, cu.code AS curr_code, ' . full_name_select('u');
		$joins = [
			T_USERS.' u' => ['c.owner_id = u.id'], 
			T_CURRENCIES.' cu' => ['c.curr_id = cu.id']
		];
		$row = $this->common_model->get_row(T_COMPANIES.' c', $id, '', $this->trashed, $joins, $select);
		$fields = $tables = $this->db->list_fields(T_COMPANIES);
		$data = [];
		if ( ! $row) return;
		//create keys from column names with prefix: company_
		foreach ($fields as $field) {
			$field_key = 'company_' . $field;
			if ( ! isset($_SESSION[$field_key])) {
				$data[$field_key] = $row->$field;
			}
		}
		//other others
		$data = array_merge($data, [
			'company_currency' => get_currency_symbol($row->curr_code),
			'company_currency_name' => $row->curr_name,
			'company_owner_fullname' => $row->full_name
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
		return $this->load->view('web/layout/header', $data);
	}
	

	protected function web_footer() {
		return $this->load->view('web/layout/footer');
	}
	
	
	protected function guest_header($page_title) {
		$data['page_title'] = $page_title;
		return $this->load->view('guest/layout/header', $data);
	}
	

	protected function guest_footer() {
		return $this->load->view('guest/layout/footer');
	}


	protected function dash_header($page_title, $record_count = '', $crud_rec_id = null, $meta_tags = '') {
		//unset user login request data
		$this->auth->unset_request_data();
		$data['page_title'] = $page_title;
		$data['record_count'] = $record_count;
		$data['crud_rec_id'] = $crud_rec_id;
		$data['meta_tags'] = $meta_tags;
		return $this->load->view('dash/layout/header', $data);
	}
	

	protected function dash_footer() {
		return $this->load->view('dash/layout/footer');
	}


	/**
	* Function to check that parameter exists
	* redirect to homepage if param does not exist
	* @param $param: the data being checked
	* @param $colum: the column to check the data
	* @param $table: the table to check the data
	* @return boolean
	*/
	protected function check_param_exists($param, $column, $table) { 
		$query = $this->db->get_where($table, array($column => $param))->num_rows();
		return ($query > 0) ? TRUE : redirect(site_url());
    }

	
}