<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//get instance of CodeIgniter's super object
$CI =& get_instance();

//Tables
$tables = $CI->db->list_tables();
foreach ($tables as $table) {
	$const_table = 'T_' . strtoupper($table);	
	define($const_table, $table);
} 

//Modules
$modules = $CI->common_model->get_rows(T_MODULES);
foreach ($modules as $module) {
	//module
	$const_module = 'M_' . strtoupper($module->name);
	define($const_module, $module->id);
	//max data allowed
	$data_max = 'MAX_' . strtoupper($module->name);
	define($data_max, $module->max);
	//pix dir
	$const_pix = 'PIX_' . strtoupper($module->name);
	define($const_pix, $module->pix_dir);
	//doc dir
	$const_doc = 'DOC_' . strtoupper($module->name);
	define($const_doc, $module->doc_dir);
} 

//Product Tags
$tags = $CI->common_model->get_rows(T_TAGS);
$tags_const = [];
foreach ($tags as $tag) {
	$const_tag = 'TAG_' . strtoupper($tag->name);
	$tag_id = intval($tag->id);
	define($const_tag, $tag_id);
	$tags_const[$const_tag] = $tag_id;
} 

//Statuses
$statuses = $CI->common_model->get_rows(T_STATUS);
foreach ($statuses as $status) {
	$_const_status = strtoupper($status->type.'_'.$status->name);
	$const_status = 'ST_'.$_const_status; //status with ID
	$const_status_key = 'SK_'.$_const_status; //status with key
	define($const_status, $status->id);
	define($const_status_key, $status->key);
}

//Page Slider Categories
$sliders = $CI->common_model->get_rows(T_SLIDER_CATS, 0, [], '', [], ['order' => 'asc']);
$sliders_const = [];
$sliders_max = [];
$sess_sliders = [];
foreach ($sliders as $slider) {
	$const_slider = 'SLIDER_' . strtoupper($slider->name);
	$slider_id = intval($slider->id);
	define($const_slider, $slider_id);
	//max data allowed
	$sliders_max[$slider_id] = $slider->max;
	//sliders session 
	// $sliders_const[$const_slider] = $slider_id;
	$sess_sliders[$slider->id] = $slider->title;
} 
$CI->session->set_userdata('SLIDER_CATS', $sess_sliders);
define('MAX_SLIDER_CAT', $sliders_max);

//User groups
$usergroups = $CI->common_model->get_rows(T_USER_GROUPS);
foreach ($usergroups as $group) {
	$const_group = strtoupper($group->name);
	define($const_group, $group->id);
} 
//all company users
define('COMPANY_USERS', [ADMIN, STAFF]);

// User Rights 
define('VIEW', 1);
define('ADD', 2);
define('EDIT', 3);
define('DEL', 4);

//countries
define('C_NIGERIA', 135);

//cart time to live
define('CART_TTL', 60*60*24*7); //7 days
define('CHECKOUT_TTL', 60*60); //1 hour

//company file dir
define('COMPANY_PIX_DIR', 'uploads/companies/'.$CI->session->company_id.'/images');
define('COMPANY_DOC_DIR', 'uploads/companies/'.$CI->session->company_id.'/docs');
//customer file dir
define('CUSTOMER_PIX_DIR', 'uploads/customers/images');
define('CUSTOMER_DOC_DIR', 'uploads/companies/docs');

//default company
define('SITE', 1);
$row = $this->company_model->company_details(SITE);
define('SITE_NAME', $row['company_name']);
define('SITE_SHORT_NAME', $row['company_short_name']);
define('SITE_INITIALS', $row['company_initials']);
define('SITE_LOGO', 'uploads/companies/'.SITE.'/images/settings/'.$row['company_logo_site']);
define('PORTAL_LOGO', 'uploads/companies/'.SITE.'/images/settings/'.$row['company_logo_portal']);
//misc
define('SITE_FAVICON', 'assets/common/img/logo/favicon.png');
define('IMAGE_404', 'assets/common/img/icons/not_found.png');
//avatar
define('AVATAR_GENERIC', 'assets/common/img/avatar/generic.png');
define('AVATAR_MALE', 'assets/common/img/avatar/male.png');
define('AVATAR_FEMALE', 'assets/common/img/avatar/female.png');
