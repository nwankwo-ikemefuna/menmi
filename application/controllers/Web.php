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
        $this->page_scripts = ['products'];
    }


    public function index() {
        $this->web_header($this->site_name);
        //get home top sliders
        $sql = $this->slider_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['cat_id' => SLIDER_HOME_TOP]);
        $data['sliders'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 3);
        $sql = $this->product_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['FIND_IN_SET('.TAG_FEATURED.', p.tags)' => '']);
        $data['featured_products'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 12);
        $sql = $this->product_model->cats_sql($this->company_id);
        $data['product_cats'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order'], '', 10);
        $this->load->view('web/index', $data);
        $this->web_footer();
    }

    public function insert_colors() {
    	foreach ($colors as $val) {
    		$ex = explode(' ', $val);
    		$data = ['name' => $ex[0], 'code' => $ex[1], 'order' => isset($ex[2]) ? $ex[2] : NULL];
    		$this->common_model->insert(T_COLORS, $data);
    	}
    	echo 'Inserted ' . count($colors) . ' colors successfully';
    }
    
}