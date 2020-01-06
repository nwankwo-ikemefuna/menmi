<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/


class Web extends Core_controller {
    public function __construct() {
        parent::__construct();
        $this->page_scripts = [];
    }


    public function index() {
        $this->web_header($this->site_name);
        $this->load->view('web/index');
        $this->web_footer();
    }
    
}