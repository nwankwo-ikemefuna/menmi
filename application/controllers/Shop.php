<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/


class Shop extends Core_controller {
    public function __construct() {
        parent::__construct();
        $this->page_scripts = ['products'];
    }


    public function index() {
        //get shop top sliders
        $sliders = [];
        if ($this->session->company_shop_slider == 1) {
            $sql = $this->slider_model->sql($this->company_id);
            $where = array_merge($sql['where'], ['cat_id' => SLIDER_SHOP_TOP]);
            $sliders = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 3);
        }
        $data['shop_sliders'] = $sliders;
        //get sidebar sliders
        $sliders = [];
        if ($this->session->company_sidebar_slider == 1) {
            $sql = $this->slider_model->sql($this->company_id);
            $where = array_merge($sql['where'], ['cat_id' => SLIDER_SIDEBAR]);
            $sliders = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 3);
        }
        $data['sidebar_sliders'] = $sliders;
        //categories
        $sql = $this->product_model->cats_sql($this->company_id);
        $data['product_cats'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
        //sizes
        $sql = $this->product_model->sizes_sql($this->company_id);
        $data['product_sizes'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
        // last_sql();
        //colors
        $sql = $this->product_model->colors_sql($this->company_id);
        $data['product_colors'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
        //min and max price
        $sql = $this->product_model->sql($this->company_id);
        $data['price_min'] = $this->common_model->get_aggr_row($sql['table'], 'min', 'price', $sql['where']);
        $data['price_max'] = $this->common_model->get_aggr_row($sql['table'], 'max', 'price', $sql['where']);
        $this->web_header('Shop');
        $this->load->view('web/shop/index', $data);
        $this->web_footer('shop');
    }


    public function products_ajax($offset = 0) {
        $per_page = 9;
        $sql = $this->product_model->sql($this->company_id);
        $where = $sql['where'];
        //filter according to params
        $filter_data = $this->product_model->filter_products($where, $sql);
        $where = $filter_data['where'];
        $order = $filter_data['order'];
        $products = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $per_page, $offset);
        $total_rows = $this->common_model->count_rows($sql['table'], $where);
        $data = paginate($products, $total_rows, $offset, $per_page);
        json_response($data);
    }


    public function search_ajax() {
        $this->form_validation->set_rules('shop_search', 'Search term', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $search = urlencode(xpost('shop_search'));
        json_response(['redirect' => 'shop?search='.$search]);
    }


    public function feat_products_ajax() { 
        $cat_id = $this->input->post('cat_id', TRUE); 
        $sql = $this->product_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['FIND_IN_SET('.TAG_FEATURED.', p.tags)' => '']);
        $data = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 12);
        json_response($data);
    }


    public function cat_products_ajax() { 
        $cat_id = $this->input->post('cat_id', TRUE); 
        $sql = $this->product_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['cat_id' => $cat_id]);
        $data = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 8);
        json_response($data);
    }


    public function view($id, $title = '') {
        $sql = $this->product_model->sql($this->company_id);
        $row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where']);
        $this->web_header($row->name);
        //related products
        $sql = $this->product_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['cat_id' => $cat_id]);
        $related_products = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 8);
        $data['row'] = $row;
        $data['related_products'] = $related_products;
        $this->load->view('web/shop/view', $data);
        $this->web_footer();
    }
    
}