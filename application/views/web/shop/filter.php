<button class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#filter_section">
  <i class="fa fa-filter"></i> Filter Products
</button>
<div class="collapse" id="filter_section">
  <?php
  product_price_filter('price_range', $price_min, $price_max);
  product_filter_box('Categories', $product_cats, 'product_category', 'jtv');
  product_filter_box('Sizes', $product_sizes, 'product_size', 'jtz');
  product_rating_filter('jtr');
  product_filter_box('Colours', $product_colors, 'product_color', 'jtc');
  ?>
</div>