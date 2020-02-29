<!-- Footer -->
	<footer class="m-t-50">
	  <div class="container">
	    <div class="row">
	      <div class="footer-newsletter">
	        <div class="container">
	          <div class="row">
	            <div class="col-md-3 col-sm-5">
	              <h3 class="">Sign up for newsletter</h3>
	              <span>Get the latest deals and special offers</span></div>
	            <div class="col-md-5 col-sm-7">
	            	<?php 
	            	$attrs = ['id' => 'newsletter_sub_form', 'class' => 'ajax_form', 'data-type' => 'js_alert', 'data-redirect' => '_void', 'data-msg' => "Thank you for your subscription."];
	            	echo form_open('web/newsletter_sub_ajax', $attrs); ?>
		                <div class="newsletter-inner">
		                  <input class="newsletter-email" name="email" placeholder='Enter Your Email' required />
		                  <button class="button subscribe" type="submit" title="Subscribe">Subscribe</button>
		                </div>
		                <?php
	              echo form_close(); ?>
	            </div>
	            <div class="col-md-4 col-sm-12">
	              <div class="social">
	                <ul class="inline-mode">
	                	<?php
	                	//facebook
	                	if (strlen($this->session->company_social_facebook)) { ?>
	                  	<li class="social-network fb"><a title="Connect us on Facebook" target="_blank" href="<?php echo $this->session->company_social_facebook; ?>"><i class="fa fa-facebook"></i></a></li>
	                  	<?php 
	                  } 
	                  //google+
	                  if (strlen($this->session->company_social_googleplus)) { ?>
	                  	<li class="social-network googleplus"><a title="Connect us on Google+" target="_blank" href="<?php echo $this->session->company_social_googleplus; ?>"><i class="fa fa-google-plus"></i></a></li>
	                  	<?php 
	                  } 
	                  //twitter
	                  if (strlen($this->session->company_social_twitter)) { ?>
	                  	<li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="<?php echo $this->session->company_social_twitter; ?>"><i class="fa fa-twitter"></i></a></li>
	                  	<?php 
	                  }
	                  //LinkedIn
	                  if (strlen($this->session->company_social_linkedin)) { ?>
	                  	<li class="social-network linkedin"><a title="Connect us on Linkedin" target="_blank" href="<?php echo $this->session->company_social_linkedin; ?>"><i class="fa fa-linkedin"></i></a></li>
	                  	<?php 
	                  }
	                  //instagram
	                  if (strlen($this->session->company_social_instagram)) { ?>
	                  	<li class="social-network instagram"><a title="Connect us on Instagram" target="_blank" href="<?php echo $this->session->company_social_instagram; ?>"><i class="fa fa-instagram"></i></a></li>
	                  	<?php 
	                  }
	                  //whatsapp
	                  if (strlen($this->session->company_social_whatsapp)) { ?>
	                  	<li class="social-network instagram"><a title="Connect us on Instagram" target="_blank" href="<?php echo $this->session->company_social_whatsapp; ?>"><i class="fa fa-instagram"></i></a></li>
	                  	<?php 
	                  } ?>
	                </ul>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-4 col-xs-12 col-lg-3">
	        <div class="footer-content">
	          <h3 class="links-title">Our Contact</h3>
	          <div class="email"> <i class="fa fa-envelope"></i>
	            <p><?php echo $this->session->company_email_1; ?></p>
	          </div>
	          <div class="phone"> <i class="fa fa-phone"></i>
	            <p><?php echo $this->session->company_phone_1; ?></p>
	          </div>
	          <div class="address"> <i class="fa fa-map-marker"></i>
	            <p><?php echo $this->session->company_address_1; ?></p>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
	        <div class="footer-links">
	          <h3 class="links-title">Shopping<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
	          <div class="tabBlock" id="TabBlock-1">
	            <ul class="list-links list-unstyled">
	              	<li><a href="<?php echo base_url('shop'); ?>">Shop</a></li>
	              	<li><a href="<?php echo base_url('shop/cart'); ?>">My Cart (<?php echo intval(count($this->session->tempdata('cart_products'))); ?>)</a></li>
	              	<li><a href="<?php echo base_url('shop?type=wishlist'); ?>">My Wishlist (<?php echo intval(count($this->session->tempdata('wishlist_products'))); ?>)</a></li>
      				<li><a href="<?php echo base_url('shop?type=viewed'); ?>">Viewed Items (<?php echo intval(count($this->session->tempdata('viewed_products'))); ?>)</a></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
	        <div class="footer-links">
	          <h3 class="links-title">Site Map<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
	          <div class="tabBlock" id="TabBlock-3">
	            <ul class="list-links list-unstyled">
	              <li><a href="<?php echo base_url(); ?>">Home</a> </li>
	              <li><a href="<?php echo base_url('blog'); ?>">Blog</a></li>
	              <li><a href="<?php echo base_url('about'); ?>">About</a></li>
	              <li><a href="<?php echo base_url('contact'); ?>">Contact</a></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-2 col-xs-12 col-lg-3 collapsed-block">
	        <div class="footer-links">
	          <h3 class="links-title">Account<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
	          <div class="tabBlock" id="TabBlock-4">
	            <ul class="list-links list-unstyled">
	            	<?php if (customer_user()) { ?>
	              		<li><a href="<?php echo base_url('user'); ?>">My Dashboard</a></li>
	              	<?php } else { ?>
	              		<li><a href="<?php echo base_url('register'); ?>">Register</a></li>
	              		<li><a href="<?php echo base_url('login'); ?>">Login</a></li>
	              	<?php } ?>
	              	<li><a href="<?php echo base_url('shop/checkout'); ?>">Checkout</a></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	  <div class="footer-coppyright">
	    <div class="container">
	      <div class="row">
	        <div class="col-sm-6 col-xs-12 coppyright"> Copyright © <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>"> <?php echo $this->site_name; ?> </a>. All Rights Reserved. </div>
	        <div class="col-sm-6 col-xs-12">
	          <div class="payment">
	            Powered by <a href="<?php echo $this->author_linkedin; ?>" target="_blank"><?php echo $this->site_author; ?></a>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</footer>
	<a href="#" id="back-to-top" title="Back to top"><i class="fa fa-angle-up"></i></a> 
	<!-- End Footer -->

</div><!--/#page-->


<!-- mobile menu -->
<div id="jtv-mobile-menu" class="jtv-mobile-menu">
	<?php
    $_layout = 'footer';
    require 'nav_menu.php'; ?>
</div>

<?php
//the guy that spins
ajax_status_modal(); ?>

<!-- Template scripts -->
<!-- jquery js --> 
<script src="<?php echo base_url(); ?>assets/web/template/js/jquery.min.js"></script> 
<!-- Latest compiled and minified JavaScript --> 
<script src="<?php echo base_url(); ?>assets/web/template/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>vendors/web/datatables_bs3/datatables.min.js"></script> 
<!-- Selectpicker -->
<script src="<?php echo base_url(); ?>vendors/portal/selectpicker/js/bootstrap-select.min.js"></script>
<!-- owl.carousel.min js --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/owl.carousel.min.js"></script> 
<!-- Mean Menu js --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/jquery.meanmenu.min.js"></script> 
<!--jquery-ui.min js --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/jquery-ui.js"></script> 
<!-- countdown js --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/countdown.js"></script> 
<!-- wow JS --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/wow.min.js"></script> 
<!-- revolution slider js --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/revolution-slider.js"></script> 
<!-- mobile menu JS --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/jtv-mobile-menu.js"></script> 
<!-- main js --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/main.js"></script> 
<!-- nivo slider -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/jquery.nivo.slider.js"></script> 
<!-- cloud zoom -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/web/template/js/cloud-zoom.js"></script> 


<!-- General Custom scripts -->
<script src="<?php echo base_url(); ?>assets/common/js/general.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/data_table.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/ajax.js"></script>

<?php
//custom page-specific scripts
if ($this->page_scripts) {
    foreach ($this->page_scripts as $script) { 
        $script_url = base_url().'assets/web/custom/js/'.$script.'.js'; ?>
        <script src="<?php echo $script_url; ?>"></script>
        <?php echo "\r\n";
    } 
} ?>

<script>
    //pass vars to javascript
    var base_url = "<?php echo base_url(); ?>",
    	c_controller = "<?php echo $this->c_controller; ?>",
    	current_page = "<?php echo $current_page; ?>",
    	trashed = 0;
</script>

</body>
</html>