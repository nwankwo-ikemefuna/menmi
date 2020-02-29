<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Order_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql($company_id, $status = '') {
        //order details
        $select = "o.id, COUNT(od.order_id) AS product_count, o.customer_id,".
            full_name_select('customer', true, 'customer_name').",
            o.ref_id, o.status, os.title AS order_status, os.bs_bg AS order_status_bg,
            o.comment, o.paid, IF(o.paid=1, 'Yes', 'No') AS has_paid, o.amount_paid,".
            price_select('curr.code', 'o.amount_paid', 'amount_paid_name').", o.date_paid,".
            datetime_select('o.date_paid', 'paid_on').",
            o.payment_mode, IF(o.paid=1, pms.title, NULL) AS payment_mode_name, o.payment_ref_id, o.payment_notes, o.processed_by,".
            full_name_select('processor', true, 'processed_by_name').", o.date_processed, ".
            datetime_select('o.date_processed', 'processed_on').", ".
            datetime_select('o.date_created', 'placed_on');
        //shipping details
        $select .= ", " . full_name_select('o', true, 'ship_name', 'ship_').",
            o.ship_email, o.ship_phone, o.ship_state, s_state.name AS ship_state_name, o.ship_address, o.ship_apartment, o.ship_extra";
        $joins = [
            T_MODULES.' m' => ['m.id = '.M_ORDERS, 'inner'],
            T_COMPANIES.' comp' => ['comp.id = '.$company_id],
            T_CURRENCIES.' curr' => ['curr.id = comp.curr_id', 'inner'],
            T_USERS.' customer' => ['customer.id = o.customer_id', 'inner'],
            T_USERS.' processor' => ['processor.id = o.processed_by'],
            T_STATUS.' os' => ['os.id = o.status'],
            T_STATUS.' pms' => ['pms.id = o.payment_mode'],
            T_ORDER_DETAILS.' od' => ['o.id = od.order_id'],
            T_STATES.' s_state' => ['s_state.id = o.ship_state']
        ];
        $where = [];
        if (strlen($status))  
            $where = ['o.status' => $status];
        return sql_data(T_ORDERS.' o', $joins, $select, $where);
    }


    public function details_sql($company_id, $order_id, $status = '') {
        $select = "od.id, od.order_id, od.product_id, p.name AS product_name, cat.name AS category, s.name AS size_name, c.name AS color_name, od.qty, p.stock, p.price AS current_price, od.price,".
            price_select('curr.code', 'od.price', 'amount_paid').",".
            price_select('curr.code', 'p.price', 'current_amount').",
            od.status, IF(od.status=0, 'Unprocessed', 'Processed') AS item_status, od.comment,".
            file_select(COMPANY_PIX_DIR, 'm.pix_dir', 'p.image', 'image_file');
        $joins = [
            T_COMPANIES.' comp' => ['comp.id = '.$company_id],
            T_MODULES.' m' => ['m.id = '.M_PRODUCTS, 'inner'],
            T_CURRENCIES.' curr' => ['curr.id = comp.curr_id', 'inner'],
            T_ORDERS.' o' => ['o.id = od.order_id', 'inner'],
            T_PRODUCTS.' p' => ['p.id = od.product_id', 'inner'],
            T_PRODUCT_CATS.' cat' => ['cat.id = p.cat_id', 'inner'],
            T_PRODUCT_SIZES.' s' => ['s.id = p.size'],
            T_COLORS.' c' => ['c.id = od.color'],
        ];
        $where = ['od.order_id' => $order_id];
        if (strlen($status))  
            $where = array_merge($where, ['od.status' => $status]);
        return sql_data(T_ORDER_DETAILS.' od', $joins, $select, $where);
    }

}