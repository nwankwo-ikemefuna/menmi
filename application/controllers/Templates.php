<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Templates extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->module = M_TEMPLATES;
		$this->model = 'template';
		$this->auth->login_restricted();
		$this->auth->token_restricted();
		$this->auth->module_restricted($this->module, VIEW);
		$this->page_scripts = ['templates'];
	}

	
	public function index() {
		//buttons
		$this->butts = ['add_m', 'list'];
		$sql = $this->template_model->sql();
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->user_header('Templates', $count);
		$this->load->view('user/templates/index');
		$this->user_footer();
	}


	public function templates_ajax($trashed = 0) { 
		response_headers();
		$keys = ['id', 'name', 'vat'];
        $xtra_butts = [
            ['text' => 'Manage Items', 'type' => 'url', 'target' => $this->c_controller.'/items'],
            ['text' => 'Bite Me', 'type' => 'modal', 'target' => 'm_confirm_action', 'icon' => 'book']
        ];
        $butts = ['view' => '', 'extra' => ['options' => $xtra_butts]];
        $buttons = table_crud_butts($this->module, $this->model, null, T_TEMPLATES, $trashed, $keys, $butts);
        $sql = $this->template_model->sql();
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function view($id) { 
		//buttons
		$xtra_butts = [
			['text' => 'Manage Items', 'type' => 'url', 'target' => $this->c_controller.'/items/'.$id],
            ['text' => 'Bite Me', 'type' => 'modal', 'target' => 'm_confirm_action', 'icon' => 'book']
		];
		$this->butts = ['add_m', 'list', 'extra' => $xtra_butts];
		$sql = $this->template_model->sql();
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$this->user_header($row->name, $row->total_items, $id);
		$data['row'] = $row;
		$this->load->view('user/templates/view', $data); 
		$this->user_footer();
	}


	public function items($id) { 
		$this->page = 'index';
		$this->module = M_ITEMS;
		$this->table = T_ITEMS;
		//buttons
		$xtra_butts = [['text' => 'Template', 'type' => 'url', 'target' => $this->c_controller.'/view/'.$id]];
		$this->butts = ['add_m', 'list' => ['url' => $this->c_controller.'/items/'.$id], 'extra' => $xtra_butts];
		//bulk action
		$this->ba_opts = ['Transfer' => ['modal' => 'm_confirm_action'], 'Delete'];
		$sql = $this->template_model->sql();
		$row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where']);
		$sql = $this->template_model->item_sql($id);
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->user_header('Items: '.$row->name, $count, $id);
		$data['row'] = $row;
		$sql = $this->template_model->cat_sql();
		$data['categories'] = $this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$this->load->view('user/templates/items/index', $data); 
		$this->user_footer();
	}


	public function items_ajax($id, $trashed = 0) { 
		$this->module = M_ITEMS;
		response_headers();
		$keys = ['id', 'template_id', 'cat_id', 'name'];
        $butts = ['edit' => ['type' => 'modal', 'modal' => 'm_edit']];
        $buttons = table_crud_butts($this->module, $this->model, null, T_ITEMS, $trashed, $keys, $butts);
		$sql = $this->template_model->item_sql($id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function add_item_ajax() {
		$this->auth->module_restricted(M_ITEMS, ADD, ADMIN, true);
        $this->form_validation->set_rules('template_id', 'Template', 'trim|required');
        $this->form_validation->set_rules('name', 'Title', 'trim|required');
        $this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'name' => ucfirst($this->input->post('name', TRUE)),
            'cat_id' => $this->input->post('cat_id', TRUE),
            'template_id' => $this->input->post('template_id', TRUE),
            'company_id' => $this->session->user_company_id,
            'user_id' => $this->session->user_id
        ];  
        $this->common_model->insert(T_ITEMS, $data);
        json_response_db();
    }


    public function edit_item_ajax() {
    	$this->auth->module_restricted(M_ITEMS, EDIT, ADMIN, true);
        $this->form_validation->set_rules('id', 'Item', 'trim|required');
        $this->form_validation->set_rules('name', 'Title', 'trim|required');
        $this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false); 
        $data = [
            'name' => ucfirst($this->input->post('name', TRUE)),
            'cat_id' => $this->input->post('cat_id', TRUE)
        ];
        $this->common_model->update(T_ITEMS, $data, ['id' => $this->input->post('id', TRUE)]);
        json_response_db();
    }

	
}