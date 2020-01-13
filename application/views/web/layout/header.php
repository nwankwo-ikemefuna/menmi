<!DOCTYPE html>
<html lang="en">
<head>
    
  <?php echo site_meta($page_title); ?>

  <!-- Plugins styles -->
  <link href="<?php echo base_url(); ?>assets/web/template/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/animate.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/simple-line-icons.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/meanmenu.min.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/owl.carousel.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/owl.transitions.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/nivo-slider.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/jtv-mobile-menu.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/blog.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/slick.min.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/responsive.css" rel="stylesheet" type="text/css" media="all" />

  <!-- Custom styles -->
  <link href="<?php echo base_url(); ?>assets/common/css/helper.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body class="cms-index-index cms-home-page">

<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="page"> 
  
  <!-- Header -->
  <header id="header">
    <div class="header-container">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-md-4 top-search"> 
            <!-- Search -->
            <div id="search">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" name="search">
                  <button class="btn-search" type="button"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
            
            <!-- End Search --> 
          </div>
          <!-- Header Logo -->
          <div class="col-xs-12 col-lg-4 col-md-4 col-sm-4">
            <div class="mm-toggle-wrap hidden-lg hidden-md hidden-sm">
              <div class="mm-toggle"> <i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
            </div>
            <div class="logo"><a title="e-commerce" href="index.html"><img alt="e-commerce" src="<?php echo base_url(); ?>assets/web/template/images/logo.png"></a> </div>
          </div>
          <div class="col-lg-4 col-sm-4 col-xs-12 top-cart"> 
            <!-- Begin shopping cart trigger  -->
              
           <div class="top-cart-contain">
              <div class="mini-cart">
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
                <div id="shopping-cart-trigger"> <a href="shopping_cart.html" class="cart-icon" title="Shopping Bag"> <i class="fa fa-cart"></i> Cart<span class="cart-num">2</span> </a> </div>
                 </div>
                <div>
                  <div class="top-cart-content">
                    <div class="block-subtitle hidden">Recently added item(s)</div>
                    <ul id="cart-sidebar" class="mini-products-list">
                      <li class="item odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="<?php echo base_url(); ?>assets/web/template/images/products/img07.jpg" alt="Lorem ipsum dolor" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="pe-7s-trash"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Lorem ipsum dolor sit amet Consectetur</a> </p>
                          <strong>1</strong> x <span class="price">$20.00</span> </div>
                      </li>
                      <li class="item even"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="<?php echo base_url(); ?>assets/web/template/images/products/img11.jpg" alt="Lorem ipsum dolor" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="pe-7s-trash"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Consectetur utes anet adipisicing elit</a> </p>
                          <strong>1</strong> x <span class="price">$230.00</span> </div>
                      </li>
                      <li class="item last odd"> <a href="shopping_cart.html" title="Ipsums Dolors Untra" class="product-image"><img src="<?php echo base_url(); ?>assets/web/template/images/products/img10.jpg" alt="Lorem ipsum dolor" width="65"></a>
                        <div class="product-details"> <a href="#" title="Remove This Item" class="remove-cart"><i class="pe-7s-trash"></i></a>
                          <p class="product-name"><a href="shopping_cart.html">Sed do eiusmod tempor incidist</a> </p>
                          <strong>2</strong> x <span class="price">$420.00</span> </div>
                      </li>
                    </ul>
                    <div class="top-subtotal">Subtotal: <span class="price">$520.00</span></div>
                    <div class="actions">
                      <button class="btn-checkout" type="button" onClick="location.href='checkout.html'"><span>Checkout</span></button>
                      <button class="view-cart" type="button" onClick="location.href='shopping_cart.html'"><span>View Cart</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <!-- End shopping cart trigger --> 
             </div>
        </div>
      </div>
    </div>
    <!-- End Header Logo -->
    
    <nav> 
      <!-- Start Menu Area -->
      <div class="menu-area">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="main-menu">
                <ul class="hidden-xs">
                  <li class="active custom-menu"><a href="index.html">Home</a>
                  <li class="custom-menu"><a href="blog.html">Blog</a>
                    <ul class="dropdown">
                      <li> <a href="blog_right_sidebar.html"> Blog &ndash; Right Sidebar </a></li>
                      <li> <a href="blog_left_sidebar.html"> Blog &ndash; Left Sidebar </a></li>
                      <li><a href="blog_full_width.html"> Blog &ndash; Full-Width </a></li>
                      <li><a href="single_post.html"> Single post </a> </li>
                    </ul>
                  </li>
                  <li><a href="contact_us.html">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- end header --> 