<?php

//categories
$sql = $this->slider_model->cats_sql($this->company_id);
$cats = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], $sql['order']);;

//next order 
$next_order = $this->common_model->next_order(T_SLIDERS);

//row details
$row = $type == 'edit' ? $row : '';
		
//form
$attrs = ['id' => $type.'_form', 'class' => 'ajax_form', 'data-type' => 'redirect', 'data-redirect' => '_dynamic'];
echo form_open_multipart($this->c_controller.'/'.$type.'_ajax', $attrs);
	xform_pre_notice();
	xform_notice();
	xform_input('id', 'hidden', adit_value($row, 'id')); ?>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php 
			xform_group_grid('Name', 'name', 'text', adit_value($row, 'name'), true);
			xform_group_grid('URL', 'url', 'text', adit_value($row, 'url'));
			xform_group_grid('Category', 'cat_id', 'select', adit_value($row, 'cat_id', xget('cat_id')), true, ['options' => $cats, 'text_col' => 'title']);
			?>
		</div>
		<div class="<?php echo grid_col(12, '', '5?2'); ?>">
			<?php
			xform_group_grid('Order', 'order', 'number', adit_value($row, 'order', $next_order), true, ['min' => 0]);
			xform_group_grid('Image', 'image', 'file', '', $type == 'add', ['help' => 'Allowed types: jpg, jpeg, png, gif. Max 1MB. <br />Ideal dimension: Home/Shop Top - 1170x520; Sidebar - 270x380; About Us - 525x380']);
			?>
		</div>
	</div>
	<?php
echo form_close();