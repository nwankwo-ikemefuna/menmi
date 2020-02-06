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


    public function sql($company_id) {
        $select = "p.id, p.name, p.cat_id, cat.name AS category, p.barcode, p.serial_no, p.stock, p.price, p.price_old, 
            ".price_select('curr.code', 'p.price', 'amount', 2).", 
            ".price_select('curr.code', 'p.price_old', 'amount_old', 2).", 
            p.tags, GROUP_CONCAT(`t`.`title` SEPARATOR ', ') AS tag_names, 
            p.size, s.name AS size_name, p.color, c.name AS color_name, 
            p.image, p.images,
            ".file_select(COMPANY_PIX_DIR, 'm.pix_dir', 'p.image', 'image_file');
        $joins = [
            T_COMPANIES.' comp' => ['comp.id = '.$company_id, 'inner'],
            T_MODULES.' m' => ['m.id = '.M_PRODUCTS, 'inner'],
            T_PRODUCT_CATS.' cat' => ['cat.id = p.cat_id', 'inner'],
            '(SELECT `id`, `title` FROM `'.T_TAGS.'`) t' => ['FIND_IN_SET(`t`.`id`, `p`.`tags`)', 'left', false],
            T_PRODUCT_SIZES.' s' => ['s.id = p.size'],
            T_COLORS.' c' => ['c.id = p.color'],
            T_CURRENCIES.' curr' => ['curr.id = comp.curr_id', 'inner']
        ];
        $where = ['p.company_id' => $company_id];
        return sql_data(T_PRODUCTS.' p', $joins, $select, $where);
    }


    public function cats_sql($company_id = null) {
        $select = 'cat.id, cat.name, cat.order, COUNT(p.cat_id) AS product_count';
        $joins = [T_PRODUCTS.' p' => ['p.cat_id = cat.id']];
        $where = ['cat.company_id' => $company_id];
        return sql_data(T_PRODUCT_CATS.' cat', $joins, $select, $where);
    }


    public function sizes_sql($company_id = null) {
        $select = 's.id, s.name, s.order, COUNT(p.cat_id) AS product_count';
        $joins = [T_PRODUCTS.' p' => ['p.cat_id = s.id']];
        $where = ['s.company_id' => $company_id];
        return sql_data(T_PRODUCT_SIZES.' s', $joins, $select, $where);
    }


    /*public function delete($table, $where) {
        //get details
        $sql = $this->sql($this->company_id);
        $row = $this->common_model->get_row($sql['table'], $where['id'], 'id', 1, $sql['joins'], $sql['select'], $sql['where']);
        $images = split_us($row->images);
        // var_dump($images);
        $run = parent::delete($table, $where);
        if ($run) {
            //unlink images
            unlink_files(company_file_path(PIX_PRODUCTS), $images);
        }
    }*/

}