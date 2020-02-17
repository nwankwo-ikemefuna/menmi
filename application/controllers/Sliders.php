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


	private function qry_str() {
		//is cat set in url?
		$cat_id = xget('cat_id');
		if ( ! strlen($cat_id)) return '';
		$this->check_data(T_SLIDER_CATS, $cat_id, [], 'id', 'sliders');
		return strlen($cat_id) ? '?cat_id='.$cat_id : '';
	}

	
	public function index() {
		$this->table = T_SLIDERS;
		$cat_id = xget('cat_id');
		$qry_str = $this->qry_str();
		//buttons
		$this->butts = ['add' => ['url' => 'sliders/add'.$qry_str], 'list' => ['url' => 'sliders'.$qry_str, 'files' => ['image' => company_file_path(PIX_SLIDERS)]], 'where' => ['company_id' => $this->company_id]];
		$this->ba_opts = ['delete'];
		$sql = $this->slider_model->sql($this->company_id);
		//if cat is set, append to where clause
		$where = strlen($cat_id) ? array_merge($sql['where'], ['s.cat_id' => $cat_id]) : $sql['where'];
		$count = $this->common_model->count_rows($sql['table'], $where, $this->trashed);
		$title = 'Slider';
		if (strlen($cat_id)) {
			$sql = $this->slider_model->cats_sql($this->company_id);
			$row = $this->common_model->get_row($sql['table'], $cat_id);
			$title .= ': '.$row->title;
		}
		$this->dash_header($title, $count);
		$this->load->view('dash/sliders/index');
		$this->dash_footer();
	}


	public function data_ajax($cat_id = '', $trashed = 0) { 
		response_headers();
		$cat_id = intval($cat_id);
		$qry_str = $cat_id != 0 ? ['qry' => query_param('cat_id', $cat_id)] : '';
		$butts = ['view' => $qry_str, 'edit' => $qry_str, 'delete' => ['files' => ['image' => company_file_path(PIX_SLIDERS)]]];
        $keys = ['id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_SLIDERS, $trashed, $keys, $butts);
        $sql = $this->slider_model->sql($this->company_id);
        //if cat is set, append to where clause
        $where = $cat_id != 0 ? array_merge($sql['where'], ['s.cat_id' => $cat_id]) : $sql['where'];
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $where);
	}


	public function view($id) { 
		$this->check_company_data(T_SLIDERS, $id);
		$qry_str = $this->qry_str();
		//buttons
		$this->butts = ['add' => ['url' => 'sliders/add'.$qry_str], 'edit' => ['url' => 'sliders/edit/'.$id.$qry_str], 'list' => ['url' => 'sliders'.$qry_str]];
		$sql = $this->slider_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$this->dash_header($row->name, '', $id);
		$data['row'] = $row;
		$this->load->view('dash/sliders/view', $data);
		$this->dash_footer();
	}


	public function add() {
		$qry_str = $this->qry_str();
		//buttons
		$this->butts = ['list' => ['url' => 'sliders'.$qry_str], 'save' => ['form' => 'add_form']];
		$this->dash_header('Add Slider');
		$this->load->view('dash/sliders/add');
		$this->dash_footer();
	}


	public function edit($id) {
    	$this->check_company_data(T_SLIDERS, $id);
    	$qry_str = $this->qry_str();
		//buttons
		$this->butts = ['add' => ['url' => 'sliders/add'.$qry_str], 'view' => ['url' => 'sliders/view/'.$id.$qry_str], 'list' => ['url' => 'sliders'.$qry_str], 'save' => ['form' => 'edit_form']];
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
        $this->form_validation->set_rules('url', 'URL', 'trim');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'cat_id' => xpost('cat_id'),
            'name' => ucwords(xpost('name')),
            'url' => strlen(xpost('url')) ? prep_url(xpost('url')) : NULL,
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