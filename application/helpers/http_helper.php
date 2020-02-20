<?php 

function xpost($field, $default = NULL, $xss_clean = TRUE) {
	$ci =& get_instance();
	$data = !empty($ci->input->post($field, $xss_clean)) ? $ci->input->post($field, $xss_clean) : $default;
	return $data;
}

function xpost_txt($field, $xss_clean = TRUE) {
	$ci =& get_instance();
	$data = !empty($ci->input->post($field, $xss_clean)) ? nl2br_except_pre(ucfirst($ci->input->post($field, $xss_clean))) : $default;
	return $data;
}

function xget($field, $xss_clean = TRUE) {
	$ci =& get_instance();
	return $ci->input->get($field, $xss_clean);
}

function xpostget($field, $xss_clean = TRUE) {
	$ci =& get_instance();
	return $ci->input->post_get($field, $xss_clean);
}

function xgetpost($field, $xss_clean = TRUE) {
	$ci =& get_instance();
	return $ci->input->get_post($field, $xss_clean);
}

function query_param($key, $val) {
	return (empty($_GET) ? '?' : '&').$key.'='.$val;
}

function trashed_record_list() {
	return (int) (isset($_GET['trashed']) && $_GET['trashed'] == 1);
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

function json_response_db($is_edit = false) {
	$ci =& get_instance();
	$error = $is_edit ? 'No changes detected' : 'Sorry, something went wrong. If issue persists, report to site administrator';
	return $ci->db->affected_rows() > 0 ? json_response() : json_response($error, false);
}

function scandir_recursive($dir) {
    $result = [];
    foreach(scandir($dir) as $filename) {
        //remove annoying dots
        if (in_array($filename[0], ['.', '..'])) continue;
        $path = $dir . DIRECTORY_SEPARATOR . $filename;
        if (is_dir($path)) {
        	//if dir, run through
            foreach (scandir_recursive($path) as $childFilename) {
                $result[] = $filename . DIRECTORY_SEPARATOR . $childFilename;
            }
        } else {
            $result[] = $filename;
        }
    }
    return $result;
}
