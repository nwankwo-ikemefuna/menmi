<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Shop_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql() {
        $sql = $this->product_model->sql($this->company_id);
        //exclude sold out products?
        // $where = array_merge($sql['where'], ['p.stock > ' => 0]);
        return sql_data($sql['table'], $sql['joins'], $sql['select'], $sql['where']);
    }


    private function sort($sort_by) {
        switch ($sort_by) {
            case 'newest':
                $order = ['p.date_created' => 'desc'];
                break;
            case 'price_low':
                $order = ['p.price' => 'asc'];
                break;
            case 'price_high':
                $order = ['p.price' => 'desc'];
                break;
            case 'rated':
                $order = ['p.rating' => 'desc'];
                break;         
            case 'popular':
            default:
                $order = ['FIND_IN_SET('.TAG_FEATURED.', p.tags) DESC' => ''];
                break;
        }
        return $order;
    }


    private function search() {
        $search = xpost('search');
        $where = sprintf("(
            p.`name` LIKE '%s' OR
            p.`barcode` LIKE '%s' OR
            p.`serial_no` LIKE '%s' OR
            p.`description` LIKE '%s')",
            "%{$search}%", "%{$search}%", "%{$search}%", "%{$search}%"
        );
        return $where;
    }


    private function filter($where, $sql) {
        //search term
        if (strlen(xpost('search'))) {
            $this_where = $this->search();
            $where = array_merge($where, [$this_where => null]);
        } 
        //price
        if (strlen(xpost('price_min')) && strlen(xpost('price_max'))) {
            $price_min = xpost('price_min');
            $price_max = xpost('price_max');
            $this_where = ['p.price >=' => $price_min, 'p.price <=' => $price_max];
            $where = array_merge($where, $this_where);
        } 
        //categories
        if ( ! empty(xpost('cat_idx'))) {
            $cat_idx = join_us(xpost('cat_idx'));
            $this_where = "FIND_IN_SET(p.cat_id, '{$cat_idx}') > 0";
            $where = array_merge($where, [$this_where => null]);
        } 
        //sizes
        if ( ! empty(xpost('sizes'))) {
            $sizes = join_us(xpost('sizes'));
            $this_where = "FIND_IN_SET(p.size, '{$sizes}') > 0";
            $where = array_merge($where, [$this_where => null]);
        } 
        //min rating
        if ( ! empty(xpost('min_rating'))) {
            $min_rating = xpost('min_rating');
            $this_where = ['p.rating >=' => $min_rating];
            $where = array_merge($where, $this_where);
        } 
        //colors
        if ( ! empty(xpost('colors'))) {
            $colors = xpost('colors');
            $this_where = find_in_set_mult($colors, 'p.colors');
            $where = array_merge($where, [$this_where => null]);
        } 
        //sorting
        $order = strlen(xpost('sort_by')) ? $this->sort(xpost('sort_by')) : $sql['order'];
        $data = ['where' => $where, 'order' => $order];
        return $data;
    }


    public function products_shop($offset, $limit) {
        $sql = $this->sql();
        $where = $sql['where'];
        //filter according to params
        $filter_data = $this->filter($where, $sql);
        $where = $filter_data['where'];
        $order = $filter_data['order'];
        //products of what type?
        switch (xpost('list_type')) {

            //wishlist
            case 'wishlist':
                $records = $this->wishlist([], $where, $order, $limit, $offset);
                $total_rows = $this->wishlist([], $where, $order, '', '', true);
                break;

            //viewed products
            case 'viewed':
                $records = $this->viewed([], $where, $order, $limit, $offset);
                $total_rows = $this->viewed([], $where, $order, '', '', true);
                break;

            //featured products
            case 'featured':
                $records = $this->featured($where, $order, $limit, $offset);
                $total_rows = $this->featured($where, $order, '', '', true);
                break;

            //related products
            case 'related':
                $records = $this->related(xpost('rel_id'), xpost('rel_tags'), $where, $order, $limit, $offset);
                $total_rows = $this->related(xpost('rel_id'), xpost('rel_tags'), $where, $order, '', '', true);
                break;

            //tag products
            case 'tagged':
                $records = $this->tagged($where, $order, $limit, $offset);
                $total_rows = $this->tagged($where, $order, '', '', true);
                break;

            //shop
            default:
                $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
                $records = $this->prepare_items($products);
                // last_sql(false);
                $total_rows = $this->common_model->count_rows($sql['table'], $where);
                break;
        }
        $data = ['records' => $records, 'total_rows' => $total_rows];
        return $data;
    }


    private function prepare_items($products) {
        $data = [];
        $products = is_array($products) ? $products : (array) $products;
        foreach ($products as $row) {
            //is item in cart or wishlist?
            $cart = $this->session->tempdata('cart_products') ?? [];
            $wishlist = $this->session->tempdata('wishlist_products') ?? [];
            $in_cart = array_key_exists($row['id'], $cart) ? 1 : 0;
            $in_wishlist = array_key_exists($row['id'], $wishlist) ? 1 : 0;
            $data[] = array_merge($row, ['in_cart' => $in_cart, 'in_wishlist' => $in_wishlist]);
        }
        return $data;
    }



    public function cart() {
        //TODO: fetch cart from db
        $cart = $this->session->tempdata('cart_products');
        if (empty($cart)) return [];
        $sql = $this->sql();
        $product_idx = join_us(array_keys($cart));
        $this_where = "FIND_IN_SET(p.id, '{$product_idx}') > 0";
        $where = array_merge($sql['where'], [$this_where => null]);
        $limit = strlen(xpost('limit')) ? xpost('limit') : '';
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where,  $sql['order'], '', $limit, 0, 'array');
        $data = [];
        foreach ($products as $row) {
            //if stock is 0 (sold out), jump and pass 
            // if ($row['stock'] < 1) continue;
            //apend qty and calculate product total price
            $qty = intval($cart[$row['id']]);
            //if qty requested exceeds stock, adjust accordingly
            $qty = $qty > $row['stock'] ? $row['stock'] : $qty;
            //product total
            $product_total_price = $row['price'] * $qty;
            //append
            $append = [
                'qty' => $qty, 
                'product_total_price' => $product_total_price, 
                'product_total_amount' => $this->company_curr.number_format($product_total_price)
            ];
            $data[] = array_merge($row, $append);
        }
        return $data;
    }


    public function cat_products($cat_id, $xtra_where = [], $order = 'rand', $limit = 8, $offset = 0, $count_all = false) {
        $sql = $this->sql();
        $where = array_merge($sql['where'], ['cat_id' => $cat_id], $xtra_where);
        //return total rows regardless of limit
        if ($count_all) {
            return $this->count_rows($sql['table'], $where);
        }
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
        return $this->prepare_items($products);
    }


    public function tagged($xtra_where = [], $order = 'rand', $limit = 8, $offset = 0, $count_all = false) {
        $sql = $this->sql();
        $tag_id = intval(xpost('tag'));
        $this_where = "FIND_IN_SET({$tag_id}, p.p_tags) > 0";
        $where = array_merge($sql['where'], [$this_where => null]);
        //return total rows regardless of limit
        if ($count_all) {
            return $this->count_rows($sql['table'], $where);
        }
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
        return $this->prepare_items($products);
    }


    public function featured($xtra_where = [], $order = 'rand', $limit = 8, $offset = 0, $count_all = false) {
        $sql = $this->sql();
        $where = array_merge($sql['where'], ['FIND_IN_SET('.TAG_FEATURED.', p.tags)' => null], $xtra_where);
        //return total rows regardless of limit
        if ($count_all) {
            return $this->count_rows($sql['table'], $where);
        }
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
        return $this->prepare_items($products);
    }


    public function related($id, $tags, $xtra_where = [], $order = 'rand', $limit = 8, $offset = 0, $count_all = false) {
        $sql = $this->sql();
        $this_where = find_in_set_mult($tags, 'p.p_tags');
        $where = !empty($this_where) ? array_merge($sql['where'], ['p.id !=' => $id, $this_where => null], $xtra_where) : [];
        //return total rows regardless of limit
        if ($count_all) {
            return $this->count_rows($sql['table'], $where);
        }
        if ( ! strlen($tags)) return [];
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
        return $this->prepare_items($products);
    }


    public function wishlist($exclude = [], $xtra_where = [], $order = 'rand', $limit = 8, $offset = 0, $count_all = false) {
        $items = $this->session->tempdata('wishlist_products') ?? [];
        //exclude excludables
        $product_idx = [];
        foreach ($items as $product_id => $date_added) {
            //in exclude? jump and pass
            if (in_array($product_id, $exclude)) continue;
            //the ones that got away...
            $product_idx[] = $product_id;
        }
        //after all exclusions, are we left with anything?
        $sql = $this->sql();
        $product_idx = join_us($product_idx);
        $this_where = "FIND_IN_SET(p.id, '{$product_idx}') > 0";
        $where = array_merge($sql['where'], [$this_where => null], $xtra_where);
        //return total rows regardless of limit
        if ($count_all) {
            return $this->count_rows($sql['table'], $where);
        }
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
        return $this->prepare_items($products);
    }


    public function viewed($exclude = [], $xtra_where = [], $order = 'rand', $limit = 8, $offset = 0, $count_all = false) {
        $items = $this->session->tempdata('viewed_products') ?? [];
        //exclude excludables
        $product_idx = [];
        foreach ($items as $product_id => $date_viewed) {
            //in exclude? jump and pass
            if (in_array($product_id, $exclude)) continue;
            //date viewed is older than TTL? ditto
            if (time() - strtotime($date_viewed) > strtotime(CART_TTL.' day', 0)) continue;
            //the ones that got away...
            $product_idx[] = $product_id;
        }
        $sql = $this->sql();
        $product_idx = join_us($product_idx);
        $this_where = "FIND_IN_SET(p.id, '{$product_idx}') > 0";
        $where = array_merge($sql['where'], [$this_where => null], $xtra_where);
        //return total rows regardless of limit
        if ($count_all) {
            return $this->count_rows($sql['table'], $where);
        }
        $products = $this->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $order, '', $limit, $offset, 'array');
        return $this->prepare_items($products);
    }


    public function submit_customer_data() {
        $customer_data = [
            'usergroup' => CUSTOMER,
            //billing
            'first_name' => ucwords(xpost('first_name')),
            'last_name' => ucwords(xpost('last_name')),
            'email' => xpost('email'),
            'phone' => xpost('phone'),
            'apartment' => xpost('apartment'),
            'state' => xpost('state'),
            'address' => ucwords(xpost('address')),
            //shipping
            'ship_first_name' => ucwords(xpost('ship_first_name')),
            'ship_last_name' => ucwords(xpost('ship_last_name')),
            'ship_email' => xpost('ship_email'),
            'ship_phone' => xpost('ship_phone'),
            'ship_apartment' => xpost('ship_apartment'),
            'ship_state' => xpost('ship_state'),
            'ship_address' => ucwords(xpost('ship_address')),
            //others
            'ship_is_bill' => xpost('ship_is_bill'),
            'payment_method' => xpost('payment_method'),
            'ship_extra' => ucwords(xpost('ship_extra')),
        ];
        
        //does customer already have an account?
        $customer_record = $this->user_model->get_user(xpost('email'), 'email', CUSTOMER);
        if (empty($customer_record)) {
            //customer profile not found, we insert
            $customer_id = $this->common_model->insert(T_USERS, $customer_data);
        } else {
            //customer profile found, we update
            $this->common_model->update(T_USERS, $customer_data, ['email' => xpost('email')]);
            $customer_id = $customer_record->id;
        }
        return $customer_id;
    }


    public function submit_order($customer_id) { 
        $order_data = [
            'customer_id' => $customer_id,
            'status' => ST_ORDER_PENDING,
            'paid' => 0,
            'payment_mode' => xpost('payment_method'),
            //submit shipping details, as the customer could change this on their profile anytime
            //shipping
            'ship_first_name' => ucwords(xpost('ship_first_name')),
            'ship_last_name' => ucwords(xpost('ship_last_name')),
            'ship_email' => xpost('ship_email'),
            'ship_phone' => xpost('ship_phone'),
            'ship_apartment' => xpost('ship_apartment'),
            'ship_state' => xpost('ship_state'),
            'ship_address' => ucwords(xpost('ship_address')),
            'ship_extra' => ucwords(xpost('ship_extra')) 
        ];
        $order_id = $this->insert(T_ORDERS, $order_data);
        //update ref order id: attact RF+order_id to unique id from time
        $ref_id = strtoupper(uniqid('RF'.$order_id));
        //save in session
        $this->session->set_tempdata('order_ref_id', $ref_id, CHECKOUT_TTL);
        $this->update(T_ORDERS, ['ref_id' => $ref_id], ['id' => $order_id]);
        if ($order_id < 1) return false;
        //get items in cart
        $products = $this->cart();
        $details_data = [];
        foreach ($products as $row) {
            $order_details = [
                'order_id' => $order_id,
                'product_id' => $row['id'],
                'qty' => $row['qty'],
                'price' => $row['price'], //price at the point of order
                'color' => '', //TODO: account for this
                'status' => 0
            ];
            $details_data[] = $order_details;
        }
        $exec = $this->insert_batch(T_ORDER_DETAILS, $details_data);
        return $exec > 0;
    }

}