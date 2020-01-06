<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Template_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql($where_extra = []) {
        $select = 'tem.id, tem.name, tem.vat, COUNT(itm.template_id) AS total_items';
        $joins = [T_ITEMS.' itm' => ['tem.id = itm.template_id', 'inner']];
        $where = [
            'tem.company_id' => $this->session->user_company_id,
            'tem.user_id' => $this->session->user_id
        ];
        return sql_data(T_TEMPLATES.' tem', $joins, $select, $where, $where_extra);
    }


    public function item_sql($id, $where_extra = []) {
        $select = 'itm.id, itm.cat_id, itm.template_id, itm.name, tem.name AS template, cat.name AS category';
        $joins = [
            T_TEMPLATES.' tem' => ['tem.id = itm.template_id', 'inner'], 
            T_ITEM_CATEGORIES.' cat' => ['cat.id = itm.cat_id']
        ];
        $where = [
            'itm.company_id' => $this->session->user_company_id,
            'itm.user_id' => $this->session->user_id,
            'itm.template_id' => $id
        ];
        return sql_data(T_ITEMS.' itm', $joins, $select, $where, $where_extra);
    }


    public function cat_sql($where_extra = []) {
        $select = 'cat.*, COUNT(itm.cat_id) AS total_items';
        $joins = [T_ITEMS.' itm' => ['cat.id = itm.cat_id']];
        $where = [
            'cat.company_id' => $this->session->user_company_id,
            'cat.user_id' => $this->session->user_id
        ];
        return sql_data(T_ITEM_CATEGORIES.' cat', $joins, $select, $where, $where_extra);
    }

}