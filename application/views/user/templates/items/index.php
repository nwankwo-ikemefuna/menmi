<?php
form_input('template_id', 'hidden', $row->id);
$columns = ['Item Name' => 'min-w-200', 'Category', 'Actions' => 'min-w-100'];
ajax_table('items_table', $columns); ?>

<?php 
// Add Modal
adit_modal('m_add', 'New Item', 'add_form', $row->id, $categories);
//Edit Modal
adit_modal('m_edit', 'Edit Item', 'edit_form', $row->id, $categories, true);


function adit_modal($modal, $title, $form, $template_id, $categories, $is_edit = false) {
	//Edit Modal
	modal_header($modal, $title, '', '');
		$attrs = ["id" => $form];
		echo form_open(null, $attrs);
			if ($is_edit) form_input('id', 'hidden');
			form_input('template_id', 'hidden', $template_id);
		    form_group_input('Title', 'name', 'text');
		    form_group_select_db('Category', 'cat_id',  $categories, 'id', 'name');
		    form_notice();
		    form_submit();
		echo form_close();
	modal_footer(false); 
}