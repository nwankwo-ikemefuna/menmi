<?php 
$sidebar_position = 'right';
require 'application/views/web/layout/shop_sidebar_start.php'; 
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Order Details</h4>
    </div>
    <div class="panel-body">
    	<div class="alert alert-success m-t-10">
			<h4>
				Thank You! <br />
				Your order has been placed successfully. We'll keep you posted on the progress of your order. <br /><br />
				Order Reference ID: <?php echo $this->session->tempdata('order_ref_id'); ?>
			</h4>
		</div>	
    	<div class="row">
			<div class="<?php echo grid_col_b3(12, '', 8); ?>">
				<?php
				//update password. ensure user is not already logged in and checkout email saved in session is not empty
				if ( ! customer_user()) { ?>
					<h4>Final Steps</h4>
					<p>Supply a password for your profile so you can track the status of your order from your dashboard. This will also save you from filling your data at your next purchase.</p>
					<?php
					$redirect_url = base_url('login');
					$attrs = ['id' => 'register_form', 'class' => 'ajax_form material-form', 'data-type' => 'redirect', 'data-redirect' => $redirect_url, 'data-msg' => "Password updated successfully. Redirecting... <p>If you are not automatically redirected, <a href='{$redirect_url}'>click here</a></p>"];
					echo form_open($this->c_controller.'/update_pass_ajax', $attrs);
						xform_group_list('Password', 'password', 'password', '', true);
						xform_group_list('Confirm Password', 'c_password', 'password', '', true);
						xform_notice();
						xform_submit('Create My Account', $attrs['id'], ['class' => 'btn btn-success']);
					echo form_close();
					?>
					<a class="text-primary text-bold" href="<?php echo base_url('login'); ?>">I already have an account, Log Me In</a>
					<br />
					<a class="text-primary text-bold" href="<?php echo base_url('forgot_pass'); ?>">Forgot Password?</a> 
					<?php
				} else { ?>
					<p>Go to your dashboard to view details of this order.</p>
					<a class="btn btn-success" href="<?php echo base_url('user'); ?>">Take Me There</a> 
					<?php
				} ?>
			</div>
		</div>
    </div>
</div>

<?php 
$sidebar_sections = ['featured'];
require 'application/views/web/layout/shop_sidebar_end.php';
products_col_slider('Products In Your Wishlist', $wishlist_products, 'shop?type=wishlist');
products_col_slider('Products You Viewed', $viewed_products, 'shop?type=viewed');
cart_modal();