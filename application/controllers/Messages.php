<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Messages extends Core_controller {
	public function __construct() {
		parent::__construct();
        $this->module = M_MESSAGES;
		$this->model = 'message';
		$this->auth->login_restricted(COMPANY_USERS);
		$this->auth->password_restricted();
		$this->auth->module_restricted($this->module, VIEW, COMPANY_USERS);
		$this->page_scripts = ['messages'];
	}

	
	public function index() {
		$this->table = T_MESSAGES;
		//buttons
		$this->butts = ['list', 'where' => ['company_id' => $this->company_id]];
		$this->ba_opts = ['delete'];
		$sql = $this->message_model->sql($this->company_id);
		$count = $this->common_model->count_rows($sql['table'], $sql['where'], $this->trashed);
		$this->ajax_header('Messages', $count);
		$this->load->view('portal/company/messages/index');
		$this->ajax_footer();
	}


	public function data_ajax($trashed = 0) { 
		response_headers();
		$butts = ['view' => ''];
        $keys = ['id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_MESSAGES, $trashed, $keys, $butts);
        $sql = $this->message_model->sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function view($id) { 
		$this->check_company_data(T_MESSAGES, $id);
		//buttons
		$this->butts = ['list'];
		$sql = $this->message_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$data['row'] = $row;
		$this->ajax_header($row->sender_name, '', $id);
		$this->load->view('portal/company/messages/view', $data);
		$this->ajax_footer();
	}
	
}