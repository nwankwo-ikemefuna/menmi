<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function ajax_spinner($class = 'ajax_spinner') {
    return ' <i class="fa fa-spinner hide '.$class.'"></i>';
}

function alert_dismiss() {
    return '<button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"> 
        <span aria-hidden="true">&times;</span></button>';
}

function custom_validation_errors() {
    if ( validation_errors() ) { 
        return '<div class="alert alert-danger alert-dismissable auto_dismiss text-center">'
            . alert_dismiss()
            . validation_errors() .
        '</div>';
    }
} 

function flash_message($key = 'success_msg', $type = 'success') {
    $CI = & get_instance(); 
    if ( $CI->session->flashdata($key) ) {                      
        echo '<div class="alert alert-'.$type.' alert-dismissable auto_dismiss text-center">'
                    . alert_dismiss()
                    . $CI->session->flashdata($key) .
                '</div>';
        //unset it
        $CI->session->unset_userdata($key);
    }
}