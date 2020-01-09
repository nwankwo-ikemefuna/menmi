<?php 
$fields = [
	['name' => 'name', 'label' => 'Name', 'required' => true],
	['name' => 'vat', 'label' => 'VAT', 'type' => 'number', 'required' => true],
];
$item = 'Template';
adit_form_modal('add', $item, $fields);
adit_form_modal('edit', $item, $fields);