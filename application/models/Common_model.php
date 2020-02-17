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
        return sql_data(T_TAGS, [], $select, [], ['order' => 'asc']);
    }


    public function colors_sql() {
    	$select = "id, name, code, CONCAT('#', code) AS color_code";
        return sql_data(T_COLORS, [], $select, [], ['order' => 'asc']);
    }


    public function get_colors($icon = 'square') {
        $sql = $this->colors_sql();
        $colors = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where']);
        $colors_arr = [];
        foreach ($colors as $row) {
            $colors_arr[$row->id] = '<i class="fa fa-'.$icon.'" style="color: #'.$row->code.'"></i> '.$row->name;
        }
        return $colors_arr;
    }


    public function currencies_sql() {
        $select = "id, name, code, CONCAT(country, ' ', name, ' (&#', code, ';)') AS curr_name";
        return sql_data(T_CURRENCIES, [], $select, [], ['order' => 'asc']);
    }


    public function next_order($table) {
        //ensure order column exists
        if ( ! $this->db->field_exists('order', $table)) return; 
        $count = $this->count_rows($table);
        if ($count > 0) { 
            return $this->common_model->get_aggr_row($table, 'max', 'order') + 1;
        } 
        return 1;
    }

}