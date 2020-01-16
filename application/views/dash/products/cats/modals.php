<?php 
$fields = [
	['name' => 'id', 'type' => 'hidden'],
	['name' => 'name', 'label' => 'Name', 'required' => true],
	['name' => 'order', 'label' => 'Order', 'type' => 'number', 'required' => true, 'value' => 10, 'extra' => ['min' => 0]]
];

$item = 'Product Category';
$fm_type = $fm_type ?? 'modal_dt';
//add
if (in_array('add', $modals)) {
	ajax_form_modal(['modal' => 'add_cat', 'form' => 'add_cat_form', 'url' => $this->c_controller.'/add_cat_ajax', 'type' => $fm_type, 'item' => $item, 'crud_type' => 'Add', 'title' => 'Add '.$item], $fields);
}
//edit
if (in_array('edit', $modals)) {
	ajax_form_modal(['modal' => 'edit_cat', 'form' => 'edit_cat_form', 'url' => $this->c_controller.'/edit_cat_ajax', 'type' => $fm_type, 'item' => $item, 'crud_type' => 'Edit', 'title' => 'Edit '.$item], $fields);
}