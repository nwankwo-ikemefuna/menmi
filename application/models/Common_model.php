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

    
    public function tags_sql() {
    	$select = "id, name, title";
        return sql_data(T_TAGS, [], $select, [], ['s.order' => 'asc']);
    }


    public function colors_sql() {
    	$select = "id, name, CONCAT('#', code) AS code";
        return sql_data(T_COLORS, [], $select, [], ['s.order' => 'asc']);
    }


    public function next_order($table) {
        if ( ! $this->db->field_exists('order', $table)) return; 
        $records = count($this->get_rows($table));
        if ($records > 0) { 
            $this->db->select_max('order');
            $this->db->where('trashed', 0);
            return $this->db->get($table)->row()->order + 1;
        } 
        return 1;
    }

}