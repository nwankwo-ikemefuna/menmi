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
		$this->auth->login_restricted(COMPANY_USERS);
		$this->auth->password_restricted();
		$this->auth->module_restricted($this->module, VIEW, COMPANY_USERS);
		$this->page_scripts = ['orders'];
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
		$this->butts = ['list' => ['url' => 'orders'.$qry_str, 'where' => ['company_id' => $this->company_id]]];
		$this->ba_opts = ['delete'];
		$sql = $this->order_model->sql($status);
		//if status is set, append to where clause
		$where = strlen($status) ? array_merge($sql['where'], ['o.status' => $status]) : $sql['where'];
		$count = $this->common_model->count_rows($sql['table'], $where, $this->trashed);
		$title = 'Orders' . (strlen($status) ? ': '.$this->common_model->get_status($status)->title : '');
		$this->portal_header($title, $count);
		$this->load->view('portal/company/orders/index');
		$this->portal_footer();
	}


	public function data_ajax($status = '', $trashed = 0) { 
		response_headers();
		$status = intval($status);
		$qry_str = $status != 0 ? ['qry' => query_param('status', $status)] : '';
		$butts = ['view' => $qry_str, 'delete'];
        $keys = ['id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_ORDERS, $trashed, $keys, $butts);
        $sql = $this->order_model->sql($this->company_id);
        //if status is set, append to where clause
        $where = $status != 0 ? array_merge($sql['where'], ['o.status' => $status]) : $sql['where'];
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $where);
	}


	public function view($id) { 
		$this->check_data(T_ORDERS, $id);
		$sql = $this->order_model->sql($this->company_id);
		$row = $this->common_model->get_row($sql['table'], $id, 'id', $this->trashed, $sql['joins'], $sql['select'], $sql['where']);
		$qry_str = $this->qry_str();
		//buttons
		$xtra_butts = [
			['text' => 'View Customer', 'type' => 'url', 'target' => 'user/view/'.$row->customer_id, 'icon' => 'user']
		];
		$this->butts = ['list' => ['url' => 'orders'.$qry_str], 'xtra_butts' => $xtra_butts];
		$page_title = 'Order: '.$row->customer_name.' ['.$row->ref_id.']';
		$this->portal_header($page_title, '', $id);
		$data['row'] = $row;
		$this->load->view('portal/company/orders/view', $data);
		$this->portal_footer();
	}
	

	public function items_ajax($id, $trashed = 0) { 
		response_headers();
		$xtra_butts = [
			['name' => 'item_id', 'type' => 'modal', 'target' => 'm_item_status', 'icon' => 'line-chart', 'title' => 'Manage Status']
		];
		$butts = ['view' => ['url' => 'products/view/$2'], 'xtra_butts' => $xtra_butts, 'trashed' => false];
        $keys = ['id', 'product_id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_ORDER_DETAILS, $trashed, $keys, $butts);
        $sql = $this->order_model->details_sql($this->company_id, $id);
		echo $this->common_model->get_rows_ajax($sql['table'], $keys, $buttons, $trashed, $sql['joins'], $sql['select'], $sql['where']);
	}

}