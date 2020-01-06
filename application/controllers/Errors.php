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
        $this->guest_header('404: Page Not Found');
        $this->load->view('errors/html/error_404');
        $this->guest_footer();
    }   


    public function forbidden() { 
        $this->guest_header('403: Forbidden');
        $this->load->view('errors/html/error_403');
        $this->guest_footer();
    }   


}