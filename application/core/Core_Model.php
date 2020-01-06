<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Core_Model extends CI_Model {

    // protected $table;

    public function __construct() {
        parent::__construct();
    }


    private function table_alias($table) {
        //table has alias? Let's get delim first (AS or space)
        $_delim = preg_match('/(^|\s)as($|\s|[^w])/i', $table) ? 'as' : ' ';
        $_table = explode($_delim, $table);
        //if alias is not set, use table name as alias
        $alias = isset($_table[1]) ? $_table[1] : $_table[0];
        return $alias;
    }


    /**
     * get row details
     * @param  string       $table    [table name, could contain an alias]
     * @param  integer      $id       [description]
     * @param  string       $by       [description]
     * @param  integer      $trashed  [whether trashed or not, 0 no, 1 yes]
     * @param  array        $joins    [tables to be joined]
     * @param  string       $select   [fields to select]
     * @param  array        $where    [other where clauses]
     * @param  bool         $ajax     [whether to use db or datatables class]
     * @return void
     */
    private function prepare_query($table, $trashed = 0, $joins = [], $select = '', $where = [], $order = [], $group_by = '', $ajax = false) {
        $obj = q_obj($ajax);
        $alias = $this->table_alias($table);
        //select is not set? Select all from main table
        if ( ! strlen($select)) $select = $alias.'.*';
        $this->$obj->select($select);
        $this->$obj->from($table);
        //joins
        if (is_array($joins) && ! empty($joins)) {
            foreach ($joins as $j_table => $j_cond) {
                $j_on = $j_cond[0]; //join ON
                //check if type of join is set, else use left 
                $j_type = isset($j_cond[1]) && strlen($j_cond[1]) ? $j_cond[1] : 'left'; 
                //escape?
                $j_esc = isset($j_cond[2]) && strlen($j_cond[2]) ? $j_cond[2] : NULL; 
                $this->$obj->join($j_table, $j_on, $j_type, $j_esc);
            }
        }
        //general where
        $this->$obj->where($alias.'.trashed', $trashed);
        //other where
        if (is_array($where) && ! empty($where)) {
            foreach ($where as $field => $value) {
                //is $value an empty string? 
                if ($value === '') {
                    //escape is necessary incase where clause contains sql functions such as FIND_IN_SET(), etc
                    //eg: FIND_IN_SET(t.user_id, "3,1,2")' => ''
                    $this->$obj->where($field, NULL, false);
                } else {
                    $this->$obj->where($field, $value);
                }
            }  
        }
        //order
        if (is_array($order) && ! empty($order)) {
            foreach ($order as $field => $direction) {
                $this->db->order_by($field, $direction);
            }
        } else {
            $this->db->order_by($alias.'.date_created', 'desc');
        }
        //group by
        $group_by = strlen($group_by) ? $group_by : $alias.'.id';
        $this->$obj->group_by($group_by);
    }


    /**
     * get row details
     * @return object
     */
    public function get_row($table, $id, $by = '', $trashed = 0, $joins = [], $select = '', $where = [], $group_by = '', $return = 'object') {
        $alias = $this->table_alias($table);
        $by = strlen($by) ? $by : 'id';
        $where[$alias.'.'.$by] = $id;
        $this->prepare_query($table, $trashed, $joins, $select, $where, $group_by);
        $return = $return == 'object' ? 'row' : 'row_array';
        return $this->db->get()->$return();
    }


    /**
     * get rows
     * @return object
     */
    public function get_rows($table, $trashed = 0, $joins = [], $select = '', $where = [], $order = [], $group_by = '', $return = 'object') {
        $this->prepare_query($table, $trashed, $joins, $select, $where, $order, $group_by);
        $return = $return == 'object' ? 'result' : 'result_array';
        return $this->db->get()->$return();
    }


    /**
     * get rows for ajax using Ignited Datatables library
     * @return object
     */
    public function get_rows_ajax($table, $keys, $buttons, $trashed = 0, $joins = [], $select = '', $where = [], $order = [], $group_by = '') {
        $this->prepare_query($table, $trashed, $joins, $select, $where, $order, $group_by, true);
        //Bulk action column
        //Note: $1 assumes that the primary key column (usu id), is the first key
        $this->datatables->add_column('checker', form_check_dt('ba_record_idx[]', '$1', 'ba_record'), 'id');
        //actions column
        $this->datatables->add_column('actions', $buttons, join(',', $keys));
        return $this->datatables->generate();
    }


    public function insert(string $table, array $data) {
        if (count($data) > 0) {
            return $this->db->insert($table, $data);
        }
        return 0;
    }


    public function insert_batch(string $table, array $data) {
        if (count($data) > 0) {
            return $this->db->insert_batch($table, $data);
        }
        return 0;
    }


    public function update(string $table, array $data, array $where) {
        if (count($data) > 0 && count($where) > 0) {
            $this->db->where($where);
            return $this->db->update($table, $data);
        }
        return 0;
    }


    public function delete(string $table, array $where) { 
        if (count($where) > 0) {
            $this->db->where($where);
            return $this->db->delete($table);
        }
        return 0;
    }


}