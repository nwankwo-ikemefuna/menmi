<?php 

function q_obj(bool $ajax) {
	return $ajax ? 'datatables' : 'db'; 
}

function full_name_select($tbl_alias = '', $with_alias = true, $alias = 'full_name') {
	$tbl_alias = strlen($tbl_alias) ? "{$tbl_alias}." : '';
	$select = "TRIM(
		CONCAT(
			IFNULL({$tbl_alias}title, ''), ' ', 
			IFNULL({$tbl_alias}last_name, ''), ' ', 
			IFNULL({$tbl_alias}first_name, ''), ' ', 
			IFNULL({$tbl_alias}other_name, '')
		))";
	$select .= $with_alias ? "AS {$alias}" : '';
	return $select;
}

function db_user_title($title) {
	return strlen(trim($title)) ? ucwords($title) : NULL;
}

function trashed_record_list() {
	return (int) (isset($_GET['trashed']) && $_GET['trashed'] == 1);
}

function sql_data($table, $joins, $select, $where, $where_extra = []) {
	if (is_array($where_extra) && count($where_extra) > 0) {
        $where = array_merge($where, $where_extra);
    }
    return['table' => $table, 'joins' => $joins, 'select' => $select, 'where' => $where];
}

function xobj($obj, $val) {
	return isset($obj) ? $obj->$val : null;
}