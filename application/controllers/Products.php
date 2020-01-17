<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Products extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->module = M_PRODUCTS;
		$this->model = 'product';
		$this->auth->login_restricted();
		$this->auth->token_restricted();
		$this->auth->module_restricted($this->module, VIEW);
		$this->page_scripts = ['products'];
	}

	
	public function index() {
		//buttons
		$this->butts = ['add', 'list'];
		$sql = $this->product_model->sql($this->company_id);
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->dash_header('Products', $count);
		$this->load->view('dash/products/index');
		$this->dash_footer();
	}


	public function data_ajax($trashed = 0) { 
		response_headers();
		$butts = ['view' => ''];
        $keys = ['id', 'name'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_PRODUCTS, $trashed, $keys, $butts);
        $sql = $this->product_model->sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	private function adit_form() {
		$this->auth->module_restricted($this->module, ADD, ADMIN, true);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'trim');
        $this->form_validation->set_rules('serial_no', 'Serial Number', 'trim');
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|is_natural');
        $this->form_validation->set_rules('price_old', 'Old Price', 'trim|is_natural');
        $this->form_validation->set_rules('size', 'Size', 'trim');
        $this->form_validation->set_rules('color', 'Colour', 'trim');
        $this->form_validation->set_rules('tags', 'Tags', 'trim');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->session->user_company_id,
            'name' => ucwords($this->input->post('name', TRUE)),
            'cat_id' => $this->input->post('cat_id', TRUE),
            'barcode' => $this->input->post('barcode', TRUE),
            'serial_no' => $this->input->post('serial_no', TRUE),
            'stock' => $this->input->post('stock', TRUE),
            'price' => $this->input->post('price', TRUE),
            'price_old' => $this->input->post('price_old', TRUE),
            'size' => $this->input->post('size', TRUE),
            'color' => $this->input->post('color', TRUE),
            'tags' => multi_select_str($this->input->post('tags', TRUE))
        ];
        return $data;
    }


	public function add() {
		//buttons
		$this->butts = ['list', 'save' => ['form' => 'add_form']];
		$this->dash_header('Add Product');
		$this->load->view('dash/products/add');
		$this->dash_footer();
	}


	public function add_ajax() {
		$data = $this->adit_form();
        $id = $this->common_model->insert(T_PRODUCTS, $data);
        echo json_response(['redirect' => mod_view_page($id)]);
    }


    public function edit($id) {
		//buttons
		$this->butts = ['list', 'save' => ['form' => 'edit_form']];
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$data['row'] = $row;
		$this->dash_header($row->name, '', $id);
		$this->load->view('dash/products/edit', $data);
		$this->dash_footer();
	}


	public function edit_ajax() {
		$id = $this->input->post('id', TRUE);
		$data = $this->adit_form();
        $this->product_model->update(T_PRODUCTS, $data, ['id' => $id]);
        echo json_response(['redirect' => mod_view_page($id)]);
    }


	public function view($id) { 
		//buttons
		$this->butts = ['add',  'edit', 'list'];
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$this->dash_header($row->name, '', $id);
		$data['row'] = $row;
		$this->load->view('dash/products/view', $data);
		$this->dash_footer();
	}


	/* === Product Categories === */
	public function cats() {
		$this->page = 'index';
		$this->module = M_PRODUCT_CATS;
		$this->table = T_PRODUCT_CATS;
		//bulk action
		$this->ba_opts = [];
		//buttons
		$this->butts = ['add_m' => ['modal' => 'add_cat'], 'list' => ['url' => $this->c_controller.'/cats']];
		$sql = $this->product_model->cats_sql($this->company_id);
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->dash_header('Product Categories', $count);
		$this->load->view('dash/products/cats/index');
		$this->dash_footer();
	}


	public function cats_ajax($trashed = 0) { 
		response_headers();
		$this->module = M_PRODUCT_CATS;
		$this->table = T_PRODUCT_CATS;
		$keys = ['id', 'name', 'order'];
		$butts = ['edit' => ['type' => 'modal', 'modal' => 'edit_cat', 'form_id' => 'edit_cat_form']];
        $buttons = table_crud_butts($this->module, $this->model, null, T_PRODUCT_CATS, $trashed, $keys, $butts);
        $sql = $this->product_model->cats_sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function cats_select_ajax() { 
        $sql = $this->product_model->cats_sql($this->company_id);
		$data = $this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
        json_response($data);
    }


	public function add_cat_ajax() {
		$this->auth->module_restricted($this->module, ADD, ADMIN, true);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->session->user_company_id,
            'name' => ucwords($this->input->post('name', TRUE)),
            'order' => ucfirst($this->input->post('order', TRUE))
        ];
        $this->common_model->insert(T_PRODUCT_CATS, $data);
        json_response_db();
    }


	public function edit_cat_ajax() {
    	$this->auth->module_restricted($this->module, EDIT, ADMIN, true);
        $this->form_validation->set_rules('id', 'Category', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false); 
        $data = [
            'name' => ucfirst($this->input->post('name', TRUE)),
            'order' => ucfirst($this->input->post('order', TRUE))
        ];
        $this->common_model->update(T_PRODUCT_CATS, $data, ['id' => $this->input->post('id', TRUE)]);
        json_response_db();
    }


    /* === Product Sizes === */
    public function sizes() {
		$this->page = 'index';
		$this->module = M_PRODUCT_SIZES;
		$this->table = T_PRODUCT_SIZES;
		//bulk action
		$this->ba_opts = [];
		//buttons
		$this->butts = ['add_m' => ['modal' => 'add_size'], 'list' => ['url' => $this->c_controller.'/sizes']];
		$sql = $this->product_model->sizes_sql($this->company_id);
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->dash_header('Product Sizes', $count);
		$this->load->view('dash/products/sizes/index');
		$this->dash_footer();
	}


	public function sizes_ajax($trashed = 0) { 
		response_headers();
		$this->module = M_PRODUCT_SIZES;
		$this->table = T_PRODUCT_SIZES;
		$keys = ['id', 'name', 'order'];
		$butts = ['edit' => ['type' => 'modal', 'modal' => 'edit_size', 'form_id' => 'edit_size_form']];
        $buttons = table_crud_butts($this->module, $this->model, null, T_PRODUCT_SIZES, $trashed, $keys, $butts);
        $sql = $this->product_model->sizes_sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


    public function size_select_ajax() { 
        $sql = $this->product_model->sizes_sql($this->company_id);
		$data = $this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
        json_response($data);
    }


	public function add_size_ajax() {
		$this->auth->module_restricted($this->module, ADD, ADMIN, true);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->session->user_company_id,
            'name' => ucwords($this->input->post('name', TRUE)),
            'order' => ucfirst($this->input->post('order', TRUE))
        ];
        $this->common_model->insert(T_PRODUCT_SIZES, $data);
        json_response_db();
    }


	public function edit_size_ajax() {
    	$this->auth->module_restricted($this->module, EDIT, ADMIN, true);
        $this->form_validation->set_rules('id', 'Size', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false); 
        $data = [
            'name' => ucfirst($this->input->post('name', TRUE)),
            'order' => ucfirst($this->input->post('order', TRUE))
        ];
        $this->common_model->update(T_PRODUCT_SIZES, $data, ['id' => $this->input->post('id', TRUE)]);
        json_response_db();
    }

	
}