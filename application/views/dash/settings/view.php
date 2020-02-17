
<h4>Core Info</h4>
<div class="row">
	<div class="<?php echo grid_col(12, '', 5); ?>">
		<?php 
		data_show_grid('Full Name', $row->name);
		data_show_grid('Short Name', $row->short_name);
		data_show_grid('Initials', $row->initials);
		?>
	</div>
	<div class="<?php echo grid_col(12, '', '5?2'); ?>">
		<?php 
		data_show_grid('Motto/Tagline', $row->tagline);
		data_show_grid('Currency', $row->curr_name); 
		?>
	</div>
</div>
<h4>Contact Info</h4>
<div class="row">
	<div class="<?php echo grid_col(12, '', 5); ?>">
		<?php
		data_show_grid('Phone 1 (Primary)', $row->phone_1);
		data_show_grid('Phone 2', $row->phone_2);
		data_show_grid('Phone 3', $row->phone_3);
		data_show_grid('Email 1 (Primary)', $row->email_1);
		data_show_grid('Email 2', $row->email_2);
		?>
	</div>
	<div class="<?php echo grid_col(12, '', '5?2'); ?>">
		<?php
		data_show_grid('Email 3', $row->email_3);
		data_show_grid('Address 1 (Primary)', $row->address_1);
		data_show_grid('Address 2', $row->address_2);
		data_show_grid('Address 3', $row->address_3);
		?>
	</div>
</div>
<h4>Social Handles</h4>
<div class="row">
	<div class="<?php echo grid_col(12, '', 5); ?>">
		<?php
		data_show_grid('Facebook', $row->social_facebook);
		data_show_grid('Instagram', $row->social_instagram);
		data_show_grid('WhatsApp', $row->social_whatsapp);
		?>
	</div>
	<div class="<?php echo grid_col(12, '', '5?2'); ?>">
		<?php
		data_show_grid('Twitter', $row->social_twitter);
		data_show_grid('LinkedIn', $row->social_linkedin);
		data_show_grid('Google+', $row->social_googleplus);
		?>
	</div>
</div>
<div class="row">
	<div class="<?php echo grid_col(12); ?>">
		<h4>About/Description</h4>
		<?php 
		data_show_list('Short Description', $row->short_description);
		data_show_list('Full Description', $row->description); 
		?>
	</div>
</div>
<div class="row">
	<div class="<?php echo grid_col(12); ?>">
		<h4>Payment Info</h4>
		<?php data_show_list('Bank Info', $row->bank_info); ?>
	</div>
</div>
<h4>Logo</h4>
<div class="row">
	<div class="<?php echo grid_col(12, '', 5); ?>">
		<?php
		data_show_list('Website Logo', '');
		$src = base_url(get_file(company_file_path(PIX_SETTINGS, $row->logo_site), SITE_LOGO));
		;
		image_thumbnail($src, $row->name);
		?>
	</div>
	<div class="<?php echo grid_col(12, '', '5?2'); ?>">
		<?php
		data_show_list('Portal Logo', '');
		$src = base_url(get_file(company_file_path(PIX_SETTINGS, $row->logo_portal), SITE_LOGO));
		image_thumbnail($src, $row->name);
		?>
	</div>
</div>