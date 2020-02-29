      </div><!--/.col-main-->

      <?php 
      //is custom position set?
      $position = $sidebar_position ?? $this->session->company_shop_sidebar_position;
      $position_col = $position == 'left' ? 'col-sm-pull-9' : 'right'; ?>
      <aside class="sidebar col-sm-3 col-xs-12 <?php echo $position_col; ?>">

        <?php 
        //product filtering on shop page
        if (in_array('shop_filter', $sidebar_sections)) { ?>
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
        } ?>
        
        <?php
        //checkout order summary
        if (in_array('order_summary', $sidebar_sections)) { ?>
          <div class="block special-product">
            <div class="sidebar-bar-title">
              <h3>Order Summary</h3>
            </div>
            <div class="block-content">
              <?php product_order_summary(); ?>
              <?php payment_cards('<h4>Secure Payment Channels</h4>'); ?>
            </div>
          </div>
          <?php 
        } ?>

        <?php
        //featured products
        if (in_array('featured', $sidebar_sections)) { 
          $featured_products = $this->shop_model->featured([], 'rand', 3);
          if (count($featured_products) > 0) { ?>
            <div class="block special-product">
              <div class="sidebar-bar-title">
                <h3>Suggested Products</h3>
              </div>
              <div class="block-content">
                <ul>
                  <?php
                  $i = 1;
                  foreach ($featured_products as $side_row) { ?>
                    <li class="item">
                      <div class="products-block-left"> <a href="<?php echo product_url($side_row['id'], $side_row['name']); ?>" title="<?php echo $side_row['name']; ?>" class="product-image"><img src="<?php echo $side_row['image_file']; ?>" alt="<?php echo $side_row['name']; ?>"></a></div>
                      <div class="products-block-right">
                        <p class="product-name"> <a href="<?php echo product_url($side_row['id'], $side_row['name']); ?>"><?php echo $side_row['name']; ?></a> </p>
                        <span class="price"><?php echo $side_row['amount']; ?></span>
                        <div><?php echo rating_stars($side_row['rating']); ?></div>
                      </div>
                    </li>
                    <?php
                  } ?>
                </ul>
                <a class="link-all" href="<?php echo base_url('shop'); ?>">All Products</a> 
              </div>
            </div>
            <?php
          }
        } ?>
        
        <?php
        //sliders
        if (in_array('slider', $sidebar_sections) && $this->session->company_sidebar_slider == 1) { 
          $sql = $this->slider_model->sql($this->company_id);
          $where = array_merge($sql['where'], ['cat_id' => SLIDER_SIDEBAR]);
          $sliders = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, 'rand', '', 3);
          if (count($sliders) > 0) { ?>
            <div class="single-img-add sidebar-add-slider">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <?php
                  $i = 1;
                  foreach ($sliders as $side_row) { ?>
                    <div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
                      <a href="<?php echo strlen($side_row->url) ? $side_row->url : '#!'; ?>">
                        <img src="<?php echo $side_row->image_file; ?>" alt="<?php echo $side_row->name; ?>">
                      </a>
                    </div>
                    <?php
                    $i++;
                  } ?>
                </div>
              </div>
            </div>
            <?php 
          } 
        } ?>

        <?php
        //popular tags
        if (in_array('tags', $sidebar_sections)) { 
          $sql = $this->product_model->tags_sql($this->company_id);
          $tags = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $sql['where'], 'rand', '', 12);
          if (count($tags) > 0) { ?>
            <div class="block popular-tags-area">
              <div class="sidebar-bar-title">
                <h3>Popular Tags</h3>
              </div>
              <div class="tag">
                <ul>
                  <?php
                  foreach ($tags as $side_row) { 
                    //has product?
                    if ($side_row->product_count == 0) continue; ?>
                    <li><a href="<?php echo base_url('shop?type=tagged&tag='.$side_row->id.'&tag_name='.urlencode($side_row->name)); ?>"><?php echo $side_row->name; ?></a></li>
                    <?php
                  } ?>
                </ul>
              </div>
            </div>
            <?php
          }
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
          foreach ($data as $side_row) { 
            if ($side_row->product_count == 0) continue; 
            ?>
            <li>
              <?php
              if ($class == 'product_category' && strlen(xget('cat_id') == $side_row->id)) { ?>
                <input type="checkbox" id="<?php echo $jtx.$j; ?>" value="<?php echo $side_row->id; ?>" class="<?php echo $class; ?>" checked>
              <?php } else { ?> 
                <input type="checkbox" id="<?php echo $jtx.$j; ?>" value="<?php echo $side_row->id; ?>" class="<?php echo $class; ?>">
              <?php } ?>
              <label for="<?php echo $jtx.$j; ?>"><span class="button"></span><?php echo $class == 'product_color' ? print_color($side_row->color_code, $side_row->name) : $side_row->name; ?><span class="count">(<?php echo number_format($side_row->product_count); ?>)</span></label>
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