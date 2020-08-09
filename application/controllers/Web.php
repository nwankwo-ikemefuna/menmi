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
        $this->page_scripts = ['shop'];
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
        //get home banners
        $banners = [];
        if ($this->session->company_home_banner == 1) {
            $sql = $this->slider_model->sql($this->company_id);
            $where = array_merge($sql['where'], ['cat_id' => SLIDER_HOME_BANNER]);
            $banners = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 3);
        }
        $data['banners'] = $banners;
        $data['featured_products'] = $this->shop_model->featured();
        $data['viewed_products'] = $this->shop_model->viewed();
        $sql = $this->product_model->cats_sql($this->company_id);
        $data['product_cats'] = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order'], '', 20);
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


    public function contact_ajax() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'first_name' => ucwords(xpost('first_name')),
            'last_name' => ucwords(xpost('last_name')),
            'email' => xpost('email'),
            'phone' => xpost('phone'),
            'message' => xpost('message')
        ];
        $this->common_model->insert(T_MESSAGES, $data);
        json_response_db();
    }


    public function newsletter_sub_ajax() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[subscribers.email]', ['is_unique' => 'You have already subscribed with this email.']);
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $data = [
            'company_id' => $this->company_id,
            'email' => xpost('email')
        ];
        $this->common_model->insert(T_SUBSCRIBERS, $data);
        json_response_db();
    }

}