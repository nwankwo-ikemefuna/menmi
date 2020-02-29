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
        $select = "p.id, p.name, p.description, p.cat_id, cat.name AS category, p.barcode, p.serial_no, p.stock, p.price, p.price_old, p.rating,
            ".price_select('curr.code', 'p.price', 'amount').", 
            ".price_select('curr.code', 'p.price_old', 'amount_old').", 
            p.tags, GROUP_CONCAT(DISTINCT `t`.`title` SEPARATOR ', ') AS tag_names, 
            p.p_tags, GROUP_CONCAT(DISTINCT `pt`.`name` SEPARATOR ', ') AS p_tag_names, 
            p.size, s.short_name AS size_short_name, s.name AS size_name, p.colors, 
            GROUP_CONCAT(DISTINCT CONCAT('#', `c`.`code`) SEPARATOR ', ') AS color_codes,
            GROUP_CONCAT(DISTINCT `c`.`name` SEPARATOR ', ') AS color_names,
            p.image, p.images,
            ".file_select(COMPANY_PIX_DIR, 'm.pix_dir', 'p.image', 'image_file');
        $joins = [
            T_COMPANIES.' comp' => ['comp.id = '.$company_id, 'inner'],
            T_MODULES.' m' => ['m.id = '.M_PRODUCTS, 'inner'],
            T_PRODUCT_CATS.' cat' => ['cat.id = p.cat_id', 'inner'],
            T_PRODUCT_SIZES.' s' => ['s.id = p.size'],
            T_CURRENCIES.' curr' => ['curr.id = comp.curr_id', 'inner'],
            T_TAGS.' t' => ['FIND_IN_SET(`t`.`id`, `p`.`tags`) > 0', 'left', false],
            T_PRODUCT_TAGS.' pt' => ['FIND_IN_SET(`pt`.`id`, `p`.`p_tags`) > 0', 'left', false],
            T_COLORS.' c' => ['FIND_IN_SET(`c`.`id`, `p`.`colors`) > 0', 'left', false]
        ];
        $where = ['p.company_id' => $company_id];
        return sql_data(T_PRODUCTS.' p', $joins, $select, $where);
    }


    public function cats_sql($company_id) {
        $select = 'cat.id, cat.name, cat.order, COUNT(p.cat_id) AS product_count';
        $joins = [T_PRODUCTS.' p' => ['p.cat_id = cat.id']];
        $where = ['cat.company_id' => $company_id];
        return sql_data(T_PRODUCT_CATS.' cat', $joins, $select, $where, ['cat.order' => 'asc']);
    }


    public function sizes_sql($company_id) {
        $select = 's.id, s.short_name, s.name, s.order, COUNT(p.size) AS product_count';
        $joins = [T_PRODUCTS.' p' => ['p.size = s.id']];
        $where = ['s.company_id' => $company_id];
        return sql_data(T_PRODUCT_SIZES.' s', $joins, $select, $where, ['s.order' => 'asc']);
    }


    public function colors_sql($company_id) {
        $select = "c.id, c.name, c.order, CONCAT('#', code) AS color_code, COUNT(p.colors) AS product_count";
        $joins = [T_PRODUCTS.' p' => ['FIND_IN_SET(`c`.`id`, `p`.`colors`) > 0', 'inner', false]];
        $where = ['p.company_id' => $company_id];
        return sql_data(T_COLORS.' c', $joins, $select, $where, ['c.order' => 'asc'], 'c.id');
    }


    public function tags_sql($company_id) {
        $select = "t.id, t.short_name, t.name, t.order, COUNT(DISTINCT p.p_tags) AS product_count";
        $joins = [T_PRODUCTS.' p' => ['FIND_IN_SET(`t`.`id`, `p`.`p_tags`) > 0', 'left', false]];
        $where = ['t.company_id' => $company_id];
        return sql_data(T_PRODUCT_TAGS.' t', $joins, $select, $where, ['t.order' => 'asc'], 't.id');
    }

}