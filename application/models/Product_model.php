<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Product_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql() {
        $select = "p.id, p.name, p.cat_id, p.barcode, p.serial_no, p.stock, ".price_select('curr.code', 'p.price', 'amount', 2).", ".price_select('curr.code', 'p.price_old', 'amount_old', 2).", p.image, p.images, 
            GROUP_CONCAT(`t`.`title` SEPARATOR ', ') AS tags, 
            s.name AS size, c.name AS color, m.pix_dir";
        $joins = [
            T_MODULES.' m' => ['m.id = '.M_PRODUCTS, 'inner'],
            T_PRODUCT_CATEGORIES.' cat' => ['cat.id = p.cat_id', 'inner'],
            '(SELECT `id`, `title` FROM `'.T_TAGS.'`) t' => ['FIND_IN_SET(`t`.`id`, `p`.`tags`)', 'left', false],
            T_SIZES.' s' => ['s.id = p.size'],
            T_COLORS.' c' => ['c.id = p.color'],
            T_CURRENCIES.' curr' => ['curr.id = '.$this->session->company_curr_id]
        ];
        $where = ['p.company_id' => $this->session->company_id];
        return sql_data(T_PRODUCTS.' p', $joins, $select, $where);
    }


    public function cat_sql() {
        $select = 'cat.id, cat.name, COUNT(p.cat_id) AS product_count';
        $joins = [T_PRODUCTS.' p' => ['p.cat_id = cat.id']];
        $where = ['p.company_id' => $this->session->company_id];
        return sql_data(T_PRODUCT_CATEGORIES.' cat', $joins, $select, $where);
    }

}