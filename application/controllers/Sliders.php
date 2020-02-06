<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Sliders extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->module = M_SLIDERS;
		$this->model = 'slider';
		$this->auth->login_restricted();
		$this->auth->token_restricted();
		$this->auth->module_restricted($this->module, VIEW);
		$this->page_scripts = ['sliders'];
		$this->min_slider_images = 2;
		$this->max_slider_images = 6;
	}

	
	public function index() {
		$this->table = T_SLIDERS;
		//buttons
		$this->butts = ['add', 'list' => ['files' => ['image' => company_file_path(PIX_SLIDERS)]], 'where' => ['company_id' => $this->company_id]];
		// $this->ba_opts = ['delete'];
		$sql = $this->slider_model->sql($this->company_id);
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->dash_header('Sliders', $count);
		$this->load->view('dash/sliders/index');
		$this->dash_footer();
	}


	public function data_ajax($trashed = 0) { 
		response_headers();
		$butts = ['view' => '', 'edit' => '', 'delete' => ['cmm' => 'delete/id']];
		$butts = ['view' => '', 'edit' => '', 'delete' => ['files' => ['image' => company_file_path(PIX_SLIDERS)]]];
        $keys = ['id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_SLIDERS, $trashed, $keys, $butts);
        $sql = $this->slider_model->sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function view($id) { 
		$this->check_company_data(T_SLIDERS, $id);
		//buttons
		$this->butts = ['add',  'edit', 'list'];
		$sql = $this->slider_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$this->dash_header($row->name, '', $id);
		$data['row'] = $row;
		$this->load->view('dash/sliders/view', $data);
		$this->dash_footer();
	}


	public function add() {
		//buttons
		$this->butts = ['list', 'save' => ['form' => 'add_form']];
		$this->dash_header('Add Slider');
		$this->load->view('dash/sliders/add');
		$this->dash_footer();
	}


	public function edit($id) {
    	$this->check_company_data(T_SLIDERS, $id);
		//buttons
		$this->butts = ['add', 'view', 'list', 'save' => ['form' => 'edit_form']];
		$sql = $this->slider_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$data['row'] = $row;
		$this->dash_header('Edit Slider: '.$row->name, '', $id);
		$this->load->view('dash/sliders/edit', $data);
		$this->dash_footer();
	}


	private function adit_form() {
		$this->auth->module_restricted($this->module, ADD, ADMIN, true);
        $this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $this->form_validation->set_rules('tag', 'Tag', 'trim|required');
        $this->form_validation->set_rules('btn_text', 'Button Text', 'trim|required');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'cat_id' => xpost('cat_id'),
            'name' => ucwords(xpost('name')),
            'message' => ucfirst(xpost('message')),
            'tag' => ucwords(xpost('tag')),
            'btn_text' => ucwords(xpost('btn_text')),
            'url' => prep_url(xpost('url')),
            'order' => xpost('order')
        ];
        return $data;
    }


	public function add_ajax() {
		//upload image
		$upload = upload_file('image', ['path' => company_file_path(PIX_SLIDERS), 'ext' => 'jpg|jpeg|png|gif', 'size' => 1000]);
		if ( ! $upload['status']) 
        	json_response(join_us($upload['error']), false);
        $data = array_merge($this->adit_form(), ['image' => $upload['file_name']]);
		$id = $this->common_model->insert(T_SLIDERS, $data);
        json_response(['redirect' => mod_view_page($id)]);
    }


    public function edit_ajax() {
		$id = xpost('id');
		$sql = $this->slider_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		//upload image
		$upload = upload_file('image', ['path' => company_file_path(PIX_SLIDERS), 'ext' => 'jpg|jpeg|png|gif', 'size' => 1000, 'required' => false]);
		if ( ! $upload['status']) {
        	json_response(join_us($upload['error']), false);
			//was image uploaded?
		} elseif ($upload['status'] && ! empty($upload['file_name'])) {
			//unlink image
			unlink_files(company_file_path(PIX_SLIDERS), $row->image);
			//get the uploaded image
			$image = $upload['file_name'];
		} else {
			//image wasn't uploaded, retain current
			$image = $row->image;
		}
        $data = array_merge($this->adit_form(), ['image' => $image]);
		$this->slider_model->update(T_SLIDERS, $data, ['id' => $id]);
        json_response(['redirect' => mod_view_page($id)]);
    }
	
}