<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ===== Documentation ===== 
Name: app_helper
Role: Helper
Description: custom general application helper
Author: Nwankwo Ikemefuna
Date Created: 31/12/2019
Date Modified: 31/12/2019
*/ 
function site_meta($page_title = '') { 
    $ci =& get_instance();
    ?>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title><?php echo $page_title; ?> | <?php echo $ci->site_name; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="description" content="<?php echo $ci->site_description; ?>" />
    <meta name="author" content="<?php echo $ci->site_author; ?>"  />
    <meta name="keywords" content="">

    <link rel="shortcut icon" type="image/png" href="<?php echo SITE_FAVICON; ?>" />
    <?php
}

function xdump($var = null) {
    if (isset($var)) {
        var_dump($var);
        exit;
    }
}

function is_assoc_array(array $arr) {
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function ajax_status_spinner($span_id, $extra_msg = NULL) {
    return '<span id="'.$span_id.'" style="display: none"><i class="fa fa-spinner fa-spin"></i> ' . $extra_msg . '</span>';
}

function toggle_password_visibility() {
    ?>
    <span id="show_password_icon"><a id="show_password" title="Show password" style="cursor: pointer"><i class="fa fa-eye"></i></a></span>
    <span id="hide_password_icon" style="display: none"><a id="hide_password" title="Hide password" style="cursor: pointer"><i class="fa fa-eye-slash"></i></a></span>
   <?php
}

function pluralize_word($word, $count) {
    //pluralize word if count 0 or > 1
    if ($count == 1) return singular($word);
    return plural($word);
}

function hash_value($value, $algorithm = 'sha512') {
    return hash($algorithm, $value);
}

function generate_api_key($user_id) { 
    //format: md5($user_id)-md5(random string)
    $api_key = substr(md5($user_id), 0, 15);
    $api_key .= '-';
    $api_key .= substr(md5(microtime().rand()), 0, 24);
    return shuffle_string_case($api_key);
}

function shuffle_string_case($str) {
    $len = strlen($str); 
    for ($i = 0; $i < $len; $i++) {
        $str[$i] = (rand(0, 100) > 50
            ? strtoupper($str[$i])
            : strtolower($str[$i]));
    }
    return $str;
}

function time_ago($time, $units = 1) { //return time in ago
    //add mysql-server time difference to time;
    $time_diff = 0;
    $time = strtotime("+$time_diff hours", strtotime($time));
    $now = time(); //current time
    return strtolower(timespan($time, $now, $units)). ' ago';
}

function x_date($date, $with_ago = false) { //format date in the form eg 23rd Aug, 2018 from timestamp in db
    if ($date == NULL) return NULL;
    $x_date = date("jS M, Y", strtotime($date));
    if ( ! $with_ago) {
        $x_date = $x_date;
    } else {
        $x_date = $x_date . ' (' . time_ago($date) . ')';
    }
    return $x_date;
}

function x_date_full($date, $with_ago = false) { //format date in the form eg 23rd August, 2018 from timestamp in db
    if ($date == NULL) return NULL;
    $x_date = date("jS F, Y", strtotime($date));
    if ( ! $with_ago) {
        $x_date = $x_date;
    } else {
        $x_date = $x_date . ' (' . time_ago($date) . ')';
    }
    return $x_date;
}

function x_date_time($date, $with_ago = false) {
    if ($date == NULL) return NULL;
    $x_date = date("jS F, Y", strtotime($date)). ' at ' .date("h:i A", strtotime($date));
    if ( ! $with_ago) {
        $x_date = $x_date;
    } else {
        $x_date = $x_date . ' (' . time_ago($date) . ')';
    }
    return $x_date;
}

function x_time_12hour($date) { //eg 05:20 PM
    if ($date == NULL) return NULL;
    return date("h:i A", strtotime($date));
}

function x_time_24hour($date) { //eg 17:20
    if ($date == NULL) return NULL;
    return date("H:i A", strtotime($date));
}

function date_today_db() { //today date for insertion into db
    return $today = date('Y-m-d H:i:s'); //in the format yyyy-mm-dd
}

function date_today_dmy() { 
    return $today = date('d/m/Y'); //in the format dd/mm/yyyy
}

function sluggify_string($string, $separator = '-') { //get slug from titles and captions for use in URL
    return url_title($string, $separator, $lowercase = TRUE);
}

function csrf_hidden_input() {
    $CI =& get_instance();
    return '<input type="hidden" id="csrf_hash" value="'.$CI->security->get_csrf_hash().'" />';
} 

function get_currency_symbol($currency_code) {
    return '&#'.$currency_code.';';
}

function array_has_string_keys(array $array) {
    return count(array_filter(array_keys($array), 'is_string')) > 0;
}

function loading_icon() { ?>
    <i class="fa fa-spinner fa-spin"></i>
    <?php
}