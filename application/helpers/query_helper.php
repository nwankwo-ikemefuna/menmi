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

function datetime_select($field, $alias = '', $full_month = false) {
	$month = $full_month ? 'M' : 'b';
	$as_alias = strlen($alias) ? "AS {$alias}" : '';
	return "DATE_FORMAT({$field}, '%D %{$month}, %Y at %h:%i %p') {$as_alias}";
}

function price_select($code_col, $price_col, $alias = '', $precision = 0) {
	$as_alias = strlen($alias) ? "AS {$alias}" : '';
	return "CONCAT('&#', {$code_col}, ';', {$price_col}) {$as_alias}";
}

function trashed_record_list() {
	return (int) (isset($_GET['trashed']) && $_GET['trashed'] == 1);
}

function sql_data($table, $joins, $select, $where, $order = [], $group_by = '') {
	return ['table' => $table, 'joins' => $joins, 'select' => $select, 'where' => $where, 'order' => $order, 'group_by' => $group_by];
}