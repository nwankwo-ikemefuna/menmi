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

    public function sliders_sql() {
        $select = 's.id, s.name, s.message, s.tag, s.image, s.url, s.btn_text, m.pix_dir';
        $joins = [T_MODULES.' m' => ['m.id = '.M_SLIDERS, 'inner']];
        $where = ['s.company_id' => $this->session->company_id];
        return sql_data(T_SLIDERS.' s', $joins, $select, $where, ['s.order' => 'asc']);
    }

}