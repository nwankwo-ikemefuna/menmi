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
	$select .= $with_alias ? " AS {$alias}" : '';
	return $select;
}

function user_age_select($tbl_alias = '', $alias = 'age') {
	$tbl_alias = strlen($tbl_alias) ? "{$tbl_alias}." : '';
	$select = "IFNULL( 
	CONCAT(TIMESTAMPDIFF(YEAR, {$tbl_alias}date_of_birth, CURDATE()), (IF(TIMESTAMPDIFF(YEAR, {$tbl_alias}date_of_birth, CURDATE()) = 1, ' year', ' years'))), '') AS {$alias}";
	return $select;
}

function db_user_title($title) {
	return strlen(trim($title)) ? ucwords($title) : NULL;
}

function datetime_select($field, $alias = '', $full_month = false) {
	$month = $full_month ? 'M' : 'b';
	$as_alias = strlen($alias) ? "AS {$alias}" : '';
	return "DATE_FORMAT({$field}, '%D %{$month}, %Y at %h:%i %p') {$as_alias}";
}

function price_select($code_col, $price_col, $alias = 'price', $precision = 0) {
	return "CONCAT('&#', {$code_col}, ';', {$price_col}) AS {$alias}";
}

function file_select($path, $file_dir_col, $file_col, $alias = 'file', $default = null) {
	return "CONCAT('/{$path}', '/', {$file_dir_col}, '/', {$file_col}) AS {$alias}";
}

function trashed_record_list() {
	return (int) (isset($_GET['trashed']) && $_GET['trashed'] == 1);
}

function sql_data($table, $joins, $select, $where, $order = [], $group_by = '') {
	return ['table' => $table, 'joins' => $joins, 'select' => $select, 'where' => $where, 'order' => $order, 'group_by' => $group_by];
}