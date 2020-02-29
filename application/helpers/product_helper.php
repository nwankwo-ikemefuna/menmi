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

function products_col_slider($title, $data, $more_url = '') { 
	if (count($data) === 0) return;
	$ci =& get_instance(); 
	?>
	<div class="container section_30">
	  <div class="row">
	    <div class="best-selling-slider col-sm-12">
	      <div class="title_block">
	        <h3 class="products_title"><?php echo $title; ?></h3>
	      </div>
	      <div class="slider-items-products">
	        <div id="best-selling-slider" class="product-flexslider hidden-buttons">
	          <div class="slider-items slider-width-col4">
	            <?php
	            foreach ($data as $xrow) { ?>
					<div class="product-item">
					  <div class="item-inner">
					    <div class="product-thumbnail">
					    	<div class="box-hover">
								<div class="btn-quickview"><a href="<?php echo product_url($xrow['id'], $xrow['name']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
								</div>
								<div class="add-to-links text-center" data-role="add-to-links">
									<a class="action add-to-wishlist clickable wishlist_product" type="button" title="Add to Wishlist" data-id="<?php echo $xrow['id']; ?>" data-in_wishlist="<?php echo $xrow['in_wishlist']; ?>" <?php echo $xrow['in_wishlist'] == 1 ? 'disabled' : ''; ?>></a>
								</div>
							</div>
					      	<a href="<?php echo product_url($xrow['id'], $xrow['name']); ?>" class="product-item-photo"> <img class="product-image-photo" src="<?php echo $xrow['image_file']; ?>" alt="<?php echo $xrow['name']; ?>"></a>
					    </div>
					    <div class="pro-box-info">
					      <div class="item-info">
					        <div class="info-inner">
					          <div class="item-title">
					            <h4> <a title="<?php echo $xrow['name']; ?>" href="<?php echo product_url($xrow['id'], $xrow['name']); ?>"><?php echo $xrow['name']; ?></a></h4>
					          </div>
					          <div class="item-content">
					            <div class="">
					              <i class="fa fa-cube"></i> <?php echo $xrow['category']; ?> 
					              - 
					              <i class="fa fa-tint"></i> <?php echo $xrow['size_short_name']; ?>
					            </div>
					            <div class="">
					              <?php echo print_colors($xrow['color_codes']); ?>
					            </div>
					            <div><?php echo rating_stars($xrow['rating']); ?></div>
					            <div class="item-price">
					              <div class="price-box"> <span class="regular-price"> <span class="price"><?php echo $xrow['amount']; ?></span> </span> </div>
					            </div>
					          </div>
					        </div>
					      </div>
					      <div class="box-hover">
					        <div class="product-item-actions">
					          <div class="pro-actions">
					            <button class="action add-to-cart basket_product" type="button" title="Add to Cart" data-id="<?php echo $xrow['id']; ?>" data-qty="0" data-in_cart="<?php echo $xrow['in_cart']; ?>" <?php echo $xrow['in_cart'] == 1 || $xrow['stock'] < 1 ? 'disabled' : ''; ?>><span>Add to Cart</span></button>
					          </div>
					        </div>
					      </div>
					    </div>
					  </div>
					</div>
					<?php 
				} ?>
	          </div>
	        </div>
	      </div>
	      <div class="m-t-20">
		      <?php if (strlen($more_url)) { ?>
		      	<a class="btn btn_theme_white m-t-10-n" href="<?php echo base_url($more_url); ?>">See More &raquo;</a>
		      	<?php 
		      } ?>
		  </div>
	    </div>
	  </div>
	</div>
	<?php
}

function cart_modal() { 
	$ci =& get_instance(); 
	//modal row options
	modal_header('m_cart_prods', 'My Cart (<span class="cart_prods_total"></span>)');
	?>
	<div class="cart_update_info alert alert-success"></div>
	<div class="mini-cart">
		<div class="table-responsive" id="cart_prods_modal_table">
            <table class="table table-bordered">
              	<tbody id="cart_prods_preview_modal">
                	<!-- Render cart products via ajax -->
              	</tbody>
          	</table>
      	</div>
		<div class="top-subtotal">Subtotal: <span class="price"><?php echo $ci->company_curr; ?><span class="cart_total_price">0.00</span></span></div>
	    <div class="actions">
	      <button class="btn-checkout" type="button" data-dismiss="modal"><span class="continue_shopping">Continue Shopping</span></button>
	      <button class="view-cart cart_actions" type="button" onClick="location.href='<?php echo base_url('shop/cart'); ?>'"><span>View Cart & Checkout</span></button>
	    </div>
	</div>
    <?php
	modal_footer(false); 
}

function cart_table() { ?>
	<div class="order-detail-content">
	  <div class="table-responsive">
	    <table class="table table-bordered cart_summary">
	      <thead>
	        <tr>
	          <th class="cart_product">Product</th>
	          <th>Description</th>
	          <th class="text-center">Unit Price</th>
	          <th class="text-center min-w-100">Quantity</th>
	          <th class="text-center">Total</th> 
	          <th class="action"><i class="fa fa-trash-o text-danger"></i></th>
	        </tr>
	      </thead>
	      <tbody id="cart_prods_table">
	        <!-- Render cart products via ajax -->
	      </tbody>
	      <tfoot>
	        <tr class="first last">
	          <td colspan="50" class="a-right last">
	            <button type="button" title="Continue Shopping" class="button btn-continue" onclick="location.href='<?php echo base_url('shop'); ?>'"><span class="continue_shopping">Start Shopping</span></button>
	            <button type="button" title="Reload Cart" class="button btn-continue m-l-5 reload_cart"><span>Reload Cart</span></button>
	            <button type="button" id="update_cart" title="Update Cart" class="button btn-update cart_actions"><span>Update Cart</span></button>
	            <button type="button" id="empty_cart" title="Clear Cart" class="button btn-empty cart_actions"><span>Clear Cart</span></button>
	          </td>
	        </tr>
	      </tfoot>
	    </table>
	  </div>
	</div>
	<?php
}

function product_order_summary($title = '', $show_name = false) { 
	$ci =& get_instance(); 
	echo strlen($title) ? $title : ''; ?>
	<table class="table table-no-border">
	  <thead>
	    <tr>
	      <th>Subtotal</th>
	      <th>
	      	<span class="pull-right"><?php echo $ci->company_curr; ?><span class="cart_total_price">0.00</span></span>
	      	<?php if ($show_name) { ?>
	      		<input type="hidden" name="total_price">
	      		<?php 
	      	} ?>
	      </th>
	    </tr>
	    <tr>
	      <th>Tax</th>
	      <th><span class="pull-right"><?php echo $ci->company_curr; ?><span class="">0.00</span></span></th>
	    </tr>
	    <tr>
	      <th>Shipping</th>
	      <th><span class="pull-right"><?php echo $ci->company_curr; ?><span class="">0.00</span></span></th>
	    </tr>
	    <tr>
	      <th>Grand Total</th>
	      <th>
	      	<span class="pull-right"><?php echo $ci->company_curr; ?><span class="cart_grand_total_price">0.00</span></span>
	      </th>
	    </tr>
	  </thead>
	</table>
	<?php
}

function payment_cards($title = '') { ?>
	<div class="m-b-10 m-t-10-n">
	    <?php echo strlen($title) ? $title : ''; ?>
	    <img src="<?php echo base_url('assets/common/img/icons/payment/paypal.png'); ?>">
	    <img src="<?php echo base_url('assets/common/img/icons/payment/visa.png'); ?>">
	    <img src="<?php echo base_url('assets/common/img/icons/payment/master_card.png'); ?>">
	    <img src="<?php echo base_url('assets/common/img/icons/payment/verve.png'); ?>">
	 </div>
	 <?php 
}

function order_status_bg($status, $bg) {
	return '<span class="badge badge-pill badge-'.$bg.' text-bold">'.$status.'</span>';
}

function order_item_statuses() {
	return [0 => 'Unprocessed', 1 => 'Processed'];
}