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
        IFNULL(s.home_banner, 1) home_banner,
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


    public function company_details($id) {
        $sql = $this->sql($id);
        $row = $this->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where'], $sql['group_by']);
        if ( ! $row) return;
        $fields = $tables = $this->db->list_fields(T_COMPANIES);
        $data = [];
        //create keys from column names with prefix: company_
        foreach ($fields as $field) {
            $field_key = 'company_' . $field;
            $data[$field_key] = $row->$field;
        }
        $data = array_merge($data, [
            'company_currency' => get_currency_symbol($row->curr_code),
            'company_currency_name' => $row->curr_name,
            'company_owner_fullname' => $row->full_name,
            'company_home_banner' => $row->home_banner,
            'company_home_slider' => $row->home_slider,
            'company_shop_slider' => $row->shop_slider,
            'company_sidebar_slider' => $row->sidebar_slider,
            'company_shop_sidebar_position' => $row->shop_sidebar_position,
            'company_blog_sidebar_position' => $row->blog_sidebar_position,
            'company_logo_site_file' => $row->s_logo,
            'company_logo_portal_file' => $row->p_logo
        ]);
        return $data;
    }

}