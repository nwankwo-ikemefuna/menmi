<!-- Main Container -->
<div class="main-container col1-layout">
  <div class="container">
    <div class="row">
      <div class="col-main">
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
                  Availability: 
                  <?php if ($row->stock > 0) { ?>
                    <span class="badge badge-success">In Stock</span>
                  <?php } else { ?>
                    <span class="badge badge-danger">Out of Stock</span>
                  <?php } ?>
                </p>
              </div>
            </div>
            <div class="short-description">
              <h4>Product Details</h4>
              <p><?php echo $row->description; ?></p>
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
              <button class="button pro-add-to-cart basket_product" type="button" title="Add to Cart" data-id="<?php echo $row->id; ?>" data-qty="0" data-in_cart="<?php echo $in_cart; ?>" <?php echo $in_cart == 1 ? 'disabled' : ''; ?>><span>Add to Cart</span></button>
              <button class="button pro-add-to-cart view-cart m-l-10" type="button" onClick="location.href='<?php echo base_url('shop/cart'); ?>'"><span>View Cart</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php products_col_slider('Related Products', $related_products); ?>

<?php cart_modal(); ?>