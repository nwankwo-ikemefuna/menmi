<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Orders extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->module = M_ORDERS;
		$this->model = 'order';
		$this->auth->login_restricted();
		$this->auth->password_restricted();
		$this->auth->module_restricted($this->module, VIEW, ALL_USERS);
		$this->page_scripts = company_user() ? ['orders'] : ['c_orders'];
	}


	private function qry_str() {
		//is status set in url?
		$status = xget('status');
		return strlen($status) ? '?status='.$status : '';
	}

	
	public function index() {
		$this->table = T_ORDERS;
		$status = xget('status');
		$qry_str = $this->qry_str();
		//buttons
		$this->butts = ['list' => ['url' => 'orders'.$qry_str, 'where' => ['company_id' => $this->company_id]], 'del_butts' => false];
		if (company_user()) {
			//bulk action 
			// $this->ba_opts['Unpaid'] = ['label' => 'Mark Unpaid', 'modal' => 'm_order_payment_status'];
			$this->ba_opts['Paid'] = ['label' => 'Mark Paid', 'modal' => 'm_order_payment_status'];
			$statuses = $this->common_model->get_statuses('order');
			$status_opts = [];
			foreach ($statuses as $row) {
				$this->ba_opts[$row->name] = ['label' => 'Mark '.$row->title, 'modal' => 'm_order_status'];
			}
		}
		$sql = $this->order_model->sql($status);
		//if status is set, append to where clause
		$where = strlen($status) ? array_merge($sql['where'], ['o.status' => $status]) : $sql['where'];
		$count = $this->common_model->count_rows($sql['table'], $where, $this->trashed);
		$title = 'Orders' . (strlen($status) ? ': '.$this->common_model->get_status($status)->title : '');
		$this->ajax_header($title, $count);
		$this->load->view('portal/company/orders/index');
		$this->ajax_footer();
	}


	public function data_ajax($status = '', $trashed = 0) { 
		response_headers();
		$status = intval($status);
		$qry_str = $status != 0 ? ['qry' => query_param('status', $status)] : '';
		$sql = $this->order_model->sql($this->company_id);
        if (company_user()) {
        	$where = $sql['where'];
			$xtra_butts = [
				['type' => 'modal', 'target' => 'm_order_status', 'icon' => 'line-chart', 'title' => 'Manage Status'],
				['type' => 'modal', 'target' => 'm_order_payment_status', 'icon' => 'money', 'title' => 'Manage Payment Status']
			];
			$butts = ['view' => $qry_str, 'xtra_butts' => $xtra_butts, 'trashed' => false];
	    } else {
	    	$where = array_merge($sql['where'], ['o.customer_id' => $this->session->user_id]);
	    	$butts = ['view' => $qry_str, 'trashed' => false];
	    }
	    $keys = ['id'];
	    $buttons = table_crud_butts($this->module, $this->model, null, T_ORDERS, $trashed, $keys, $butts);
        //if status is set, append to where clause
        $where = $status != 0 ? array_merge($where, ['o.status' => $status]) : $where;
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $where);
	}


	private function status_validation() {
		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
    }


	public function order_status_ajax() {
		$this->status_validation();
		$status = xpost('status');
		$data = ['status' => $status];
		$this->common_model->update_with_bulk(T_ORDERS, $data);
		json_response_db(true);
    }


    public function payment_status_ajax() {
    	$this->status_validation();
		$this->order_model->payment_status($this->company_id);
		json_response_db(true);
    }


	public function view($id) { 
		$this->check_data(T_ORDERS, $id);
		$sql = $this->order_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$qry_str = $this->qry_str();
		$this->butts = ['list' => ['url' => 'orders'.$qry_str]];
		$page_title = 'Order: '.(company_user() ? $row->customer_name : '').' ['.$row->ref_id.']';
		$data['row'] = $row;
		$this->ajax_header($page_title, '', $id);
		$this->load->view('portal/company/orders/view', $data);
		$this->ajax_footer();
	}
	

	public function items_ajax($id, $trashed = 0) { 
		response_headers();
		$sql = $this->order_model->details_sql($this->company_id, $id);
		if (company_user()) {
			$xtra_butts = [
				['type' => 'modal', 'target' => 'm_item_status', 'icon' => 'line-chart', 'title' => 'Manage Status']
			];
			$butts = ['view' => ['url' => 'products/view/$2'], 'xtra_butts' => $xtra_butts, 'trashed' => false];
	        $keys = ['id', 'product_id'];
	        $buttons = table_crud_butts($this->module, $this->model, null, T_ORDER_DETAILS, $trashed, $keys, $butts);
	    } else {
	    	$keys = [];
	    	$buttons = "";
	    }
        echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}


	public function item_status_ajax() {
		$this->status_validation();
		//this is necessary since the 0 option will return null
		$status = strlen(xpost('status')) ? 1 : 0;
		$data = ['status' => $status];
		$this->common_model->update_with_bulk(T_ORDER_DETAILS, $data);
		json_response_db(true);
    }

}