<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Slider_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql($company_id) {
    	$select = "s.id, s.name, s.image, s.url, s.cat_id, cat.title AS category, s.order,".
    	file_select(COMPANY_PIX_DIR, 'm.pix_dir', 's.image', 'image_file');
        $joins = [
        	T_MODULES.' m' => ['m.id = '.M_SLIDERS, 'inner'],
        	T_SLIDER_CATS.' cat' => ['cat.id = s.cat_id', 'inner'],
        ];
        $where = ['s.company_id' => $company_id];
        return sql_data(T_SLIDERS.' s', $joins, $select, $where, ['s.order' => 'asc']);
    }


    public function cats_sql($company_id) {
        $select = 'cat.id, cat.name, cat.title, cat.order, COUNT(s.cat_id) AS slider_count';
        $joins = [T_SLIDERS.' s' => ['s.cat_id = cat.id']];
        return sql_data(T_SLIDER_CATS.' cat', $joins, $select, [], ['cat.order' => 'asc']);
    }

}