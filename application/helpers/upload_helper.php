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

function file_upload_path($type) {
    //holds array of upload directories for easy modification
    $paths = array(
        'admin_photo'           => 'photos/admins',
        'about_site'            => 'site',
        'post_image'            => 'posts/featured_images',
        'project'               => 'projects',
        'ad_sidebar'            => 'ads/sidebar',
        'ad_topbar'             => 'ads/top',
    );
    $uploads_folder = 'uploads/';
    return $uploads_folder.$paths[$type].'/';
}


function download_file($file_path, $file_name) { 
    $file_path = base_url($file_path.$file_name);
    $file_path = file_get_contents($file_path);
    //download file
    force_download($file_name, $file_path);
}