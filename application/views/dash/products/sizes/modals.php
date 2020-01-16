<?php 
$fields = [
	['name' => 'id', 'type' => 'hidden'],
	['name' => 'name', 'label' => 'Name', 'required' => true],
	['name' => 'order', 'label' => 'Order', 'type' => 'number', 'required' => true, 'value' => 10, 'extra' => ['min' => 0]]
];

$item = 'Product Size';
$fm_type = $fm_type ?? 'modal_dt';
//add
if (in_array('add', $modals)) {
	ajax_form_modal(['modal' => 'add_size', 'form' => 'add_size_form', 'url' => $this->c_controller.'/add_size_ajax', 'type' => $fm_type, 'item' => $item, 'crud_type' => 'Add', 'title' => 'Add '.$item], $fields);
}
//edit
if (in_array('edit', $modals)) {
	ajax_form_modal(['modal' => 'edit_size', 'form' => 'edit_size_form', 'url' => $this->c_controller.'/edit_size_ajax', 'type' => $fm_type, 'item' => $item, 'crud_type' => 'Edit', 'title' => 'Edit '.$item], $fields);
}