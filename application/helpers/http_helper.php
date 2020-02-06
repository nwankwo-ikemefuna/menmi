<?php 

function xpost($field, $xss_clean = TRUE) {
	$ci =& get_instance();
	return $ci->input->post($field, $xss_clean);
}

function xget($field, $xss_clean = TRUE) {
	$ci =& get_instance();
	return $ci->input->get($field, $xss_clean);
}

function xdump($var = null) {
    if (isset($var)) {
        var_dump($var);
        exit;
    }
}

function get_requested_page() {
	return current_url() . (strlen($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
}

function response_headers(
	$content_type = 'application/json', 
	$allow_origin = '*', 
	$allow_cred = 'true',
	$allow_headers = 'X-Requested-With, Content-Type, Origin, Method, X-API-KEY, Cache-Control, Pragma, Accept, Accept-Encoding',
	$cache_control = 'no-cache, must-revalidate') {
	header("Access-Control-Allow-Origin: " . 		$allow_origin);
	header("Access-Control-Allow-Credentials: " . 	$allow_cred);
	header("Access-Control-Allow-Headers: " . 		$allow_headers);
	header("Content-Type: " . 						$content_type);
	header("Cache-Control: " . 						$cache_control);
}

function json_response($data = null, $status = true, $code = HTTP_OK) {
    http_response_code($code);
    $res = ['status' => $status];
    $body = $status ? ['body' => ['msg' => $data]] : ['error' => $data];
    $res = array_merge($res, $body);
    echo json_encode($res);
    exit;
}

function json_response_db() {
	$ci =& get_instance();
	return $ci->db->affected_rows() > 0 ? json_response() : json_response('Sorry, something went wrong. If issue persists, report to site administrator', false);
}
