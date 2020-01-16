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
// define('MODULES', $modules_const);


//Product Tags
$tags = $CI->common_model->get_rows(T_TAGS);
$tags_const = [];
foreach ($tags as $tag) {
	$const_tag = 'TAG_' . strtoupper($tag->name);
	if ( ! defined($const_tag)) {
		$tag_id = intval($tag->id);
		define($const_tag, $tag_id);
		$tags_const[$const_tag] = $tag_id;
	}
} 

//User groups
$usergroups = $CI->common_model->get_rows(T_USER_GROUPS);
foreach ($usergroups as $group) {
	$const_group = strtoupper($group->name);
	if ( ! defined($const_group)) {
		define($const_group, $group->id);
	}
} 

define('COMPANY_PIX_DIR', 'uploads/companies/'.$CI->session->company_id.'/images');
define('COMPANY_DOC_DIR', 'uploads/companies/'.$CI->session->company_id.'/docs');

// User Rights 
define('VIEW', 1);
define('ADD', 2);
define('EDIT', 3);
define('DEL', 4);

//Misc
define('SITE_FAVICON', base_url().'assets/common/img/logo/favicon.ico');
define('SITE_LOGO', base_url().'assets/common/img/logo/favicon.ico');
define('USER_AVATAR', base_url().'assets/common/img/avatar/generic.png');