<div class="row">
	<div class="<?php echo grid_col(12, '', 5); ?>">
		<?php 
		data_show_grid('Name', $row->name);
		data_show_grid('Category', $row->category);
		data_show_grid('Barcode', $row->barcode);
		data_show_grid('Serial Number', $row->serial_no);
		data_show_grid('Stock', $row->stock);
		?>
	</div>
	<div class="<?php echo grid_col(12, '', '5?2'); ?>">
		<?php
		data_show_grid('Size', $row->size_name);
		data_show_grid('Price', $row->amount);
		data_show_grid('Old Price', $row->amount_old);
		data_show_grid('Tags', $row->tag_names);
		data_show_grid('Colour', $row->color_name);
		?>
	</div>
</div>