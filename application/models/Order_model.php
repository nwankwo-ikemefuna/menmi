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
        $select = "o.id, COUNT(od.order_id) AS product_count,
            o.ref_id, o.status, os.title AS order_status, os.bs_bg AS order_status_bg, o.comment, o.paid, IF(o.paid=1, 'Yes', 'No') AS has_paid, o.amount_paid,".
            price_select('curr.code', 'o.amount_paid', 'amount_paid_name').", o.date_paid,".
            datetime_select('o.date_paid', 'paid_on').",
            o.payment_mode, IF(o.paid=1, pms.title, NULL) AS payment_mode_name, p.tranx_ref AS payment_ref_id, o.payment_notes, o.processed_by,".
            full_name_select('pro', true, 'processed_by_name').", o.date_processed, ".
            datetime_select('o.date_processed', 'processed_on').", ".
            datetime_select('o.date_created', 'placed_on');
        //customer details
        $select .= ", o.customer_id, c.email, c.phone, c.state, s_state.name AS state_name, c.address, c.apartment,".
            full_name_select('c', true, 'customer_name');
        //shipping details
        $select .= ", o.ship_email, o.ship_phone, o.ship_state, s_state.name AS ship_state_name, o.ship_address, o.ship_apartment, o.ship_extra, o.ship_is_bill, ".
            full_name_select('o', true, 'ship_name', 'ship_');
        $joins = [
            T_MODULES.' m' => ['m.id = '.M_ORDERS, 'inner'],
            T_COMPANIES.' comp' => ['comp.id = '.$company_id],
            T_CURRENCIES.' curr' => ['curr.id = comp.curr_id', 'inner'],
            T_USERS.' c' => ['c.id = o.customer_id', 'inner'],
            T_USERS.' pro' => ['pro.id = o.processed_by'],
            T_STATUS.' os' => ['os.id = o.status'],
            T_STATUS.' pms' => ['pms.id = o.payment_mode'],
            T_ORDER_DETAILS.' od' => ['o.id = od.order_id'],
            T_PAYMENTS.' p' => ['p.id = o.payment_id'],
            T_STATES.' s_state' => ['s_state.id = o.ship_state']
        ];
        $where = [];
        if (strlen($status))  
            $where = ['o.status' => $status];
        return sql_data(T_ORDERS.' o', $joins, $select, $where);
    }


    public function details_sql($company_id, $order_id, $status = '') {
        $select = "od.id, od.order_id, od.product_id, p.name AS product_name, cat.name AS category, s.name AS size_name, c.name AS color_name, od.qty, p.stock, p.price AS current_price, od.price, od.deducted, ".
            price_select('curr.code', 'od.price', 'purchase_price').",".
            price_select('curr.code', 'p.price', 'current_price').",
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


    public function payment_status($company_id) {
        //this is necessary since the 0 option will return null
        $status = strlen(xpost('status')) ? 1 : 0;
        $data = ['paid' => $status];
        $id = xpost('id');
        //is it bulk? let's check for comma in id field
        if (preg_match('/,/', $id)) {
            $record_idx = explode(',', $id);
            foreach ($record_idx as $rec_id) {
                $updated = $this->update(T_ORDERS, $data, ['id' => intval($rec_id)]);
                if ($updated > 0) {
                    if ($status == 1) {
                        //deduct from product inventory
                        $this->update_stock_bulk($company_id, $rec_id, 'deduct');
                    }
                }
            }
        } else {
            $updated = $this->update(T_ORDERS, $data, ['id' => intval($id)]);
            if ($updated > 0) {
                if ($status == 1) {
                    //deduct from product inventory
                    $this->update_stock_bulk($company_id, $id, 'deduct');
                }
            }
        }
    }


    public function update_stock($company_id, $id, $operation = 'deduct') {
        //get order items
        $sql = $this->order_model->details_sql($company_id, $id);
        $row = $this->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
        //add or deduct
        if ($operation == 'deduct') {
            //has stock been deducted already?
            if ($row->deducted == 1) return 0;
            //update order items to reflect deduction
            $this->update(T_ORDER_DETAILS, ['deducted' => 1], ['id' => $row->id]);
            //update products to reflect inventory
            $new_stock = $row->stock - $row->qty;
            $this->update(T_PRODUCTS, ['stock' => $new_stock], ['id' => $row->product_id]);
        }
    }


    public function update_stock_bulk($company_id, $order_id, $operation = 'deduct') {
        //get order items
        $sql = $this->order_model->details_sql($company_id, $order_id);
        $items = $this->get_rows($sql['table'], $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
        foreach ($items as $row) {
            //add or deduct
            if ($operation == 'deduct') {
                //has stock been deducted already?
                if ($row->deducted == 1) continue;
                //update order items to reflect deduction
                $this->update(T_ORDER_DETAILS, ['deducted' => 1], ['id' => $row->id]);
                //update products to reflect inventory
                $new_stock = $row->stock - $row->qty;
                $this->update(T_PRODUCTS, ['stock' => $new_stock], ['id' => $row->product_id]);
            }
        }
    }


    public function total_orders($status = '', $where = []) {
        $where = strlen($status) ? ['status' => $status] : [];
        $where = !empty($where) ? array_merge($where, $where) : $where;
        return $this->count_rows(T_ORDERS, $where, 0);
    }

}