<!-- Shop Slider -->
<?php
if ($this->session->company_shop_slider == 1 && count($shop_sliders) > 0) { ?>
  <div class="category-description">
     <div class="slider-items-products">
        <div id="category-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4">
            <?php
            foreach ($shop_sliders as $row) { ?>
              <a href="<?php echo strlen($row->url) ? $row->url : '#!'; ?>"><img src="<?php echo $row->image_file; ?>" alt="<?php echo $row->name; ?>"></a>
              <?php 
            } ?>
          </div>
        </div>
      </div>
  </div>
  <?php 
} ?>

<h5 id="total_found"></h5>
<div class="row m-b-20">
  <div class="<?php echo grid_col(12, 8, 8); ?> p-b-10">
    <div class="input-group">
      <span class="input-group-btn">
        <button type="button" id="cancel_search" class="btn btn-warning" title="Cancel search"><i class="fa fa-remove"></i></button>
      </span>
      <input type="text" name="search" class="form-control" value="<?php echo urldecode(xget('search')); ?>" placeholder="Search shop">
      <span class="input-group-btn">
        <button type="button" id="search_shop" class="btn btn-warning" title="Search shop"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </div>
  <div class="<?php echo grid_col(8, 3, 3); ?> p-b-10">
    <?php
    $options = ['popular' => 'Most Popular', 'rated' => 'Most Rated', 'newest' => 'Newest', 'price_low' => 'Lowest Price', 'price_high' => 'Highest Price'];
    xform_select('sort_by', '', false, ['options' => $options, 'blank_text' => 'Sort By:']);
    ?>
  </div>
  <div class="<?php echo grid_col(4, 1, 1); ?>">
    <button type="button" id="clear_filter" class="btn btn-warning btn-sm" title="Reset filter to browse all records">Reset</button>
  </div>
</div>

<div class="product-grid-area">
  <div class="products-grid equal_cols" id="products">
  </div>
</div>
<div id="pagination" class="pagination-area m-b-20">
</div>