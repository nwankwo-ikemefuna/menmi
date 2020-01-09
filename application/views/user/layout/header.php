<!DOCTYPE html>
<html lang="en">
<head>

    <?php echo site_meta($page_title); ?>
    
    <!-- Vendors -->
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Font Awesome 4.7 -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Datatables BS 4 -->
    <link href="<?php echo base_url(); ?>vendors/datatables_bs4/datatables.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo base_url(); ?>vendors/datatables_bs4/config.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Selectpicker -->
    <link href="<?php echo base_url(); ?>vendors/selectpicker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" media="all"/>

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

        <!-- sidebar -->
        <div class="sidebar">
            <div class="scroll-wrapper">
                <div class="navbar nav-title site_title">
                    <a href="<?php echo base_url(); ?>" class="text-white">
                        <h5><?php echo $this->session->company_short_name; ?></h5>
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
                        <img src="<?php echo USER_AVATAR; ?>" alt="Profile picture" class="rounded-circle profile-img">
                    </div>
                    <div class="profile-info">
                        <h2><?php echo $this->session->user_firstname; ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
        
                <!-- search -->
                <div class="search-wrap d-sm-none clearfix text-center">
                    <form autocomplete="on">
                        <input class="search" name="search" type="text" placeholder="What're you looking for?">
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
                            sidebar_menu('Dashboard', 'user', 'dashboard'); 
                            sidebar_menu_parent_auth(M_TEMPLATES, VIEW, null, 'Templates', ['My Templates' => 'templates'], 'table');
                            sidebar_menu('Logout', 'logout', 'sign-out'); 
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
                                <input type="text" name="search" class="search" placeholder="What're we looking for?">
                                <div>
                                    <button class="search-submit" value="" type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </li>
                        <li class="profile-dropdown dropdown">
                            <a href="javascript:void(0)" class="user-profile dropdown-toggle ripple" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo USER_AVATAR; ?>" alt="Profile picture" class="rounded-circle">
                                <span class="d-none d-sm-block"><?php echo $this->session->user_firstname; ?></span>
                                <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu float-right">
                                <li class="d-none d-block-xs p-0">
                                    <button type="button" class="close btn btn-circle"><i class="fa fa-close"></i></button>
                                    <div class="profile clearfix">
                                        <div class="profile-pic">
                                            <img src="<?php echo USER_AVATAR; ?>" alt="Profile picture" class="rounded-circle profile-img">
                                        </div>
                                        <div class="profile-info">
                                            <h2><?php echo $this->session->user_firstname; ?></h2>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-user-o" aria-hidden="true"></i>Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>
            <!-- /header content -->
            
            <div class="company_name pull-right">
                <a href="<?php echo base_url('user'); ?>"><?php echo ucfirst($this->page); ?> | <?php echo $this->session->user_company; ?></a>
            </div>

            <!-- page content -->
            <div class="main-content small-gutter" role="main">
                <div class="row bg-title clearfix page-title">
                    <div class="col-12 col-md-8">
                        <h4 class="page-title">
                            <?php echo $page_title;
                            if ((bool) $this->trashed) {
                                echo '<span class="text-danger"> [Trashed]</span>'; 
                            } ?>
                        </h4>
                    </div>
                    <?php
                    if (strlen($record_count)) {
                        $_affix = $record_count === 1 ? '' : 's'; ?>
                        <div class="col-12 col-md-4">
                            <h4 class="page-title pull-right">
                                <?php
                                echo number_format($record_count) . ' record' . $_affix; ?>
                            </h4>
                        </div>
                        <?php
                    } ?>
                    </h4>
                </div>
                
                <?php 
                //crud buttons not empty?
                if (is_array($this->butts) && count($this->butts) > 0) { ?>
                    <div class="row page_buttons">
                        <div class="col-12">
                            <div class="pull-left">
                                <?php echo page_crud_butts($this->module, null, $this->butts, $crud_rec_id, $record_count); ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                } ?>
                
                <div class="row m-t-15">
                    <div class="col-12 m-b-10">
                        <div class="bg-white padding-25 h-100">
                            <div class="m-t-10">
                                <?php
                                //flash messages
                                flash_message('info_msg', 'info');
                                flash_message('success_msg');
                                flash_message('error_msg', 'danger'); 
                                ?>
                            </div>

                            <?php 
                            //bulk action options
                            if ($this->ba_opts) bulk_action($this->ba_opts, $record_count);