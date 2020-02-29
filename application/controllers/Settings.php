<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Settings extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->module = M_SETTINGS;
		$this->model = 'company';
		$this->auth->login_restricted(ADMIN);
		$this->auth->password_restricted();
		$this->auth->module_restricted($this->module, VIEW, ADMIN);
		$this->page_scripts = ['settings'];
	}

	
	public function index() {
		redirect($this->c_controller.'/view');
	}


	public function view() { 
		$id = $this->company_id;
		//buttons
		$this->butts = ['edit' => ['url' => 'settings/edit']];
		$sql = $this->company_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where'], $sql['group_by']);
		$this->portal_header($row->name, '', $id);
		$data['row'] = $row;
		$this->load->view('portal/company/settings/view', $data);
		$this->portal_footer();
	}


	public function edit() {
		$id = $this->company_id;
    	//buttons
		$this->butts = ['view' => ['url' => 'settings/view'], 'save' => ['form' => 'edit_form']];
		$sql = $this->company_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where'], $sql['group_by']);
		$data['row'] = $row;
		$this->portal_header('Edit Company Settings: '.$row->name, '', $id);
		$this->load->view('portal/company/settings/edit', $data);
		$this->portal_footer();
	}


	public function edit_ajax() {
		$this->auth->module_restricted($this->module, EDIT, ADMIN, true);
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('short_name', 'Short Name', 'trim|required');
        $this->form_validation->set_rules('initials', 'Initials', 'trim|required');
        $this->form_validation->set_rules('tagline', 'Motto/Tagline', 'trim|required');
        $this->form_validation->set_rules('curr_id', 'Currency', 'trim|required');
        $this->form_validation->set_rules('phone_1', 'Phone 1', 'trim|required');
        $this->form_validation->set_rules('phone_2', 'Phone 2', 'trim');
        $this->form_validation->set_rules('phone_3', 'Phone 3', 'trim');
        $this->form_validation->set_rules('email_1', 'Email 1', 'trim|required|valid_email');
        $this->form_validation->set_rules('email_2', 'Email 2', 'trim|valid_email');
        $this->form_validation->set_rules('email_3', 'Email 3', 'trim|valid_email');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim');
        $this->form_validation->set_rules('address_3', 'Address 3', 'trim');
        $this->form_validation->set_rules('social_facebook', 'Facebook', 'trim');
        $this->form_validation->set_rules('social_instagram', 'Instagram', 'trim');
        $this->form_validation->set_rules('social_whatsapp', 'WhatsApp', 'trim');
        $this->form_validation->set_rules('social_twitter', 'Twitter', 'trim');
        $this->form_validation->set_rules('social_linkedin', 'LinkedIn', 'trim');
        $this->form_validation->set_rules('social_googleplus', 'Google+', 'trim');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
        $this->form_validation->set_rules('description', 'Full Description', 'trim|required');
        $this->form_validation->set_rules('bank_info', 'Bank Info', 'trim|required');
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
        $id = $this->company_id;
		$sql = $this->company_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', 0, $sql['joins'], $sql['select'], $sql['where'], $sql['group_by']);
		$logo_site = $row->logo_site;
		$logo_portal = $row->logo_portal;
		//upload
		$conf = ['path' => company_file_path(PIX_SETTINGS), 'ext' => 'jpg|jpeg|png', 'size' => 100, 'required' => false];
		$upload_logo_site = upload_file('logo_site', $conf);
		$upload_logo_portal = upload_file('logo_portal', $conf);
		/*var_dump($upload_logo_site);
		var_dump($upload_logo_portal); die;*/
		if ( ! $upload_logo_site['status'] ||  ! $upload_logo_portal['status']) {
        	json_response(join_us(array_merge($upload_logo_site['error'], $upload_logo_portal['error'])), false);
			//was image uploaded?
		} else {
			//site logo
			if ($upload_logo_site['status'] && ! empty($upload_logo_site['file_name'])) {
				//unlink image
				unlink_files(company_file_path(PIX_SETTINGS), $row->logo_site);
				//get the uploaded image
				$logo_site = $upload_logo_site['file_name'];
			} 
			//portal logo
			if ($upload_logo_portal['status'] && ! empty($upload_logo_portal['file_name'])) {
				//unlink image
				unlink_files(company_file_path(PIX_SETTINGS), $row->logo_portal);
				//get the uploaded image
				$logo_portal = $upload_logo_portal['file_name'];
			} 
		} 
        $data = [
            'name' => ucwords(xpost('name')),
            'short_name' => ucwords(xpost('short_name')),
            'initials' => strtoupper(xpost('initials')),
            'tagline' => xpost('tagline'),
            'curr_id' => xpost('curr_id'),
            'phone_1' => xpost('phone_1'),
            'phone_2' => xpost('phone_2'),
            'phone_3' => xpost('phone_3'),
            'email_1' => xpost('email_1'),
            'email_2' => xpost('email_2'),
            'email_3' => xpost('email_3'),
            'address_1' => xpost('address_1'),
            'address_2' => xpost('address_2'),
            'address_3' => xpost('address_3'),
            'social_facebook' => prep_url(xpost('social_facebook')),
            'social_instagram' => xpost('social_instagram'),
            'social_whatsapp' => xpost('social_whatsapp'),
            'social_twitter' => xpost('social_twitter'),
            'social_linkedin' => prep_url(xpost('social_linkedin')),
            'social_googleplus' => prep_url(xpost('social_googleplus')),
            'short_description' => ucfirst(xpost_txt('short_description')),
            'description' => ucfirst(xpost_txt('description')),
            'bank_info' => ucwords(xpost_txt('bank_info')),
            'logo_site' => $logo_site,
            'logo_portal' => $logo_portal
        ];
		$this->common_model->update(T_COMPANIES, $data, ['id' => $id]);
        json_response(['redirect' => mod_view_page()]);
    }
	
}