<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Common_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }

    public function sliders_sql($company_id) {
    	$select = "s.id, s.name, s.message, s.tag, s.image, s.url, s.btn_text, ".file_select(COMPANY_PIX_DIR, 'm.pix_dir', 's.image', 'image_file');
        $joins = [T_MODULES.' m' => ['m.id = '.M_SLIDERS, 'inner']];
        $where = ['s.company_id' => $company_id];
        return sql_data(T_SLIDERS.' s', $joins, $select, $where, ['s.order' => 'asc']);
    }


    public function tags_sql() {
    	$select = "id, name, title";
        return sql_data(T_TAGS, [], $select, [], ['s.order' => 'asc']);
    }


    public function colors_sql() {
    	$select = "id, name, CONCAT('#', code) AS code";
        return sql_data(T_COLORS, [], $select, [], ['s.order' => 'asc']);
    }

}