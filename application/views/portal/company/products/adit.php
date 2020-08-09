<?php

//app tags
$sql = $this->common_model->tags_sql();
$tags = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where']);
//colours
$colors = $this->common_model->get_colors();

//row details
$row = $type == 'edit' ? $row : '';
		
//form
$attrs = ['id' => $type.'_form', 'class' => 'ajax_form', 'data-type' => 'redirect', 'data-redirect' => '_ajax_dynamic'];
echo form_open_multipart($this->c_controller.'/'.$type.'_ajax', $attrs);
	xform_pre_notice();
	xform_notice();
	xform_input('id', 'hidden', adit_value($row, 'id')); ?>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php 
			xform_group_grid('Name', 'name', 'text', adit_value($row, 'name', ''), true);
			xform_group_grid('Category', 'cat_id', 'select', '', true, 
				[
					'ajax' => true, 
					'selected' => adit_value($row, 'cat_id'),
					'extra' => ['class' => 'ajax_select', 'data-url' => $this->c_controller.'/cat_select_ajax']
				], [], [], 
				['append' => modal_input_button('add_cat', $this->c_controller.'/cat_select_ajax', 'cat_id')]
			);
			xform_group_grid('Barcode', 'barcode', 'text', adit_value($row, 'barcode'));
			xform_group_grid('Serial No', 'serial_no', 'text', adit_value($row, 'serial_no'));
			$stock_append = $type == 'edit' ? ['append' => input_group_text(number_format($row->stock).' total')] : [];
			xform_group_grid($type == 'edit' ? 'New Stock' : 'Stock', 'stock', 'number', 0, $type == 'add', ['min' => 0],  [], [], $stock_append);
			xform_group_grid('Size', 'size', 'select', adit_value($row, 'size'), true, 
				[
					'ajax' => true, 
					'selected' => adit_value($row, 'size'),
					'extra' => ['class' => 'ajax_select', 'data-url' => $this->c_controller.'/size_select_ajax']
				], [], [], 
				['append' => modal_input_button('add_size', $this->c_controller.'/size_select_ajax', 'size')]
			);
			?>
		</div>
		<div class="<?php echo grid_col(12, '', '5?2'); ?>">
			<?php
			xform_group_grid('Price', 'price', 'number', adit_value($row, 'price'), true, ['min' => 0], [], [], ['prepend' => input_group_text($this->company_curr)]);
			xform_group_grid('Old Price', 'price_old', 'number', adit_value($row, 'price_old'), false, ['min' => 0], [], [], ['prepend' => input_group_text($this->company_curr)]);
			xform_group_grid('Tags', 'tags[]', 'select', '', false, 
				[
					'options' => $tags, 'text_col' => 'title', 'blank' => false, 
					'selected' => json_encode(explode(',', adit_value($row, 'tags'))),
					'extra' => ['multiple' => '', 'class' => 'select_mult']
				]
			);
			xform_group_grid('Custom Tags', 'p_tags[]', 'select', adit_value($row, 'p_tags'), true, 
				[
					'ajax' => true, 
					'selected' => json_encode(explode(',', adit_value($row, 'p_tags'))),
					'extra' => ['multiple' => '', 'class' => 'ajax_select select_mult', 'data-url' => $this->c_controller.'/tag_select_ajax']
				], [], [], 
				['append' => modal_input_button('add_tag', $this->c_controller.'/tag_select_ajax', 'p_tags[]')]
			);
			xform_group_grid('Colours', 'colors[]', 'select', '', false, 
				['options' => $colors, 'blank' => false, 
					'selected' => json_encode(explode(',', adit_value($row, 'colors'))),
					'extra' => ['multiple' => '', 'class' => 'select_mult']
				]
			);
			?>
		</div>
	</div>
	<div class="row">
		<div class="<?php echo grid_col(12); ?>">
			<?php xform_group_list('Description', 'description', 'textarea', adit_value($row, 'description', '', true), true, ['rows' => 12]); ?>
		</div>
	</div>
	<div class="row">
		<div class="<?php echo grid_col(12); ?>">
			<?php xform_group_list('Images', 'images[]', 'file', '', $type == 'add', ['multiple' => '', 'help' => 'Allowed types: jpg, jpeg, png, gif. Max 300KB. Up to 6 images allowed. <br />Ideal dimension: 800x800']); ?>
		</div>
	</div>
	<?php
echo form_close();

//product cats, sizes, tags
$modals = ['add'];
$fm_type = 'modal_sp';
require 'cats/modals.php';
require 'sizes/modals.php';
require 'tags/modals.php';