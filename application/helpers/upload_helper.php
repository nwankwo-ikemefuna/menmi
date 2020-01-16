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

function upload_file($type) {
    if (!file_exists('path/to/directory')) {
        mkdir('path/to/directory', 0777, true);
    }
}

function company_file_path($upload_ir = '', $file = '', $type = 'pix') {
    $upload_ir = strlen($upload_ir) ? '/'.$upload_ir : '';
    $file = strlen($file) ? '/'.$file : '';
    if ($type == 'doc') {
        return base_url(COMPANY_DOC_DIR.$upload_ir.$file);
    }
    return base_url(COMPANY_PIX_DIR.$upload_ir.$file);
}

function download_file($file_path, $file_name) { 
    $file_path = base_url($file_path.$file_name);
    $file_path = file_get_contents($file_path);
    //download file
    force_download($file_name, $file_path);
}