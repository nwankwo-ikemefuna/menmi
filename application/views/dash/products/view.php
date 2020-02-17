<div class="row">
	<div class="<?php echo grid_col(12, 6, 5); ?>">
		<?php 
		data_show_grid('Name', $row->name);
		data_show_grid('Category', $row->category);
		data_show_grid('Barcode', $row->barcode);
		data_show_grid('Serial Number', $row->serial_no);
		data_show_grid('Stock', $row->stock);
		data_show_grid('Size', $row->size_name);
		data_show_grid('Rating', rating_stars($row->rating));
		?>
	</div>
	<div class="<?php echo grid_col(12, 6, '5?2'); ?>">
		<?php
		data_show_grid('Price', $row->amount);
		data_show_grid('Old Price', $row->amount_old);
		data_show_grid('Tags', $row->tag_names);
		data_show_grid('Custom Tags', $row->p_tag_names);
		data_show_grid('Colours', print_colors($row->color_codes, $row->color_names));
		data_show_grid('Date Created', $row->created_on);
		data_show_grid('Date Updated', $row->updated_on);
		?>
	</div>
	<div class="<?php echo grid_col(12); ?>">
		<?php data_show_list('Description', $row->description); ?>
	</div>
	<div class="<?php echo grid_col(12); ?>">
		<?php require 'common/images.php'; ?>
	</div>
</div>