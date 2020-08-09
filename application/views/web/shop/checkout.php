<?php 
$sidebar_position = 'right';
require 'application/views/web/layout/shop_sidebar_start.php'; 

//row details
$attrs = ['id' => 'checkout_form'];
echo form_open($this->c_controller.'/checkout_ajax', $attrs);
?>
	<div class="panel-group" id="accordion">

	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a data-toggle="collapse" data-parent="#accordion" href="#accord_cart"><i class="fa fa-shopping-cart"></i> My Cart</a>
	            </h4>
	        </div>
	        <div id="accord_cart" class="panel-collapse collapse in">
	            <div class="panel-body">
	            	<h4>Review items in your cart before check out.</h4>
	                <?php cart_table(); ?>
	            </div>
	        </div>
	    </div>

	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a data-toggle="collapse" data-parent="#accordion" href="#accord_billing"><i class="fa fa-money"></i> Billing Address</a>
	            </h4>
	        </div>
	        <div id="accord_billing" class="panel-collapse collapse">
	            <div class="panel-body">	
	            	<h4>Tell us where to send your invoice.</h4>
					<?php if ( ! customer_user()) { ?>
						<div class="alert alert-info m-t-10">If you have an account with us or have made a purchase in the past, type your email and click the <i class="fa fa-search"></i> button to retrieve your profile data and populate into the form below to save you time.</div>
						<?php 
						xform_notice('', 'profile_msg');
					} ?>
					<div class="row">
						<div class="<?php echo grid_col_b3(12, '', 6); ?>">
							<?php
							//attempt to retrieve profile if user is not loggedin
							if (customer_user()) { 
								xform_group_list('Email', 'email', 'email', adit_value($row, 'email'));
							} else { ?>
								<label class="form-control-label" style="padding-top: 10px">Email:<span class="text-danger">*</span></label>
								<div class="input-group">
									<input type="email" name="email" class="form-control">
									<span class="input-group-btn"><button type="button" id="fetch_profile" class="btn btn-primary" title="Fetch my profile"><i class="fa fa-search"></i></button></span>
								</div>
								<?php 
							}  
							xform_group_list('First Name', 'first_name', 'text', adit_value($row, 'first_name'));
							xform_group_list('Last Name', 'last_name', 'text', adit_value($row, 'last_name'));
							xform_group_list('Phone No.', 'phone', 'number', adit_value($row, 'phone'));
							?>
						</div>
						<div class="<?php echo grid_col_b3(12, '', 6); ?>">
							<?php
							xform_group_list('Apartment No.', 'apartment', 'text', adit_value($row, 'apartment'));
							xform_group_list('State', 'state', 'select', adit_value($row, 'state'), false, 
								['options' => $states, 'text_col' => 'name']
							);
							xform_group_list('Address', 'address', 'textarea', adit_value($row, 'address'), false, ['rows' => 4]);

							?>
						</div>
					</div>
	            </div>
	        </div>
	    </div>

	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a data-toggle="collapse" data-parent="#accordion" href="#accord_shipping"><i class="fa fa-paper-plane"></i> Shipping Address</a>
	            </h4>
	        </div>
	        <div id="accord_shipping" class="panel-collapse collapse">
	            <div class="panel-body">	
	            	<h4>Tell us where to deliver your items.</h4>
					<?php 
					echo xform_check('Same as Billing Address', 'ship_is_bill', 'checkbox', 'ship_is_bill', 1);
					?>
	            	<div id="shipping_address">
						<div class="row">
							<div class="<?php echo grid_col_b3(12, '', 6); ?>">
								<?php 
								xform_group_list('Email', 'ship_email', 'email', adit_value($row, 'ship_email'));
								xform_group_list('First Name', 'ship_first_name', 'text', adit_value($row, 'ship_first_name'));
								xform_group_list('Last Name', 'ship_last_name', 'text', adit_value($row, 'ship_last_name'));
								xform_group_list('Phone No.', 'ship_phone', 'number', adit_value($row, 'ship_phone'));
								?>
							</div>
							<div class="<?php echo grid_col_b3(12, '', 6); ?>">
								<?php
								xform_group_list('Apartment No.', 'ship_apartment', 'text', adit_value($row, 'ship_apartment'));
								xform_group_list('State', 'ship_state', 'select', adit_value($row, 'ship_state'), false, 
									['options' => $states, 'text_col' => 'name']
								);
								xform_group_list('Address', 'ship_address', 'textarea', adit_value($row, 'ship_address'), false, ['rows' => 4]);
								?>
							</div>
						</div>
					</div>
	            </div>
	        </div>
	    </div>

	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a data-toggle="collapse" data-parent="#accordion" href="#accord_extra"><i class="fa fa-pencil-square-o"></i> Additional Info</a>
	            </h4>
	        </div>
	        <div id="accord_extra" class="panel-collapse collapse">
	            <div class="panel-body">	
	            	<div class="row">
						<div class="<?php echo grid_col_b3(12); ?>">
							<?php
							xform_group_list('Is there anything else you\'d like us to know?', 'ship_extra', 'textarea', adit_value($row, 'ship_extra'), false, ['rows' => 6]);
							?>
						</div>
					</div>
	            </div>
	        </div>
	    </div>

	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a data-toggle="collapse" data-parent="#accordion" href="#accord_order"><i class="fa fa-check-square-o"></i> Complete Order</a>
	            </h4>
	        </div>
	        <div id="accord_order" class="panel-collapse collapse">
	            <div class="panel-body">	
	            	<div class="row">
						<div class="<?php echo grid_col_b3(12, '', 6); ?>">
							<?php
							$payment_method = $row->payment_method ?? ST_PAYMENT_ONLINE;
							xform_check('Online', 'payment_method', 'radio', 'pm_online', ST_PAYMENT_ONLINE, ($payment_method == ST_PAYMENT_ONLINE));
							if (strlen($this->session->company_bank_info)) {
								xform_check('Offline', 'payment_method', 'radio', 'pm_offline', ST_PAYMENT_OFFLINE, ($payment_method == ST_PAYMENT_OFFLINE));
							} ?>
							<div class="m-t-10">
								<div id="payment_online">
									<h5>Complete your order using our secure payment channels.</h5>
		            				<p class="m-b-10">We will not save your credit card details.</p>
		              				<?php payment_cards(); ?>
								</div>
								<?php if (strlen($this->session->company_bank_info)) { ?>
									<div id="payment_offline">
										<h5>Make a payment to our bank account provided below</h5>
										<hr />
			            				<?php echo $this->session->company_bank_info; ?>
			            				<hr />
			            				<p class="m-b-10">Please note that your order will only be processed after we receive confirmation of payment.</p>
									</div>
									<?php 
								} ?>
							</div>
						</div>
						<div class="<?php echo grid_col_b3(12, '', 6); ?>">
							<div class="panel panel-success">
						        <div class="panel-heading">
						            <h4 class="panel-title">Order Summary</h4>
						        </div>
						        <div class="panel-body">
									<?php product_order_summary('', true); ?>
								</div>
							</div>
						</div>
					</div>
	            </div>
	            <div class="panel-footer">
	            	<?php xform_notice(); ?>
	            	<?php xform_input('currency_key', 'hidden', 'NGN'); ?>
	            	<button type="submit" class="btn btn-success btn-lg">SUBMIT  ORDER</button>
	            </div>
	        </div>
	    </div>

	</div>
<?php echo form_close(); ?>

<?php 
$sidebar_sections = ['order_summary', 'featured'];
require 'application/views/web/layout/shop_sidebar_end.php';
products_col_slider('Products In Your Wishlist', $wishlist_products, 'shop?type=wishlist');
products_col_slider('Products You Viewed', $viewed_products, 'shop?type=viewed');
cart_modal();
?>

<script>
	var payment_methods = {online: <?php echo ST_PAYMENT_ONLINE; ?>, offline: <?php echo ST_PAYMENT_OFFLINE; ?>};
</script>
<script src="https://js.paystack.co/v1/inline.js"></script>