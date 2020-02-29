<?php 
$sidebar_position = 'right';
$hide_title = true;
require 'application/views/web/layout/shop_sidebar_start.php'; ?>

<div class="product-view-area">
  <div class="product-big-image col-xs-12 col-sm-5 col-lg-5 col-md-5">
    <div class="large-image">
      <a href="<?php echo $row->image_file; ?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
        <img class="zoom-img cloud_big_image" src="<?php echo $row->image_file; ?>" alt="<?php echo $row->name; ?>">
      </a>
    </div>
    <?php 
    $prod_images = split_us($row->images);
    if (count($prod_images) > 0) { ?>
      <div class="slider-items-products col-md-12">
        <div id="thumbnail-slider" class="product-flexslider hidden-buttons product-thumbnail">
          <div class="slider-items slider-width-col3">
            <?php 
            foreach ($prod_images as $_image) { 
              $image_src = base_url(company_file_path(PIX_PRODUCTS, $_image)); ?>
              <div class="thumbnail-items">
                <img src="<?php echo $image_src; ?>" class="cloud_small_image clickable" alt="<?php echo $row->name; ?>" />
              </div>
              <?php
            } ?>   
          </div>
        </div>
      </div>
      <?php 
    } ?>
    <!-- end: more-images --> 
    
  </div>
  <div class="col-xs-12 col-sm-7 col-lg-7 col-md-7 product-details-area">
    <div class="product-name">
      <h3><?php echo $row->name; ?></h3>
    </div>
    <div class="price-box">
      <p class="special-price"> <span class="price-label">Special Price</span><span class="price"><?php echo $row->amount; ?></span></p>
      <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"><?php echo $row->amount_old; ?></span> </p>
    </div>
    <div class="ratings">
      <div><?php echo rating_stars($row->rating); ?>
        <p class="pull-right">
          <?php if ($row->stock > 0) { ?>
            <span class="badge badge-success">In Stock</span>
          <?php } else { ?>
            <span class="badge badge-danger" style="background: red">Sold Out</span>
          <?php } ?>
        </p>
      </div>
    </div>
    <div class="short-description">
      <h4 class="text-bold">Product Overview</h4>
      <p><?php echo word_limiter($row->description, 30, '<a class="text-primary" href="#full_desc">...Full description</a>'); ?></p>
    </div>
    <div class="product-color-size-area">
      <div class="size-area">
        <h2 class="saider-bar-title">Size</h2>
        <div class="size">
          <?php echo $row->size_name; ?>
        </div>
      </div>
      <?php if (strlen($row->color_codes)) { ?>
        <div class="color-area">
          <h2 class="saider-bar-title">Colors</h2>
          <div class="color">
            <?php echo print_colors($row->color_codes); ?>
          </div>
        </div>
      <?php } ?> 
    </div>
    <div class="product-variation">
      <?php if ($row->stock < 1) { ?>
        <h5 class="text-danger">Product currently out of stock, but you can add it to your wishlist and make your purchase when it becomes available</h5>
        <?php 
      } ?>
      <?php if ($row->stock > 0) { ?>
        <button class="button pro-add-to-cart basket_product" type="button" title="Add to Cart" data-id="<?php echo $row->id; ?>"data-in_cart="<?php echo $in_cart; ?>" <?php echo $in_cart == 1 ? 'disabled' : ''; ?>><span>Add to Cart</span></button>
        <?php 
      } ?>
      <button class="button pro-add-to-cart wishlist_product m-l-10" type="button" title="Add to Wishlist" data-id="<?php echo $row->id; ?>"data-in_wishlist="<?php echo $in_wishlist; ?>" <?php echo $in_wishlist == 1 ? 'disabled' : ''; ?>><span>Add to Wishlist</span></button>
      <button class="button pro-add-to-cart view-cart m-l-10" type="button" onClick="location.href='<?php echo base_url('shop/cart'); ?>'"><span>View Cart</span></button>
    </div>
  </div>
</div>
<div class="product-overview-tab" id="full_desc">
  <div class="product-tab-inner">
    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
      <li class="active"> <a href="#description" data-toggle="tab">Full Description</a> </li>
      <li> <a href="#reviews" data-toggle="tab">Reviews</a> </li>
      <li><a href="#product_tags" data-toggle="tab">Tags</a></li>
    </ul>
    <div id="productTabContent" class="tab-content">
      <div class="tab-pane fade in active" id="description">
        <div class="std">
          <p><?php echo $row->description; ?></p>
        </div>
      </div>
      <div id="reviews" class="tab-pane fade">
        <div class="col-sm-5 col-lg-5 col-md-5">
          <div class="reviews-content-left">
            <h2>Customer Reviews</h2>
            <div class="review-ratting">
            </div>
          </div>
        </div>
        <div class="col-sm-7 col-lg-7 col-md-7">
          <div class="reviews-content-right">
            <h2>Write Your Own Review</h2>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="product_tags">
        <div class="box-collateral box-tags popular-tags-area">
          <div class="tag">
            <ul>
              <?php
              if (count($tags) > 0) {
                foreach ($tags as $tag_id => $tag_name) { ?>
                  <li><a href="<?php echo base_url('shop?type=tagged&tag='.$tag_id.'&tag_name='.urlencode($tag_name)); ?>"><?php echo $tag_name; ?></a></li>
                  <?php
                } 
              } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
$sidebar_sections = ['featured', 'slider', 'tags'];
require 'application/views/web/layout/shop_sidebar_end.php';
products_col_slider('Related Products', $related_products, 'shop?type=related&rel_id='.$row->id.'&rel_name='.urlencode($row->name).'&rel_tags='.$row->p_tags);
products_col_slider('Products You Viewed', $viewed_products, 'shop?type=viewed');
cart_modal();