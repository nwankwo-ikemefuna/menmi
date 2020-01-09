<?php
$fields = [
	['name' => 'id', 'type' => 'hidden'],
	['name' => 'template_id', 'value' => $row->id, 'type' => 'hidden'],
	['name' => 'name', 'label' => 'Title', 'required' => true],
	['name' => 'cat_id', 'label' => 'Category', 'type' => 'select', 'required' => true, 'extra' => ['db' => true, 'options' => $categories, 'text_col' => 'name']]
];
$item = 'Item';
adit_form_modal('add', $item, $fields);
adit_form_modal('edit', $item, $fields);