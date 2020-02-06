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
		$this->max_prod_images = 6;
	}

	
	public function index() {
		$this->table = T_PRODUCTS;
		//buttons
		$this->butts = ['add', 'list' => ['files' => ['images' => company_file_path(PIX_PRODUCTS)]], 'where' => ['company_id' => $this->company_id]];
		$this->ba_opts = ['delete'];
		$sql = $this->product_model->sql($this->company_id);
		$count = count($this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']));
		$this->dash_header('Products', $count);
		$this->load->view('dash/products/index');
		$this->dash_footer();
	}


	public function data_ajax($trashed = 0) { 
		response_headers();
		$butts = ['view' => '', 'edit' => '', 'delete' => ['files' => ['images' => company_file_path(PIX_PRODUCTS)]]];
        $keys = ['id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_PRODUCTS, $trashed, $keys, $butts);
        $sql = $this->product_model->sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function view($id) { 
		$this->check_company_data(T_PRODUCTS, $id);
		//buttons
		$this->butts = ['add',  'edit', 'list'];
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$this->dash_header($row->name, '', $id);
		$data['row'] = $row;
		$this->load->view('dash/products/view', $data);
		$this->dash_footer();
	}


	public function add() {
		//buttons
		$this->butts = ['list', 'save' => ['form' => 'add_form']];
		$this->dash_header('Add Product');
		$this->load->view('dash/products/add');
		$this->dash_footer();
	}


	public function edit($id) {
    	$this->check_company_data(T_PRODUCTS, $id);
		//buttons
		$this->butts = ['add', 'view', 'list', 'save' => ['form' => 'edit_form']];
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$data['row'] = $row;
		$this->dash_header('Edit Product: '.$row->name, '', $id);
		$this->load->view('dash/products/edit', $data);
		$this->dash_footer();
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
            'company_id' => $this->company_id,
            'name' => ucwords(xpost('name')),
            'cat_id' => xpost('cat_id'),
            'barcode' => xpost('barcode'),
            'serial_no' => xpost('serial_no'),
            'stock' => xpost('stock'),
            'price' => xpost('price'),
            'price_old' => xpost('price_old'),
            'size' => xpost('size'),
            'color' => xpost('color'),
            'tags' => join_us(xpost('tags'))
        ];
        return $data;
    }


	public function add_ajax() {
		//upload images
		$upload = upload_files('images', ['path' => company_file_path(PIX_PRODUCTS), 'ext' => 'jpg|jpeg|png|gif', 'size' => 300, 'empty_msg' => 'Product must have at least 1 image', 'max' => $this->max_prod_images]);
		if ( ! $upload['status']) 
        	json_response(join_us($upload['error']), false);
        //if upload succeeds, use the first image as featured 
		$data = array_merge($this->adit_form(), 
			['image' => $upload['file_name'][0], 'images' => join_us($upload['file_name'])]
		);
		$id = $this->common_model->insert(T_PRODUCTS, $data);
        json_response(['redirect' => mod_view_page($id)]);
    }


    public function edit_ajax() {
    	$id = xpost('id');
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		//upload images
		$upload = upload_files('images', ['path' => company_file_path(PIX_PRODUCTS), 'ext' => 'jpg|jpeg|png|gif', 'size' => 300, 'required' => false, 'max' => $this->max_prod_images]);
		if ( ! $upload['status']) {
        	json_response(join_us($upload['error']), false);
			//was image uploaded?
		} elseif ($upload['status'] && ! empty($upload['file_name'])) {
			$_images = split_us($row->images);
			//unlink images
			unlink_files(company_file_path(PIX_PRODUCTS), $_images);
			//prep the uploaded images
			$images = join_us($upload['file_name']);
		} else {
			//image wasn't uploaded, retain current
			$images = $row->images;
		}
        $data = array_merge($this->adit_form(), ['image' => $upload['file_name'][0], 'images' => $images]);
		$this->product_model->update(T_PRODUCTS, $data, ['id' => $id]);
        json_response(['redirect' => mod_view_page($id)]);
    }


	public function set_featured_image($id, $image) {
		$this->check_company_data(T_PRODUCTS, $id);
		$this->product_model->update(T_PRODUCTS, ['image' => $image], ['id' => $id]);
		$this->session->set_flashdata('success_msg', 'Featured image changed successfully.');
		redirect($this->agent->referrer());
    }


    public function delete_image($id, $image) {
    	$this->check_company_data(T_PRODUCTS, $id);
    	$sql = $this->product_model->sql($this->company_id);
    	$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
    	//get images as array, remove the target from array and update
    	$images = explode(',', $row->images);
    	unset($images[array_search($image, $images)]);
    	if ( ! unlink(company_file_path(PIX_PRODUCTS, $image))) {
    		$this->session->set_flashdata('error_msg', 'Unable to delete image. Please try again');
    	} else {
	    	$this->product_model->update(T_PRODUCTS, ['images' => join_us($images)], ['id' => $id]);
			$this->session->set_flashdata('success_msg', 'Image deleted successfully.');
		}
		redirect($this->agent->referrer());
    }


	/* === Product Categories === */
	public function cats() {
		$this->page = 'index';
		$this->module = M_PRODUCT_CATS;
		$this->table = T_PRODUCT_CATS;
		//bulk action
		$this->ba_opts = ['delete'];
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


    private function cat_form() {
    	$this->auth->module_restricted(M_PRODUCT_CATS, ADD, ADMIN, true);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'name' => ucwords(xpost('name')),
            'order' => xpost('order')
        ];
    }


	public function add_cat_ajax() {
		$data = $this->cat_form();
		$this->common_model->insert(T_PRODUCT_CATS, $data);
        json_response_db();
    }


	public function edit_cat_ajax() {
    	$data = $this->cat_form();
        $this->common_model->update(T_PRODUCT_CATS, $data, ['id' => xpost('id')]);
        json_response_db();
    }


    /* === Product Sizes === */
    public function sizes() {
		$this->page = 'index';
		$this->module = M_PRODUCT_SIZES;
		$this->table = T_PRODUCT_SIZES;
		//bulk action
		$this->ba_opts = ['delete'];
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


    private function size_form() {
    	$this->auth->module_restricted($this->module, ADD, ADMIN, true);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'name' => ucwords(xpost('name')),
            'order' => xpost('order')
        ];
    }


	public function add_size_ajax() {
		$data = $this->size_form();
        $this->common_model->insert(T_PRODUCT_SIZES, $data);
        json_response_db();
    }


	public function edit_size_ajax() {
    	$data = $this->size_form();
        $this->common_model->update(T_PRODUCT_SIZES, $data, ['id' => xpost('id')]);
        json_response_db();
    }

	
}