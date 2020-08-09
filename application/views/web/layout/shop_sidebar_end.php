      </div><!--/.col-main-->

      <?php 
      //is custom position set?
      $position = $sidebar_position ?? $this->session->company_shop_sidebar_position;
      $position_col = $position == 'left' ? 'col-sm-pull-9' : 'right'; ?>
      <aside class="sidebar col-sm-3 col-xs-12 <?php echo $position_col; ?>">

        <?php 
        //product filtering on shop page
        if (in_array('shop_filter', $sidebar_sections)) { ?>
          <div class="block shop-by-side" id="shop_filter_side">
            <div class="sidebar-bar-title">
              <h3>Shop By</h3>
            </div>
            <div class="block-content">

              <?php
              product_price_filter('price_range_side', $price_min, $price_max);
              product_filter_box('Categories', $product_cats, 'product_category', 's_jtv');
              product_filter_box('Sizes', $product_sizes, 'product_size', 's_jtz');
              product_rating_filter('s_jtr');
              product_filter_box('Colours', $product_colors, 'product_color', 's_jtc');
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
          if (!empty($featured_products)) { ?>
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
                      <div class="products-block-left"> <a href="<?php echo product_url($side_row['id'], $side_row['name']); ?>" title="<?php echo $side_row['name']; ?>" class="product-image"><img src="<?php echo base_url($side_row['image_file']); ?>" alt="<?php echo $side_row['name']; ?>"></a></div>
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
          if (!empty($sliders)) { ?>
            <div class="single-img-add sidebar-add-slider">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <?php
                  $i = 1;
                  foreach ($sliders as $side_row) { ?>
                    <div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
                      <a href="<?php echo strlen($side_row->url) ? $side_row->url : '#!'; ?>">
                        <img src="<?php echo base_url($side_row->image_file); ?>" alt="<?php echo $side_row->name; ?>">
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
          if (!empty($tags)) { ?>
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