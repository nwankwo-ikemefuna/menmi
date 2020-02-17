<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Company_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql($company_id) {
    	$select = "c.*, cu.name AS curr_name, cu.code AS curr_code, 
        IFNULL(s.home_slider, 1) home_slider,
        IFNULL(s.shop_slider, 1) shop_slider,
        IFNULL(s.sidebar_slider, 1) sidebar_slider,
        IFNULL(s.shop_sidebar_position, 'left') shop_sidebar_position,
        IFNULL(s.blog_sidebar_position, 'right') blog_sidebar_position,".
    	full_name_select('u').", ".
    	file_select(COMPANY_PIX_DIR, 'm.pix_dir', 'c.logo_site', 's_logo').", ".
    	file_select(COMPANY_PIX_DIR, 'm.pix_dir', 'c.logo_portal', 'p_logo');
		$joins = [
			T_MODULES.' m' => ['m.id = '.M_SETTINGS, 'inner'],
			T_USERS.' u' => ['c.owner_id = u.id'], 
			T_CURRENCIES.' cu' => ['c.curr_id = cu.id'],
            T_SETTINGS.' s' => ['s.company_id = c.id']
		];
		$where = ['c.id' => $company_id];
        return sql_data(T_COMPANIES.' c', $joins, $select, $where, [], 'c.id, s.id');
    }

}