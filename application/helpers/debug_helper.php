<?php 
function xdump($var = null) {
    if (isset($var)) {
        var_dump($var);
        exit;
    }
}

function last_sql($die = true) {
	$ci =& get_instance();
    echo $ci->db->last_query();
    if ($die) die;
}