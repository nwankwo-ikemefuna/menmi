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
        $products = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $per_page, $offset, 'array');
        $data = [];
        foreach ($products as $row) {
            //is item in cart?
            $cart = $this->session->tempdata('cart_products') ?? [];
            $in_cart = array_key_exists($row['id'], $cart) ? 1 : 0;
            $data[] = array_merge($row, ['in_cart' => $in_cart]);
        }
        $total_rows = $this->common_model->count_rows($sql['table'], $where);
        $data = paginate($data, $total_rows, $offset, $per_page);
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
        $this->check_company_data(T_PRODUCTS, $id);
        $this->show_sidebar = false;
        $this->bcrumbs = ['Shop' => 'shop'];
        $sql = $this->product_model->sql($this->company_id);
        $row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where']);
        $this->web_header($row->name);
        $data['row'] = $row;
        $cart = $this->session->tempdata('cart_products') ?? [];
        $data['in_cart'] = array_key_exists($row->id, $cart) ? 1 : 0;
        $data['related_products'] = strlen($row->p_tags) ? $this->product_model->related($this->company_id, $id, $row->p_tags) : [];
        $this->load->view('web/shop/view', $data);
        $this->web_footer();
    }


    public function cart_ajax() { 
        // if cart is empty, create temp array data
        $cart = $this->session->tempdata('cart_products');
        //adding to or removing from cart?
        $type = xpost('type');
        if (strlen($type)) {
            switch ($type) {

                case 'add':
                    //append to product list
                    $cart[xpost('id')] = xpost('qty');
                    break;

                case 'update':
                    //update product list with new orders
                    $cart = xpost('orders');
                    break;

                case 'remove':
                    //remove from product list
                    unset($cart[xpost('id')]);
                    break;
                
                default:
                    break;
            }
            //set the tempdata with predefined TTL
            $this->session->set_tempdata('cart_products', $cart, CART_TTL);
        } 
        //fetch the products
        $products = $this->product_model->cart($this->company_id);
        $data['products'] = $products;
        $data['total_price'] = !empty($products) ? array_sum(array_column($products, 'price')) : 0;
        $data['total'] = count($products);
        $data['total_formatted'] = number_format($data['total']);
        json_response($data);
    }


    public function cart() {
        $this->show_sidebar = false;
        $this->bcrumbs = ['Shop' => 'shop'];
        $this->web_header('Cart');
        $this->load->view('web/shop/cart');
        $this->web_footer();
    }
    
}