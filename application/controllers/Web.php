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
        $this->show_sidebar = false;
        $this->page_scripts = ['products'];
    }


    public function index() {
        $this->show_sidebar = false;
        $this->show_bcrumbs = false;
        $this->web_header($this->site_name);
        //get home top sliders
        $sliders = [];
        if ($this->session->company_home_slider == 1) {
            $sql = $this->slider_model->sql($this->company_id);
            $where = array_merge($sql['where'], ['cat_id' => SLIDER_HOME_TOP]);
            $sliders = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 3);
        }
        $data['sliders'] = $sliders;
        $sql = $this->product_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['FIND_IN_SET('.TAG_FEATURED.', p.tags)' => '']);
        $data['featured_products'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 12);
        $sql = $this->product_model->cats_sql($this->company_id);
        $data['product_cats'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], 'rand', '', 6);
        $this->load->view('web/index', $data);
        $this->web_footer('home');
    }


    public function about() {
        $this->web_header('About Us');
        //get about sliders
        $sliders = [];
        $sql = $this->slider_model->sql($this->company_id);
        $where = array_merge($sql['where'], ['cat_id' => SLIDER_ABOUT]);
        $sliders = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 3);
        $data['sliders'] = $sliders;
        $this->load->view('web/about', $data);
        $this->web_footer();
    }


    public function contact() {
        $this->web_header('Contact Us');
        $this->load->view('web/contact');
        $this->web_footer();
    }


    public function newsletter_sub_ajax() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[newsletter_subscribers.email]', ['is_unique' => 'You have already subscribed with this email.']);
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'email' => xpost('email')
        ];
        $this->common_model->insert(T_NEWSLETTER_SUBSCRIBERS, $data);
        json_response_db();
    }
    
}