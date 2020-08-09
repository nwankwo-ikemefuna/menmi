<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/


class Errors extends Core_controller {
    public function __construct() {
        parent::__construct();
    }


    /**
    * Error 404 page
    * set as 404_override method in config/routes
    * Route: error404
    */
    public function error_404() { 
        $layout = $this->layout_type();
        $header_method = $layout['header'];
        $footer_method = $layout['footer'];
        $data['referrer'] = $layout['referrer'];
        $this->$header_method('404');
        $this->load->view('errors/html/error_404', $data);
        $this->$footer_method();
    }   


    public function forbidden() { 
        $layout = $this->layout_type();
        $header_method = $layout['header'];
        $footer_method = $layout['footer'];
        $data['referrer'] = $layout['referrer'];
        $this->$header_method('403');
        $this->load->view('errors/html/error_403', $data);
        $this->$footer_method();
    }   


    private function layout_type() {
        if ($this->agent->referrer() == base_url('portal')) {
            $header_method = 'ajax_header';
            $footer_method = 'ajax_footer';
            $referrer = 'portal';
        } else {
            $header_method = 'guest_header';
            $footer_method = 'guest_footer';
            $referrer = 'other';
        }
        return ['header' => $header_method, 'footer' => $footer_method, 'referrer' => $referrer];
    }


}