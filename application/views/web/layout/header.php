<!DOCTYPE html>
<html lang="en">
<head>
    
  <?php echo site_meta($page_title); ?>

  <!-- Plugins styles -->
  <link href="<?php echo base_url(); ?>assets/web/template/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>assets/web/template/css/animate.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url(); ?>vendors/web/datatables_bs3/datatables.min.css" rel="stylesheet" type="text/css" media="all" />
  <!-- Selectpicker -->
  <link href="<?php echo base_url(); ?>vendors/portal/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="<?php echo base_url(); ?>assets/web/template/css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all" />
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
  <link href="<?php echo base_url(); ?>assets/web/custom/css/style.css" rel="stylesheet" type="text/css" media="all" />
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
              <?php
              //general attrs
              $gs_attrs = ['class' => 'ajax_form', 'data-type' => 'redirect', 'data-redirect' => '_dynamic'];
              if ($this->c_controller == 'blog') {
                $gs_action = 'blog/search_ajax';
                $gs_attrs['id'] = 'blog_search_form';
                $gs_name = 'blog_search';
                $gs_placeholder = 'Search blog';
              } else {
                $gs_action = 'shop/search_ajax';
                $gs_attrs['id'] = 'shop_search_form';
                $gs_name = 'shop_search';
                $gs_placeholder = 'Search shop';
              } 
              echo form_open($gs_action, $gs_attrs); ?>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="<?php echo $gs_placeholder; ?>" name="<?php echo $gs_name; ?>" required>
                  <button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                </div>
                <?php
              echo form_close(); ?>
            </div>
            <!-- End Search --> 
          </div>
          <!-- Header Logo -->
          <div class="col-xs-10 col-lg-4 col-md-4 col-sm-4">
            <div class="mm-toggle-wrap hidden-lg hidden-md hidden-sm">
              <div class="mm-toggle"> <i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
            </div>
            <div class="logo"><a title="<?php echo $this->session->company_name; ?>" href="<?php echo base_url(); ?>"><img alt="<?php echo $this->session->company_name; ?>" src="<?php echo $this->session->company_logo_site_file; ?>"></a></div>
          </div>

          <div class="col-lg-4 col-sm-3 col-xs-2 top-cart"> 
            <!-- Begin shopping cart trigger  -->
           <div class="top-cart-contain">
              <div class="mini-cart">
                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
                <div id="shopping-cart-trigger"> <a href="<?php echo base_url('shop/cart'); ?>" class="cart-icon" title="Shopping Cart"> <i class="fa fa-shopping-bag"></i><span class="cart-num cart_prods_total">0</span> </a> </div>
                 </div>
                <div>
                  <div class="top-cart-content">
                    <ul id="cart_prods_preview_mini" class="cart-sidebar mini-products-list">
                      <!-- Render cart products via ajax -->
                    </ul>
                    <div class="top-subtotal">Subtotal: <span class="price"><?php echo $this->company_curr; ?><span class="cart_total_price">0.00</span></span></div>
                    <div class="actions">
                      <button class="view-cart continue_shopping" type="button" onClick="location.href='<?php echo $current_page == 'shop' ? '#shop_section' : base_url('shop'); ?>'" ><span>Continue Shopping</span></button>
                      <button class="btn-checkout cart_actions" type="button" onClick="location.href='<?php echo base_url('shop/checkout'); ?>'"><span>Checkout</span></button>
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
                <?php
                $_layout = 'header';
                require 'nav_menu.php'; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- end header --> 
  
  <?php
  if ($this->show_bcrumbs) { ?>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <ul>
              <li class="home"> <a title="Go Home" href="<?php echo base_url(); ?>">Home</a><span>&raquo;</span></li>
              <?php
              if (count($this->bcrumbs)) { 
                foreach ($this->bcrumbs as $title => $url) { ?>
                  <li> <a href="<?php echo base_url($url); ?>"><?php echo $title; ?></a><span>&raquo;</span></li>
                  <?php
                } 
              } ?>
              <li><strong><?php echo $page_title; ?></strong></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <?php 
  } ?>
  <!-- Breadcrumbs End -->