<h4>Product Images</h4>
<div class="card-deck">
	<?php 
	$images = explode(',', $row->images);
	foreach ($images as $img) {
		$file = company_file_path(PIX_PRODUCTS, $img);
		$src = base_url(get_file($file, IMAGE_404));
		if ($img == $row->image) {
			$footer = bs_badge('Featured', 'success');
		} else {
			$footer = link_button('', $this->c_controller.'/set_featured_image/'.$row->id.'/'.$img, 'tag', 'info', 'Set as Featured', 'btn-xs').' ';
			$footer .= link_button('', $this->c_controller.'/delete_image/'.$row->id.'/'.$img, 'trash', 'danger', 'Delete image', 'btn-xs');
		} 
		$footer = '<div class="text-center">'.$footer.'</div>';
		image_thumbnail($src, $row->name, $footer);
	} ?>
</div>