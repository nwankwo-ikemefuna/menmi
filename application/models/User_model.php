<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class User_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql($company_id = '') {
        $select = 'u.*, c.name AS company, g.title AS user_group_title, s.name as state_name,'
        .full_name_select('u');
		$joins = [
			T_USER_GROUPS.' g' => ['u.usergroup = g.id', 'inner'],
			T_COMPANIES.' c' => ['u.company_id = c.id'],
			T_STATES.' s' => ['u.state = s.id']
		];
		$where = strlen($company_id) ? ['s.company_id' => $company_id] : [];
		return sql_data(T_USERS.' u', $joins, $select, $where, ['s.order' => 'asc']);
    }

    
    public function get_user($id, $by = 'id', $usergroup = '', $where_extra = []) { 
        //fetch customer profile on cart page using email
        $sql = $this->user_model->sql();
        $where = strlen($usergroup) ? array_merge($sql['where'], ['u.usergroup' => $usergroup], $where_extra) : array_merge($sql['where'], $where_extra);
        $row = $this->common_model->get_row($sql['table'], $id, $by, 0, $sql['joins'], $sql['select'], $where);
        return $row;
    }


    public function total_users($company_id = '', $usergroup = '', $where_extra = []) {
        $where = strlen($company_id) ? ['company_id' => $company_id] : [];
        $where = strlen($usergroup) ? array_merge($where, ['usergroup' => $usergroup]) : $where;
        $where = !empty($where_extra) ? array_merge($where, $where_extra) : $where;
        return $this->count_rows(T_USERS, $where, 0);
    }

}