<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//get instance of CodeIgniter's super object
$CI =& get_instance();

//Tables
$tables = $CI->db->list_tables();
foreach ($tables as $table) {
	$const_table = 'T_' . strtoupper($table);	
	if ( ! defined($const_table)) {
		define($const_table, $table);
	}
} 

//Modules
$modules = $CI->common_model->get_rows(T_MODULES);
$modules_const = [];
foreach ($modules as $module) {
	$const_module = 'M_' . strtoupper($module->name);
	if ( ! defined($const_module)) {
		$module_id = intval($module->id);
		define($const_module, $module_id);
		$modules_const[$const_module] = $module_id;
	}
} 
//array of modules
define('MODULES', $modules_const);

//User groups
$usergroups = $CI->common_model->get_rows(T_USER_GROUPS);
foreach ($usergroups as $group) {
	$const_group = strtoupper($group->name);
	if ( ! defined($const_group)) {
		define($const_group, $group->id);
	}
} 

// User Rights 
define('VIEW', 1);
define('ADD', 2);
define('EDIT', 3);
define('DEL', 4);


//Misc
define('SITE_FAVICON', base_url().'assets/common/img/logo/favicon.ico');
define('SITE_LOGO', base_url().'assets/common/img/logo/favicon.ico');
define('USER_AVATAR', base_url().'assets/common/img/avatar/generic.png');