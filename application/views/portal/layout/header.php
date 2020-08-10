<!DOCTYPE html>
<html lang="en">
<head>

    <?php echo site_meta($page_title); ?>
    
    <!-- Vendors -->
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/portal/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Font Awesome 4.7 -->
    <link href="<?php echo base_url(); ?>vendors/portal/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Datatables BS 4 -->
    <link href="<?php echo base_url(); ?>vendors/portal/datatables_bs4/datatables.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo base_url(); ?>vendors/portal/datatables_bs4/config.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- jQuery File Upload -->
    <link href="<?php echo base_url(); ?>vendors/portal/jquery-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Selectpicker -->
    <link href="<?php echo base_url(); ?>vendors/portal/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" media="all"/>

    <!-- Template styles -->
    <link href="<?php echo base_url(); ?>assets/portal/template/css/main.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/portal/template/css/color-settings.css" rel="stylesheet" type="text/css" media="all" data-role="color-settings"/>
    <link href="<?php echo base_url(); ?>assets/portal/template/css/dashboard.css" rel="stylesheet" type="text/css" media="all"/>

    <!-- Custom styles -->
    <link href="<?php echo base_url(); ?>assets/common/css/helper.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/portal/custom/css/style.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body class="nav-md theme-green">
    <div class="main-container">

        <?php //var_dump($this->session->user_photo); die; ?>

        <!-- sidebar -->
        <div class="sidebar">
            <div class="scroll-wrapper">
                <div class="navbar nav-title">
                    <a class="site-title navbar-brand site-logo" title="<?php echo site_name(); ?>" href="<?php echo base_url(); ?>"><img alt="<?php echo site_name(); ?> logo" src="<?php echo site_logo('portal'); ?>"></a> 
                    <a href="<?php echo base_url(); ?>" class="text-white hide">
                        <h5><?php echo site_name('short_name'); ?></h5>
                    </a>
                        
                </div>
                <div class="nav toggle">
                    <a href="javascript:void(0)" id="sidebar-menu-toggle" class="btn btn-circle ripple">
                       <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile-pic">
                        <?php ajax_page_link('user/profile', '<img src="'.user_avatar().'" alt="Profile picture" class="rounded-circle profile-img">'); ?>
                    </div>
                    <div class="profile-info">
                        <h2><?php ajax_page_link('user/profile', $this->session->user_first_name); ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
        
                <!-- search -->
                <div class="search-wrap d-sm-none clearfix text-center">
                    <form autocomplete="on">
                        <input class="search" name="search" type="text" placeholder="What are you looking for?">
                        <div>
                            <button class="search-submit" value="Rechercher" type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
                <!-- /search -->
        
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main-menu-wrapper">
                    <div class="menu-section">
                        <ul class="nav side-menu flex-column">

                            <?php 
                            //general menus upper
                            sidebar_menu('Dashboard', 'user', 'dashboard'); 
                            sidebar_menu('Visit Shop', 'shop', 'shopping-basket', '', '_blank', false); 

                            $order_menus = [
                                'Pending' => 'orders?status='.ST_ORDER_PENDING,
                                'Received' => 'orders?status='.ST_ORDER_RECEIVED,
                                'Cancelled' => 'orders?status='.ST_ORDER_CANCELLED,'Processed' => 'orders?status='.ST_ORDER_PROCESSED,
                                'In Transit' => 'orders?status='.ST_ORDER_TRANSIT,
                                'In Transit' => 'orders?status='.ST_ORDER_TRANSIT,
                                'Delivered' => 'orders?status='.ST_ORDER_DELIVERED,
                                'Completed' => 'orders?status='.ST_ORDER_COMPLETED,
                                'All' => 'orders',
                            ];


                            //Customer menus
                            if (customer_user()) {

                                sidebar_menu_parent('My Orders', $order_menus, 'indent');

                                sidebar_menu_parent('My History', 
                                    [
                                        'My Cart' => ['url' => 'shop/cart', 'ajax' => false], 
                                        'My Wishlist' => ['url' => 'shop?type=wishlist', 'ajax' => false],
                                        'Viewed Items' => ['url' => 'shop?type=viewed', 'ajax' => false]
                                    ], 
                                'shopping-cart');
                            }


                            //company menus
                            if (company_user()) {

                                sidebar_menu_parent_auth(M_SETTINGS, VIEW, ADMIN, 'Settings', 
                                    [
                                        'Company Profile' => 'settings', 
                                        // 'Site Settings' => 'settings/site'
                                    ], 
                                'wrench');

                                sidebar_menu_parent_auth(M_PRODUCTS, VIEW, COMPANY_USERS, 'Products', 
                                    [
                                        'Products' => 'products', 
                                        'Categories' => 'products/cats', 
                                        'Sizes' => 'products/sizes', 
                                        'Tags' => 'products/tags'
                                    ], 
                                'table');

                                sidebar_menu_parent_auth(M_ORDERS, VIEW, COMPANY_USERS, 'Orders', $order_menus, 'indent');
                                $slider_menus = [];
                                foreach ($this->session->SLIDER_CATS as $id => $name) {
                                    $slider_menus[$name] = 'sliders?cat_id='.$id;
                                }
                                $slider_menus['All'] = 'sliders';
                                sidebar_menu_parent_auth(M_SLIDERS, VIEW, COMPANY_USERS, 'Sliders & Banners', $slider_menus, 'image');

                                sidebar_menu('Contact Mesages', 'messages', 'envelope'); 

                                sidebar_menu('Newsletter Subscribers', 'subscribers', 'envelope-o');
                            }
                            
                            //general menus lower
                            sidebar_menu_parent('My Account', 
                                [
                                    // 'My Profile' => 'user/profile', 
                                    'Change Password' => 'user/reset_pass',
                                    'Logout' => 'logout'
                                ], 
                            'key'); 
                            ?>
                            
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
            <div class="sidebar-triangle-wrapper">
                <div class="sidebar-graphic-section">
                    <div class="triangle-1"></div>
                    <div class="triangle-2"></div>
                </div>
            </div>
        </div>
        <!-- /sidebar -->

        <div class="content-wrapper">

            <!-- header content  -->
            <header class="header">
                <nav class="header-menu">
                    <div class="nav toggle">
                        <a href="javascript:void(0)" id="menu-toggle" class="ripple">
                            <span class="bars"></span>
                        </a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="search-wrap d-sm-none d-md-block">
                            <form autocomplete="on">
                                <input type="text" name="search" class="search" placeholder="What are you looking for?">
                                <div>
                                    <button class="search-submit" value="" type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </li>
                        <li class="profile-dropdown dropdown">
                            <a href="javascript:void(0)" class="user-profile dropdown-toggle ripple" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo user_avatar(); ?>" alt="Profile picture" class="rounded-circle">
                                <span class="d-none d-sm-block"><?php echo $this->session->user_first_name; ?></span>
                                <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu float-right">
                                <li class="d-none d-block-xs p-0">
                                    <button type="button" class="close btn btn-circle"><i class="fa fa-close"></i></button>
                                    <div class="profile clearfix">
                                        <div class="profile-pic">
                                            <img src="<?php echo user_avatar(); ?>" alt="Profile picture" class="rounded-circle profile-img">
                                        </div>
                                        <div class="profile-info">
                                            <h2><?php echo $this->session->user_first_name; ?></h2>
                                        </div>
                                    </div>
                                </li>
                                <li><?php ajax_page_link('user/profile', '<i class="fa fa-user-o" aria-hidden="true"></i>Profile'); ?></li>
                                <li class="divider"></li>
                                <li><?php ajax_page_link('user/reset_pass', '<i class="fa fa-key" aria-hidden="true"></i>Change Password'); ?></li>
                                 <li class="divider"></li>
                                <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>
            <!-- /header content -->
            
            <div class="company_name pull-right">
                <?php ajax_page_link('user', $this->session->user_group_title); ?> | 
                <a href="<?php echo base_url(); ?>" target="_blank"><?php echo site_name(); ?></a>
            </div>

            <div id="ajax_page_container">