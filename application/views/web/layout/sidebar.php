      </div><!--/.col-main-->
      <aside class="sidebar col-sm-3 col-xs-12 <?php echo $this->session->company_shop_sidebar_position == 'left' ? 'col-sm-pull-9' : 'right'; ?>">
        <div class="block shop-by-side">
          <div class="sidebar-bar-title">
            <h3>Shop By</h3>
          </div>
          <div class="block-content">

            <div class="product-price-range">
              <div class="block-content">
                <div class="layered-Category">
                <h2 class="saider-bar-title">Price</h2>
                <div class="slider-range">
                  <div class="slider-range-price" id="price_range"></div>
                  <div class="price_input">
                    <input type="number" class="form-control price_min product_price" value="<?php echo $price_min; ?>" data-orig_price_min="<?php echo $price_min; ?>"> <span class="">-</span>
                    <input type="number" class="form-control price_max product_price" value="<?php echo $price_max; ?>" data-orig_price_max="<?php echo $price_max; ?>">
                  </div>
                  <button type="button" id="apply_price" class="btn btn-warning btn-sm m-t-10">Apply</button>
                </div>
                </div>
              </div>
            </div>
            
            <?php
            _product_filter_box('Categories', $product_cats, 'product_category', 'jtv');
            _product_filter_box('Sizes', $product_sizes, 'product_size', 'jtz');
            ?>
            <div class="layered-Category">
              <h2 class="saider-bar-title">Ratings</h2>
              <div class="layered-content product_categories">
                <ul class="check-box-list">
                  <?php
                  for ($j = 5; $j >= 0; $j--) { ?>
                    <li>
                      <input type="radio" name="product_rating" id="jtr<?php echo $j; ?>" value="<?php echo $j; ?>" class="product_rating">
                      <label for="jtr<?php echo $j; ?>"><span class="button"></span><?php echo rating_stars($j) . ($j < 5 ? ' & above' : ''); ?><span class="count"></span></label>
                    </li>
                    <?php
                  } ?>
                </ul>
              </div>
            </div>
            <?php
            _product_filter_box('Colours', $product_colors, 'product_color', 'jtc');
            ?>

          </div>
        </div>
        
        <?php
        if ($this->session->company_sidebar_slider == 1 && count($sidebar_sliders) > 0) { ?>
          <div class="single-img-add sidebar-add-slider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <?php
                $i = 1;
                foreach ($sidebar_sliders as $row) { ?>
                  <div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
                    <a href="<?php echo strlen($row->url) ? $row->url : '#!'; ?>">
                      <img src="<?php echo $row->image_file; ?>" alt="<?php echo $row->name; ?>">
                    </a>
                  </div>
                  <?php
                  $i++;
                } ?>
              </div>
          </div>
          <?php 
        } ?>

      </aside>
    </div><!-- /.row --> 
  </div><!-- /.container --> 
</div><!-- /.main-ontainer --> 


<?php
function _product_filter_box($title, $data, $class, $jtx) {
  if (count($data) > 0) { ?>
    <div class="layered-Category">
      <h2 class="saider-bar-title"><?php echo $title; ?></h2>
      <div class="layered-content product_categories">
        <ul class="check-box-list">
          <?php
          $j = 1;
          foreach ($data as $row) { 
            if ($row->product_count == 0) continue; 
            ?>
            <li>
              <?php
              if ($class == 'product_category' && strlen(xget('cat_id') == $row->id)) { ?>
                <input type="checkbox" id="<?php echo $jtx.$j; ?>" value="<?php echo $row->id; ?>" class="<?php echo $class; ?>" checked>
              <?php } else { ?> 
                <input type="checkbox" id="<?php echo $jtx.$j; ?>" value="<?php echo $row->id; ?>" class="<?php echo $class; ?>">
              <?php } ?>
              <label for="<?php echo $jtx.$j; ?>"><span class="button"></span><?php echo $class == 'product_color' ? print_color($row->color_code, $row->name) : $row->name; ?><span class="count">(<?php echo number_format($row->product_count); ?>)</span></label>
            </li>
            <?php
            $j++;
          } ?> 
        </ul>
      </div>
    </div>
    <?php 
  } 
}