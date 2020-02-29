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
        $this->page_scripts = ['shop'];
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
        //categories
        $sql = $this->product_model->cats_sql($this->company_id);
        $data['product_cats'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
        //sizes
        $sql = $this->product_model->sizes_sql($this->company_id);
        $data['product_sizes'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
        //colors
        $sql = $this->product_model->colors_sql($this->company_id);
        $data['product_colors'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);
        //min and max price
        $sql = $this->shop_model->sql();
        $data['price_min'] = $this->common_model->get_aggr_row($sql['table'], 'min', 'price', $sql['where']);
        $data['price_max'] = $this->common_model->get_aggr_row($sql['table'], 'max', 'price', $sql['where']);
        $this->web_header($this->type_data('title'), 'shop');
        $this->load->view('web/shop/index', $data);
        $this->web_footer('shop');
    }


    private function type_data($key) {
        switch (xget('type')) {

            case 'wishlist':
                $data['title'] = 'My Wishlist';
                break;

            case 'viewed':
                $data['title'] = 'Viewed Products';
                break;

            case 'featured':
                $data['title'] = 'Featured Products';
                break;

            case 'related':
                $name = urldecode(xget('rel_name'));
                $link = '<a class="text-primary" href="'.product_url(xget('rel_id'), $name).'">'.$name.'</a>';
                $data['title'] = 'Related Products: '.$link;
                break;

            case 'tagged':
                $name = urldecode(xget('tag_name'));
                $data['title'] = 'Products Tagged: <span class="text-primary">'.$name.'</a>';
                break;
            
            default:
                $data['title'] = 'Shop';
                break;
        }
        return $data[$key];
    }


    public function products_ajax($page = 0) {
        $per_page = 8;
        $page = paginate_offset($page, $per_page);
        $items = $this->shop_model->products_shop($page, $per_page);
        $data = paginate($items['records'], $items['total_rows'], $per_page);
        json_response($data);
    }


    public function search_ajax() {
        $this->form_validation->set_rules('shop_search', 'Search term', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $search = urlencode(xpost('shop_search'));
        json_response(['redirect' => 'shop?search='.$search]);
    }


    public function cat_products_ajax() { 
        $data = $this->shop_model->cat_products(xpost('cat_id'));
        json_response($data);
    }


    public function view($id, $title = '') {
        $this->check_company_data(T_PRODUCTS, $id);
        $sql = $this->shop_model->sql();
        $row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where']);
        //lets (af)fix title
        verify_url_title($title, $row->name, product_url($id, $row->name));
        //add to viewed list
        //initialize viewed to empty array if not set
        $viewed = $this->session->tempdata('viewed_products') ?? [];
        if ( ! array_key_exists($id, $viewed)) {
            $viewed[$id] = date('Y-m-d H:i:s'); 
            $this->session->set_tempdata('viewed_products', $viewed, CART_TTL);
        }
        $this->bcrumbs = ['Shop' => 'shop'];
        $this->web_header($row->name);
        $data['row'] = $row;
        $cart = $this->session->tempdata('cart_products') ?? [];
        $wishlist = $this->session->tempdata('wishlist_products') ?? [];
        $data['in_cart'] = array_key_exists($row->id, $cart) ? 1 : 0;
        $data['in_wishlist'] = array_key_exists($row->id, $wishlist) ? 1 : 0;
        $data['related_products'] = $this->shop_model->related($id, $row->p_tags);
        $data['viewed_products'] = $this->shop_model->viewed([$id]);
        $data['tags'] = strlen($row->p_tags) ? array_combine(split_us($row->p_tags), split_us($row->p_tag_names)) : [];
        $this->load->view('web/shop/view', $data);
        $this->web_footer();
    }


    public function cart() {
        $this->bcrumbs = ['Shop' => 'shop'];
        $this->web_header('Cart');
        $data['viewed_products'] = $this->shop_model->viewed();
        $this->load->view('web/shop/cart', $data);
        $this->web_footer();
    }


    public function cart_ajax() { 
        //initialize cart to empty array if not set
        $cart = $this->session->tempdata('cart_products') ?? [];
        //ensure qty is specified and greater than 0, set as 1 otherwise
        $qty = intval(xpost('qty')) > 0 ? xpost('qty') : 1;
        //type of cart action
        $type = xpost('type');
        if (strlen($type)) {
            switch ($type) {

                case 'add':
                    if ( ! array_key_exists(xpost('id'), $cart)) {
                        //append to product list
                        $cart[xpost('id')] = $qty;
                        $this->session->set_tempdata('cart_products', $cart, CART_TTL);
                    }
                    break;

                case 'update':
                    //update product list
                    $cart = xpost('full_cart');
                    $this->session->set_tempdata('cart_products', $cart, CART_TTL);
                    break;

                case 'remove':
                    if (array_key_exists(xpost('id'), $cart)) {
                        //remove from product list
                        unset($cart[xpost('id')]);
                        $this->session->set_tempdata('cart_products', $cart, CART_TTL);
                    }
                    break;

                case 'empty':
                    //clear cart
                    $this->session->unset_tempdata('cart_products');
                    break;
            }
        } 
        $data = $this->cart_data();
        json_response($data);
    }


    private function cart_data() {
        $products = $this->shop_model->cart();
        $total_price = !empty($products) ? array_sum(array_column($products, 'product_total_price')) : 0;
        $data['products'] = $products;
        $data['total_price'] = intval($total_price);
        $data['total_amount'] = number_format($total_price);
        $data['total_products'] = count($products);
        $data['total_products_formatted'] = number_format(count($products));
        return $data;
    }


    public function wishlist_ajax() { 
        //initialize wishlist to empty array if not set
        $wishlist = $this->session->tempdata('wishlist_products') ?? [];
        $type = xpost('type');
        if (strlen($type)) {
            switch ($type) {

                case 'add':
                    if ( ! array_key_exists(xpost('id'), $wishlist)) {
                        //append to product list
                        $wishlist[xpost('id')] = date('Y-m-d H:i:s');
                        $this->session->set_tempdata('wishlist_products', $wishlist, CART_TTL);
                    }
                    break;

                case 'remove':
                    if (array_key_exists(xpost('id'), $wishlist)) {
                        //remove from product list
                        unset($wishlist[xpost('id')]);
                        $this->session->set_tempdata('wishlist_products', $wishlist_products, CART_TTL);
                    }
                    break;

                case 'empty':
                    //clear cart
                    $this->session->unset_tempdata('wishlist_products');
                    break;
            }
        } 
        //fetch the products
        $products = $this->shop_model->wishlist();
        $data['products'] = $products;
        $data['total_products'] = count($products);
        $data['total_products_formatted'] = number_format(count($products));
        json_response($data);
    }


    public function empty_wishlist($ajax = 0) { 
        $this->session->unset_tempdata('wishlist_products');
        if ($ajax == 1)
            json_response('Wishlist cleared');
        redirect('shop');
    }


    public function checkout() {
        //ensure user has items in cart
        if (empty($this->session->tempdata('cart_products'))) {
            $this->session->set_flashdata('error_msg', 'Your cart is empty. Please add products to your cart before you check out');
            redirect('shop');
        }
        $this->bcrumbs = ['Shop' => 'shop', 'Cart' => 'shop/cart'];
        $this->web_header('Checkout');
        if (customer_user()) { 
            $sql = $this->user_model->sql();
            $data['row'] = $this->common_model->get_row($sql['table'], $this->session->user_id, 'id', 0, $sql['joins'], $sql['select'], $sql['where']);
        } else {
            $data['row'] = [];
        }
        //states
        $data['states'] = $this->common_model->get_states(C_NIGERIA);
        $data['wishlist_products'] = $this->shop_model->wishlist();
        $data['viewed_products'] = $this->shop_model->viewed();
        $this->load->view('web/shop/checkout', $data);
        $this->web_footer('checkout');
    }


    public function checkout_ajax() {
        //billing address
        $this->form_validation->set_rules('first_name', 'Billing: First Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('last_name', 'Billing: Last Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('email', 'Billing: Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Billing: Phone No.', 'trim|required');
        $this->form_validation->set_rules('apartment', 'Billing: Apartment No.', 'trim|required');
        $this->form_validation->set_rules('state', 'Billing: State', 'trim|required');
        $this->form_validation->set_rules('address', 'Billing: Address', 'trim|required');
        //shipping address
        $ship_required = xpost('ship_is_bill') == 1 ? '' : '|required';
        $this->form_validation->set_rules('ship_first_name', 'Shipping: First Name', 'trim|max_length[25]'.$ship_required);
        $this->form_validation->set_rules('ship_last_name', 'Shipping: Last Name', 'trim|max_length[25]'.$ship_required);
        $this->form_validation->set_rules('ship_email', 'Shipping: Email', 'trim|valid_email'.$ship_required);
        $this->form_validation->set_rules('ship_phone', 'Shipping: Phone No.', 'trim'.$ship_required);
        $this->form_validation->set_rules('ship_apartment', 'Shipping: Apartment No.', 'trim'.$ship_required);
        $this->form_validation->set_rules('ship_state', 'Shipping: State', 'trim'.$ship_required);
        $this->form_validation->set_rules('ship_address', 'Shipping: Address', 'trim'.$ship_required);
        //others
        $this->form_validation->set_rules('ship_is_bill', 'Shipping Address Same as Billing', 'trim');
        $this->form_validation->set_rules('ship_extra', 'Additional Info', 'trim');
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');

        //order items validation
        $cart_change_msg = 'Your cart has been altered, please review items in your cart, update and try again';
        $this->form_validation->set_rules('total_price', 'Total Price', 'trim|required|greater_than[0]', ['required' => $cart_change_msg, 'greater_than' => $cart_change_msg]);
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        //is the total price of cart items at the time of order submission same as the current total price of the products?
        $cart = $this->cart_data();
        $current_total_price = $cart['total_price'];
        $order_total_price = intval(xpost('total_price'));
        if ($order_total_price !== $current_total_price)
            json_response($cart_change_msg, false);

        //submit custmer data
        $customer_id = $this->shop_model->submit_customer_data();
        //submit order
        $exec = $this->shop_model->submit_order($customer_id);
        //did it work?
        if ( ! $exec) 
            json_response('Unable to process your order at this time. Please try again.', false);

        //now we can clear cart
        $this->session->unset_tempdata('cart_products');

        //redirect to thank you page. If customer is not signed in, save email in session so we can ask for password update
        $this->session->set_tempdata('checkout_email', xpost('email'), CHECKOUT_TTL);
        json_response(['redirect' => 'shop/thank_you']);
    }


    public function thank_you() {
        //ensure user has just checked out
        if (empty($this->session->tempdata('checkout_email'))) {
            $this->session->set_flashdata('error_msg', 'You haven\'t checked out yet');
            redirect('shop/checkout');
        }
        $this->bcrumbs = ['Shop' => 'shop', 'Cart' => 'shop/cart', 'Checkout' => 'shop/checkout'];
        $this->web_header('Complete Checkout');
        $data['wishlist_products'] = $this->shop_model->wishlist();
        $data['viewed_products'] = $this->shop_model->viewed();
        $this->load->view('web/shop/thank_you', $data);
        $this->web_footer();
    }


    public function fetch_profile_ajax() { 
        //fetch customer profile on checkout page using email
        $data = $this->user_model->get_user(xpost('email'), 'email', CUSTOMER);
        json_response($data);
    }


    public function update_pass_ajax() { 
        //update customer account password using email saved in session
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_check_pass_strength');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[password]', ['matches'   => 'Passwords do not match']);
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        //ensure password 
        $email = $this->session->tempdata('checkout_email');
        $customer_record = $this->user_model->get_user($email, 'email', CUSTOMER);
        if ( ! $customer_record) 
            json_response('Profile not found!', false);
        if ($customer_record->password_set != 0) 
            json_response('Password already set for your account. If you have forgotten your password, click the <b>Forgot Password</b> link below to recover it.', false);
        $data = ['password' => password_hash(xpost('password'), PASSWORD_DEFAULT), 'password_set' => 1];
        $this->common_model->update(T_USERS, $data, ['email' => $email]);
        //clear checkout email
        $this->session->unset_tempdata('checkout_email');
        json_response('Password updated successfully');
    }


}