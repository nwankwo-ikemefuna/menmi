<div class="row">
	<div class="<?php echo grid_col(12); ?>">
		<?php 
		data_show_grid('Sender Name', $row->sender_name);
		data_show_grid('Email', $row->email);
		data_show_grid('Phone', $row->phone);
		?>
	</div>
	<div class="<?php echo grid_col(12); ?>">
		<?php data_show_list('Message', $row->message); ?>
	</div>
</div>