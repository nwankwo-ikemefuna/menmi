<?php

//tags
$sql = $this->common_model->tags_sql();
$tags = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where']);
//colours
$sql = $this->common_model->colors_sql();
$colors = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where']);

//row details
$row = $type == 'edit' ? $row : '';
		
//form
$attrs = ['id' => $type.'_form', 'class' => 'ajax_form', 'data-type' => 'redirect', 'data-redirect' => '_dynamic'];
echo form_open($this->c_controller.'/'.$type.'_ajax', $attrs);
	xform_notice();
	xform_input('id', 'hidden', adit_value($row, 'id')); ?>
	<div class="row">
		<div class="<?php echo grid_col(2, 'left'); ?>">
			<?php 
			xform_group_grid('Name', 'name', 'text', adit_value($row, 'name'), true);
			xform_group_grid('Category', 'cat_id', 'select', '', true, 
				['ajax' => true, 
					'selected' => adit_value($row, 'cat_id'),
					'extra' => ['class' => 'ajax_select', 'data-url' => $this->c_controller.'/cats_select_ajax']
				], [], [], 
				['append' => modal_input_button('add_cat', $this->c_controller.'/cats_select_ajax', 'cat_id')]
			);
			xform_group_grid('Barcode', 'barcode', 'text', adit_value($row, 'barcode'));
			xform_group_grid('Serial No', 'serial_no', 'text', adit_value($row, 'serial_no'));
			xform_group_grid('Stock', 'stock', 'number', adit_value($row, 'stock'), true, ['min' => 0]);
			?>
		</div>
		<div class="<?php echo grid_col(2, 'right'); ?>">
			<?php
			xform_group_grid('Size', 'size', 'select', adit_value($row, 'size'), true, 
				['ajax' => true, 
					'selected' => adit_value($row, 'size'),
					'extra' => ['class' => 'ajax_select', 'data-url' => $this->c_controller.'/size_select_ajax']
				], [], [], 
				['append' => modal_input_button('add_size', $this->c_controller.'/size_select_ajax', 'size')]
			);
			xform_group_grid('Price', 'price', 'number', adit_value($row, 'price'), true, ['min' => 0], [], [], ['prepend' => input_group_text($this->company_curr)]);
			xform_group_grid('Old Price', 'price_old', 'number', adit_value($row, 'price_old'), false, ['min' => 0], [], [], ['prepend' => input_group_text($this->company_curr)]);
			xform_group_grid('Tags', 'tags[]', 'select', '', false, 
				['options' => $tags, 'text_col' => 'title', 'blank' => false, 
					'selected' => json_encode(explode(',', adit_value($row, 'tags'))),
					'extra' => ['multiple' => '', 'class' => 'select_mult']
				]);
			xform_group_grid('Colour', 'color', 'select', adit_value($row, 'color'), false, ['options' => $colors, 'text_col' => 'name']);
			?>
		</div>
	</div>
	<?php
echo form_close();

//product cats, sizes
$modals = ['add'];
$fm_type = 'modal_sp';
require 'cats/modals.php';
require 'sizes/modals.php';