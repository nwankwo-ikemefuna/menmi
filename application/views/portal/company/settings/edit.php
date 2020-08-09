<?php

//currencies
$sql = $this->common_model->currencies_sql();
$currencies = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where']);
//next order 
$next_order = $this->common_model->next_order(T_CURRENCIES);

//form
$attrs = ['id' => 'edit_form', 'class' => 'ajax_form', 'data-type' => 'redirect', 'data-redirect' => '_ajax_dynamic'];
echo form_open_multipart($this->c_controller.'/edit_ajax', $attrs);
	xform_pre_notice();
	xform_notice();
	xform_input('id', 'hidden', adit_value($row, 'id')); ?>
	<h4>Core Info</h4>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php 
			xform_group_grid('Full Name', 'name', 'text', adit_value($row, 'name'), true);
			xform_group_grid('Short Name', 'short_name', 'text', adit_value($row, 'short_name'), true);
			xform_group_grid('Initials', 'initials', 'text', adit_value($row, 'initials'), true);
			?>
		</div>
		<div class="<?php echo grid_col(12, '', '5?2'); ?>">
			<?php 
			xform_group_grid('Motto/Tagline', 'tagline', 'text', adit_value($row, 'tagline'), true);
			xform_group_grid('Currency', 'curr_id', 'select', adit_value($row, 'curr_id'), true, ['options' => $currencies, 'text_col' => 'curr_name']); ?>
		</div>
	</div>
	<h4>Contact Info</h4>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php
			xform_group_grid('Phone 1 (Primary)', 'phone_1', 'text', adit_value($row, 'phone_1'), true);
			xform_group_grid('Phone 2', 'phone_2', 'text', adit_value($row, 'phone_2'));
			xform_group_grid('Phone 3', 'phone_3', 'text', adit_value($row, 'phone_3'));
			xform_group_grid('Email 1 (Primary)', 'email_1', 'email', adit_value($row, 'email_1'), true);
			xform_group_grid('Email 2', 'email_2', 'email', adit_value($row, 'email_2'));
			?>
		</div>
		<div class="<?php echo grid_col(12, '', '5?2'); ?>">
			<?php
			xform_group_grid('Email 3', 'email_3', 'email', adit_value($row, 'email_3'));
			xform_group_grid('Address 1 (Primary)', 'address_1', 'text', adit_value($row, 'address_1'));
			xform_group_grid('Address 2', 'address_2', 'text', adit_value($row, 'address_2'));
			xform_group_grid('Address 3', 'address_3', 'text', adit_value($row, 'address_3'));
			?>
		</div>
	</div>
	<h4>Social Handles</h4>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php
			xform_group_grid('Facebook', 'social_facebook', 'text', adit_value($row, 'social_facebook'));
			xform_group_grid('Instagram', 'social_instagram', 'text', adit_value($row, 'social_instagram'));
			xform_group_grid('WhatsApp', 'social_whatsapp', 'text', adit_value($row, 'social_whatsapp'));
			?>
		</div>
		<div class="<?php echo grid_col(12, '', '5?2'); ?>">
			<?php
			xform_group_grid('Twitter', 'social_twitter', 'text', adit_value($row, 'social_twitter'));
			xform_group_grid('LinkedIn', 'social_linkedin', 'text', adit_value($row, 'social_linkedin'));
			xform_group_grid('Google+', 'social_googleplus', 'text', adit_value($row, 'social_googleplus'));
			?>
		</div>
	</div>
	<div class="row">
		<div class="<?php echo grid_col(12); ?>">
			<h4>About/Description</h4>
			<?php 
			xform_group_list('Short Description', 'short_description', 'textarea', adit_value($row, 'short_description', '', true), true, ['rows' => 8]); 
			xform_group_list('Full Description', 'description', 'textarea', adit_value($row, 'description', '', true), true, ['rows' => 12]); 
			?>
		</div>
	</div>
	<div class="row">
		<div class="<?php echo grid_col(12); ?>">
			<h4>Payment Info</h4>
			<?php xform_group_list('Bank Info', 'bank_info', 'textarea', adit_value($row, 'bank_info', '', true), true, ['rows' => 8]); ?>
		</div>
	</div>
	<h4>Logo</h4>
	<small>Allowed types: jpg, jpeg, png. Max 100KB. Ideal dimension: 120x90</small>
	<div class="row">
		<div class="<?php echo grid_col(12, '', 5); ?>">
			<?php
			xform_group_list('Website Logo', 'logo_site', 'file', '', false);
			$src = base_url(get_file(company_file_path(PIX_SETTINGS, $row->logo_site), SITE_LOGO));
			image_thumbnail($src, $row->name);
			?>
		</div>
		<div class="<?php echo grid_col(12, '', '5?2'); ?>">
			<?php
			xform_group_list('Portal Logo', 'logo_portal', 'file', '', false);
			$src = base_url(get_file(company_file_path(PIX_SETTINGS, $row->logo_portal), SITE_LOGO));
			image_thumbnail($src, $row->name);
			?>
		</div>
	</div>
	<?php
echo form_close();
?>