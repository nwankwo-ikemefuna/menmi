<?php
$attrs = ['id' => 'reset_pass_form', 'class' => 'ajax_form', 'data-type' => 'redirect', 'data-redirect' => '_ajax_dynamic'];
echo form_open($this->c_controller.'/reset_pass_ajax', $attrs);
	xform_notice();
	?>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php 
			xform_group_list('Current Password', 'curr_password', 'password', '', true);
			xform_group_list('New Password', 'password', 'password', '', true);
			xform_group_list('Confirm New Password', 'c_password', 'password', '', true);
			?>
		</div>
	</div>
	<?php
echo form_close();