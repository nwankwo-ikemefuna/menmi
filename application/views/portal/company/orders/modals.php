<?php
//item status
if (in_array('order_status', $modals)) {
	$statuses = $this->common_model->get_statuses('order');
	$fields = [
		['name' => 'order_id', 'type' => 'hidden'],
		['name' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'extra' => ['options' => $statuses, 'text_col' => 'title'], 'layout' => 'list']
	];
	$item = 'Order Item Status';
	ajax_form_modal(['modal' => 'm_order_status', 'form' => 'item_status_form', 'url' => $this->c_controller.'/item_status_ajax', 'type' => 'modal_dt', 'item' => $item, 'crud_type' => 'update', 'title' => $item], $fields);
}
//item status
if (in_array('item_status', $modals)) {
	$statuses = order_item_statuses();
	$fields = [
		['name' => 'item_id', 'type' => 'hidden'],
		['name' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'extra' => ['options' => $statuses], 'layout' => 'list']
	];
	$item = 'Order Item Status';
	ajax_form_modal(['modal' => 'm_item_status', 'm_size' => 'modal-sm', 'form' => 'item_status_form', 'url' => $this->c_controller.'/item_status_ajax', 'type' => 'modal_dt', 'item' => $item, 'crud_type' => 'update', 'title' => $item], $fields);
}