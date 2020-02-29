<?php 

function user_group($groups) {
	$ci =& get_instance();
	if ( ! $ci->session->user_loggedin) return false;
	if (is_array($groups))
		return in_array($ci->session->user_usergroup, $groups);
	return $ci->session->user_usergroup == $groups;
}

function company_user() {
	if (user_group(COMPANY_USERS)) return true;
	return false;
}

function customer_user() {
	if (user_group(CUSTOMER)) return true;
	return false;
}

function site_name($field = 'name') {
	$ci =& get_instance();
	if (company_user()) { 
		$name = 'company_'.$field;
		return $ci->session->$name;
	} 
	return constant('SITE_'.strtoupper($field));
}

function site_logo($site = 'site') {
	$ci =& get_instance();
	if (company_user()) { 
		$logo = 'company_logo_'.$site;
		return base_url(get_file(company_file_path(PIX_SETTINGS, $ci->session->$logo), SITE_LOGO));
	} 
	return base_url(SITE_LOGO);
}

function user_avatar() {
	$ci =& get_instance();
	if ($ci->session->user_sex == ST_SEX_MALE) {
		$default = AVATAR_MALE;
	} elseif ($ci->session->user_sex == ST_SEX_FEMALE) {
		$default = AVATAR_FEMALE;
	} else {
		$default = AVATAR_GENERIC;
	}
	$path = company_user() ? company_file_path(PIX_USERS, $ci->session->user_photo) : customer_file_path(PIX_USERS, $ci->session->user_photo);
	return base_url(get_file($path, $default));
}
