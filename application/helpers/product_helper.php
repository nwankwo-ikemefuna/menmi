<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ===== Documentation ===== 
Name: app_helper
Role: Helper
Description: custom general application helper
Author: Nwankwo Ikemefuna
Date Created: 31/12/2019
Date Modified: 31/12/2019
*/ 

function product_url($id, $name) {
    return base_url('shop/view/'.$id.'/'.url_title($name));
}

function products_col_slider($title, $data) { 
	$ci =& get_instance(); 
	?>
	<div class="container">
	  <div class="row">
	    <div class="best-selling-slider col-sm-12">
	      <div class="title_block">
	        <h3 class="products_title"><?php echo $title; ?></h3>
	      </div>
	      <div class="slider-items-products">
	        <div id="best-selling-slider" class="product-flexslider hidden-buttons">
	          <div class="slider-items slider-width-col4">
	            <?php
	            if (count($data) > 0) {
	              foreach ($data as $xrow) { 
	              	//is item in cart?
	              	$cart = $ci->session->tempdata('cart_products') ?? [];
	              	$in_cart = array_key_exists($xrow->id, $cart) ? 1 : 0;
	              	?>
	                <div class="product-item">
	                  <div class="item-inner">
	                    <div class="product-thumbnail">
	                      <a href="<?php echo product_url($xrow->id, $xrow->name); ?>" class="product-item-photo"> <img class="product-image-photo" src="<?php echo $xrow->image_file; ?>" alt="<?php echo $xrow->name; ?>"></a>
	                    </div>
	                    <div class="pro-box-info">
	                      <div class="item-info">
	                        <div class="info-inner">
	                          <div class="item-title">
	                            <h4> <a title="<?php echo $xrow->name; ?>" href="<?php echo product_url($xrow->id, $xrow->name); ?>"><?php echo $xrow->name; ?></a></h4>
	                          </div>
	                          <div class="item-content">
	                            <div class="">
	                              <i class="fa fa-cube"></i> <?php echo $xrow->category; ?> 
	                              - 
	                              <i class="fa fa-tint"></i> <?php echo $xrow->size_short_name; ?>
	                            </div>
	                            <div class="">
	                              <?php echo print_colors($xrow->color_codes); ?>
	                            </div>
	                            <div><?php echo rating_stars($xrow->rating); ?></div>
	                            <div class="item-price">
	                              <div class="price-box"> <span class="regular-price"> <span class="price"><?php echo $xrow->amount; ?></span> </span> </div>
	                            </div>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="box-hover">
	                        <div class="product-item-actions">
	                          <div class="pro-actions">
	                            <button class="action add-to-cart basket_product" type="button" title="Add to Cart" data-id="<?php echo $xrow->id; ?>" data-qty="0" data-in_cart="<?php echo $in_cart; ?>" <?php echo $in_cart == 1 ? 'disabled' : ''; ?>><span>Add to Cart</span></button>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	                <?php 
	              } 
	            } ?>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<?php
}

function cart_modal() { 
	$ci =& get_instance(); 
	//modal row options
	modal_header('m_cart_prods', 'My Cart');
	?>
	<div class="cart_update_info alert alert-success"></div>
	<div class="mini-cart">
		<ul id="cart-sidebar" class="mini-products-list cart_prods">
	      <!-- Render cart products via ajax -->
	    </ul>
	    <div class="top-subtotal">Subtotal: <span class="price"><?php echo $ci->company_curr; ?><span class="cart_total_price">0.00</span></span></div>
	    <div class="actions">
	      <button class="btn-checkout cart_actions" type="button" data-dismiss="modal"><span>Continue Shopping</span></button>
	      <button class="view-cart cart_actions" type="button" onClick="location.href='<?php echo base_url('shop/cart'); ?>'"><span>View Cart</span></button>
	    </div>
	</div>
    <?php
	modal_footer(false); 
}