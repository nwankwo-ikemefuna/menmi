<?php 
$type = 'edit';
require 'adit.php'; ?>

<div class="row">
	<div class="<?php echo grid_col(12); ?>">
		<?php
		$src = base_url(get_file(company_file_path(PIX_SLIDERS, $row->image), IMAGE_404));
		image_thumbnail($src, $row->name); ?>
	</div>
</div>