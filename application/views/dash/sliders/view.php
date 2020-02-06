<div class="row">
	<div class="<?php echo grid_col(12, 6, 5); ?>">
		<?php 
		data_show_grid('Name', $row->name);
		data_show_grid('Message', $row->message);
		data_show_grid('Tag', $row->tag);
		data_show_grid('Button Text', $row->btn_text);
		?>
	</div>
	<div class="<?php echo grid_col(12, 6, '5?2'); ?>">
		<?php
		data_show_grid('URL', '<a class="underline" href="'.$row->url.'" target="_blank">'.$row->url.'</a>');
		data_show_grid('Category', $row->category);
		data_show_grid('Order', $row->order);
		data_show_grid('Date Created', $row->created_on);
		data_show_grid('Date Updated', $row->updated_on);
		?>
	</div>
	<div class="<?php echo grid_col(12); ?>">
		<?php
		$file = company_file_path(PIX_SLIDERS, $row->image);
		$src = base_url(get_file($file, IMAGE_404));
		image_thumbnail($src, $row->name); ?>
	</div>
</div>