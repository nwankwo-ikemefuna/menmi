<div class="row">
	<div class="<?php echo grid_col(12, 6); ?>">
		<?php 
		data_show_grid('Name', $row->name);
		data_show_grid('URL', '<a class="underline" href="'.$row->url.'" target="_blank">'.$row->url.'</a>');
		data_show_grid('Category', $row->category);
		?>
	</div>
	<div class="<?php echo grid_col(12, 6); ?>">
		<?php
		data_show_grid('Order', $row->order);
		data_show_grid('Date Created', $row->created_on);
		data_show_grid('Date Updated', $row->updated_on);
		?>
	</div>
	<div class="<?php echo grid_col(12); ?>">
		<?php
		$src = base_url(get_file(company_file_path(PIX_SLIDERS, $row->image), IMAGE_404));
		image_thumbnail($src, $row->name); ?>
	</div>
</div>