	<!-- Footer -->
	<footer>
	  <div class="container">
	    <div class="row">
	      <div class="footer-newsletter">
	        <div class="container">
	          <div class="row">
	            <div class="col-md-3 col-sm-5">
	              <h3 class="">Sign up for newsletter</h3>
	              <span>Get the latest deals and special offers</span></div>
	            <div class="col-md-5 col-sm-7">
	              <form id="newsletter-validate-detail" method="post" action="#">
	                <div class="newsletter-inner">
	                  <input class="newsletter-email" name='Email' placeholder='Enter Your Email'/>
	                  <button class="button subscribe" type="submit" title="Subscribe">Subscribe</button>
	                </div>
	              </form>
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
	        <div class="footer-logo"><a href="index.html"><img src="<?php echo base_url(); ?>assets/web/template/images/footer-logo.png" alt="fotter logo"></a> </div>
	        <div class="footer-content">
	          <div class="email"> <i class="fa fa-envelope"></i>
	            <p><?php echo $this->session->company_email_1; ?>?></p>
	          </div>
	          <div class="phone"> <i class="fa fa-phone"></i>
	            <p><?php echo $this->session->company_phone_1; ?></p>
	          </div>
	          <div class="address"> <i class="fa fa-map-marker"></i>
	            <p><?php echo $this->session->company_address_hq; ?></p>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
	        <div class="footer-links">
	          <h3 class="links-title">Information<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
	          <div class="tabBlock" id="TabBlock-1">
	            <ul class="list-links list-unstyled">
	              <li><a href="#s">Delivery Information</a></li>
	              <li><a href="#">Discount</a></li>
	              <li><a href="sitemap.html">Sitemap</a></li>
	              <li><a href="#">Privacy Policy</a></li>
	              <li><a href="faq.html">FAQs</a></li>
	              <li><a href="#">Terms &amp; Condition</a></li>
	            </ul>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
	        <div class="footer-links">
	          <h3 class="links-title">Insider<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
	          <div class="tabBlock" id="TabBlock-3">
	            <ul class="list-links list-unstyled">
	              <li> <a href="sitemap.html"> Sites Map </a> </li>
	              <li> <a href="#">News</a> </li>
	              <li> <a href="#">Trends</a> </li>
	              <li> <a href="about_us.html">About Us</a> </li>
	              <li> <a href="contact_us.html">Contact Us</a> </li>
	              <li> <a href="#">My Orders</a> </li>
	            </ul>
	          </div>
	        </div>
	      </div>
	      <div class="col-sm-6 col-md-2 col-xs-12 col-lg-3 collapsed-block">
	        <div class="footer-links">
	          <h3 class="links-title">Service<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
	          <div class="tabBlock" id="TabBlock-4">
	            <ul class="list-links list-unstyled">
	              <li> <a href="account_page.html">Account</a> </li>
	              <li> <a href="wishlist.html">Wishlist</a> </li>
	              <li> <a href="shopping_cart.html">Shopping Cart</a> </li>
	              <li> <a href="#">Return Policy</a> </li>
	              <li> <a href="#">Special</a> </li>
	              <li> <a href="#">Lookbook</a> </li>
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

	<!--Newsletter Popup Start -->
	<div id="myModal" class="modal fade hide">
	  <div class="modal-dialog newsletter-popup">
	    <div class="modal-content">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <div class="modal-body">
	      <div class="left hidden-xs"><img src="<?php echo base_url(); ?>assets/web/template/images/newsletter-bg.png" alt="img"></div>
	      <div class="right">
	        <h2 class="modal-title">Newsletter</h2>
	        <form id="newsletter-form" method="post" action="#">
	          <div class="content-subscribe">
	            <div class="form-subscribe-header">
	              <label>Register now to get updates on discount & coupons</label>
	            </div>
	            <div class="input-box">
	              <input type="text" class="input-text newsletter-subscribe" title="Sign up for our newsletter" name="email" placeholder="Enter your email address">
	            </div>
	            <div class="actions">
	              <button class="button-subscribe" title="Subscribe" type="submit">Subscribe</button>
	            </div>
	          </div>
	        </form>
	        <div class="subscribe-bottom">
	          <input name="notshowpopup" id="notshowpopup" type="checkbox">
	          Don’t show this popup again </div></div>
	      </div>
	    </div>
	  </div>
	</div>
	<!--End of Newsletter Popup-->
</div><!--/#page-->


<!-- Template scripts -->
<!-- jquery js --> 
<script src="<?php echo base_url(); ?>assets/web/template/js/jquery.min.js"></script> 
<!-- Latest compiled and minified JavaScript --> 
<script src="<?php echo base_url(); ?>assets/web/template/js/bootstrap.min.js"></script> 
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

<!-- General Custom scripts -->
<script src="<?php echo base_url(); ?>assets/common/js/utils/ajax.js"></script>

<!-- nivo slider js --> 
<script type='text/javascript'>
  jQuery(document).ready(function(){
    jQuery('#rev_slider_6').show().revolution({
      dottedOverlay: 'none',
      delay: 5000,
      startwidth: 1170,
      startheight: 520,

      hideThumbs: 200,
      thumbWidth: 200,
      thumbHeight: 50,
      thumbAmount: 2,

      navigationType: 'thumb',
      navigationArrows: 'solo',
      navigationStyle: 'round',

      touchenabled: 'on',
      onHoverStop: 'on',
      
      swipe_velocity: 0.7,
      swipe_min_touches: 1,
      swipe_max_touches: 1,
      drag_block_vertical: false,
  
      spinner: 'spinner0',
      keyboardNavigation: 'off',

      navigationHAlign: 'center',
      navigationVAlign: 'bottom',
      navigationHOffset: 0,
      navigationVOffset: 20,

      soloArrowLeftHalign: 'left',
      soloArrowLeftValign: 'center',
      soloArrowLeftHOffset: 20,
      soloArrowLeftVOffset: 0,

      soloArrowRightHalign: 'right',
      soloArrowRightValign: 'center',
      soloArrowRightHOffset: 20,
      soloArrowRightVOffset: 0,

      shadow: 0,
      fullWidth: 'on',
      fullScreen: 'off',

      stopLoop: 'off',
      stopAfterLoops: -1,
      stopAtSlide: -1,

      shuffle: 'off',

      autoHeight: 'off',
      forceFullWidth: 'on',
      fullScreenAlignForce: 'off',
      minFullScreenHeight: 0,
      hideNavDelayOnMobile: 1500,
  
      hideThumbsOnMobile: 'off',
      hideBulletsOnMobile: 'off',
      hideArrowsOnMobile: 'off',
      hideThumbsUnderResolution: 0,

      hideSliderAtLimit: 0,
      hideCaptionAtLimit: 0,
      hideAllCaptionAtLilmit: 0,
      startWithSlide: 0,
      fullScreenOffsetContainer: ''
    });
  });
</script> 
<!-- Hot Deals Timer 1--> 
<script type="text/javascript">
  var dthen1 = new Date("11/25/17 11:59:00 PM");
  start = "08/04/16 03:02:11 AM";
  start_date = Date.parse(start);
  var dnow1 = new Date(start_date);
  if(CountStepper>0)
      ddiff= new Date((dnow1)-(dthen1));
  else
      ddiff = new Date((dthen1)-(dnow1));
  gsecs1 = Math.floor(ddiff.valueOf()/1000);
  
  var iid1 = "countbox_1";
  CountBack_slider(gsecs1,"countbox_1", 1);
</script>

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
    var base_url = "<?php echo base_url(); ?>";
    var c_controller = "<?php echo $this->c_controller; ?>";
</script>

</body>
</html>