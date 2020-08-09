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
		$this->auth->login_restricted(COMPANY_USERS);
		$this->auth->password_restricted();
		$this->auth->module_restricted($this->module, VIEW, COMPANY_USERS);
		$this->page_scripts = ['products'];
		$this->max_prod_images = 6;
	}

	
	public function index() {
		$this->table = T_PRODUCTS;
		//buttons
		$this->butts = ['add', 'list' => ['files' => ['images' => company_file_path(PIX_PRODUCTS)]], 'where' => ['company_id' => $this->company_id]];
		$this->ba_opts = ['delete'];
		$sql = $this->product_model->sql($this->company_id);
		$count = $this->common_model->count_rows($sql['table'], $sql['where'], $this->trashed);
		$this->ajax_header('Products', $count);
		$this->load->view('portal/company/products/index');
		$this->ajax_footer();
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
		$data['row'] = $row;
		$this->ajax_header($row->name, '', $id);
		$this->load->view('portal/company/products/view', $data);
		$this->ajax_footer();
	}


	public function add() {
		//buttons
		$this->butts = ['list', 'save' => ['form' => 'add_form']];
		$this->ajax_header('Add Product');
		$this->load->view('portal/company/products/add');
		$this->ajax_footer();
	}


	public function edit($id) {
    	$this->check_company_data(T_PRODUCTS, $id);
		//buttons
		$this->butts = ['add', 'view', 'list', 'save' => ['form' => 'edit_form']];
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$data['row'] = $row;
		$this->ajax_header('Edit Product: '.$row->name, '', $id);
		$this->load->view('portal/company/products/edit', $data);
		$this->ajax_footer();
	}


	private function adit_form($type, $row = null) {
		$this->auth->module_restricted($this->module, ADD, ADMIN, true);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('cat_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'trim');
        $this->form_validation->set_rules('serial_no', 'Serial Number', 'trim');
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required|is_natural');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|is_natural');
        $this->form_validation->set_rules('price_old', 'Old Price', 'trim|is_natural');
        $this->form_validation->set_rules('size', 'Size', 'trim|required');
        $this->form_validation->set_rules('colors[]', 'Colours', 'trim');
        $this->form_validation->set_rules('tags[]', 'Tags', 'trim');
        $this->form_validation->set_rules('p_tags[]', 'Product Tags', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        //if edit, add new stock to current
        $stock = $type == 'edit' ? $row->stock + intval(xpost('stock')) : intval(xpost('stock'));
        $data = [
            'company_id' => $this->company_id,
            'name' => ucwords(xpost('name')),
            'description' => xpost_txt('description'),
            'cat_id' => xpost('cat_id'),
            'barcode' => xpost('barcode'),
            'serial_no' => xpost('serial_no'),
            'stock' => $stock,
            'price' => xpost('price'),
            'price_old' => xpost('price_old'),
            'size' => xpost('size'),
            'colors' => join_us(xpost('colors')),
            'tags' => join_us(xpost('tags')),
            'p_tags' => join_us(xpost('p_tags'))
        ];
        return $data;
    }


	public function add_ajax() {
		$data = $this->adit_form('add');
		//upload images
		$upload = upload_files('images', ['path' => company_file_path(PIX_PRODUCTS), 'ext' => 'jpg|jpeg|png|gif', 'size' => 300, 'empty_msg' => 'Product must have at least 1 image', 'max' => $this->max_prod_images]);
		if ( ! $upload['status']) 
        	json_response(join_us($upload['error']), false);
        //if upload succeeds, use the first image as featured 
		$data = array_merge($data, 
			['image' => $upload['file_name'][0], 'images' => join_us($upload['file_name'])]
		);
		$id = $this->common_model->insert(T_PRODUCTS, $data);
        json_response(['redirect' => mod_view_page($id)]);
    }


    public function edit_ajax() {
    	$id = xpost('id');
		$sql = $this->product_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$data = $this->adit_form('edit', $row);
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
			$image = $upload['file_name'][0];
			$images = join_us($upload['file_name']);
		} else {
			//image wasn't uploaded, retain current
			$image = $row->image;
			$images = $row->images;
		}
        $data = array_merge($data, ['image' => $image, 'images' => $images]);
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
    	$images = split_us($row->images);
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
		$count = $this->common_model->count_rows($sql['table'], $sql['where'], $this->trashed);
		$this->ajax_header('Product Categories', $count, '', MAX_PRODUCT_CATS);
		$this->load->view('portal/company/products/cats/index');
		$this->ajax_footer();
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


	public function cat_select_ajax() { 
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
        return $data;
    }


	public function add_cat_ajax() {
		$this->company_max_data(T_PRODUCT_CATS, MAX_PRODUCT_CATS);
		$this->company_unique_data(T_PRODUCT_CATS, 'name');
		$data = $this->cat_form();
		$this->common_model->insert(T_PRODUCT_CATS, $data);
        json_response_db();
    }


	public function edit_cat_ajax() {
		$this->company_unique_data(T_PRODUCT_CATS, 'name', true);
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
		$count = $this->common_model->count_rows($sql['table'], $sql['where'], $this->trashed);
		$this->ajax_header('Product Sizes', $count, '', MAX_PRODUCT_SIZES);
		$this->load->view('portal/company/products/sizes/index');
		$this->ajax_footer();
	}


	public function sizes_ajax($trashed = 0) { 
		response_headers();
		$this->module = M_PRODUCT_SIZES;
		$this->table = T_PRODUCT_SIZES;
		$keys = ['id', 'short_name', 'name', 'order'];
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
    	$this->auth->module_restricted(M_PRODUCT_SIZES, ADD, ADMIN, true);
        $this->form_validation->set_rules('short_name', 'Short Name', 'trim|required');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'short_name' => ucwords(xpost('short_name')),
            'name' => ucwords(xpost('name')),
            'order' => xpost('order')
        ];
        return $data;
    }


	public function add_size_ajax() {
		$this->company_max_data(T_PRODUCT_SIZES, MAX_PRODUCT_SIZES);
		$this->company_unique_data(T_PRODUCT_SIZES, 'short_name');
		$this->company_unique_data(T_PRODUCT_SIZES, 'name');
		$data = $this->size_form();
        $this->common_model->insert(T_PRODUCT_SIZES, $data);
        json_response_db();
    }


	public function edit_size_ajax() {
		$this->company_unique_data(T_PRODUCT_SIZES, 'short_name', true);
		$this->company_unique_data(T_PRODUCT_SIZES, 'name', true);
    	$data = $this->size_form();
        $this->common_model->update(T_PRODUCT_SIZES, $data, ['id' => xpost('id')]);
        json_response_db();
    }


    /* === Product Tags === */
    public function tags() {
		$this->page = 'index';
		$this->module = M_PRODUCT_TAGS;
		$this->table = T_PRODUCT_TAGS;
		//bulk action
		$this->ba_opts = ['delete'];
		//buttons
		$this->butts = ['add_m' => ['modal' => 'add_tag'], 'list' => ['url' => $this->c_controller.'/tags']];
		$sql = $this->product_model->tags_sql($this->company_id);
		$count = $this->common_model->count_rows($sql['table'], $sql['where'], $this->trashed);
		$this->ajax_header('Product Tags', $count, '', MAX_PRODUCT_TAGS);
		$this->load->view('portal/company/products/tags/index');
		$this->ajax_footer();
	}


	public function tags_ajax($trashed = 0) { 
		response_headers();
		$this->module = M_PRODUCT_TAGS;
		$this->table = T_PRODUCT_TAGS;
		$keys = ['id', 'short_name', 'name', 'order'];
		$butts = ['edit' => ['type' => 'modal', 'modal' => 'edit_tag', 'form_id' => 'edit_tag_form']];
        $buttons = table_crud_butts($this->module, $this->model, null, T_PRODUCT_TAGS, $trashed, $keys, $butts);
        $sql = $this->product_model->tags_sql($this->company_id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


    public function tag_select_ajax() { 
        $sql = $this->product_model->tags_sql($this->company_id);
		$data = $this->common_model->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
        json_response($data);
    }


    private function tag_form() {
    	$this->auth->module_restricted(M_PRODUCT_TAGS, ADD, ADMIN, true);
    	$this->form_validation->set_rules('short_name', 'Short Name', 'trim|required');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('order', 'Order', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'short_name' => ucwords(xpost('short_name')),
            'name' => ucwords(xpost('name')),
            'order' => xpost('order')
        ];
        return $data;
    }


	public function add_tag_ajax() {
		$this->company_max_data(T_PRODUCT_TAGS, MAX_PRODUCT_TAGS);
		$this->company_unique_data(T_PRODUCT_TAGS, 'short_name');
		$this->company_unique_data(T_PRODUCT_TAGS, 'name');
		$data = $this->tag_form();
        $this->common_model->insert(T_PRODUCT_TAGS, $data);
        json_response_db();
    }


	public function edit_tag_ajax() {
		$this->company_unique_data(T_PRODUCT_TAGS, 'short_name', true);
		$this->company_unique_data(T_PRODUCT_TAGS, 'name', true);
		$data = $this->tag_form();
        $this->common_model->update(T_PRODUCT_TAGS, $data, ['id' => xpost('id')]);
        json_response_db(true);
    }
	
}