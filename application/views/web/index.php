
<!-- Main Slider Area -->
<div class="main-slider-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-xs-12"> 
        <!-- Main Slider -->
        <div class="main-slider">
          <div id='rev_slider_6_wrapper' class='rev_slider_wrapper fullwidthbanner-container' >
            <div id='rev_slider_6' class='rev_slider fullwidthabanner'>
              <ul>
                <?php
                if (count($sliders) > 0) {
                  foreach ($sliders as $row) {
                    # code...

                    $ex = preg_split('/[\s,\.]+/', $row->name, 3);
                    $text_upper = (isset($ex[0]) ? $ex[0].' ' : '') . (isset($ex[1]) ? $ex[1] : '');
                    $text_lower = isset($ex[2]) ? $ex[2] : '';
                    ?>
    
                    <li data-transition='slideup' data-slotamount='7' data-masterspeed='1000' data-thumb=''><img src='<?php echo $row->image_file; ?>' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' alt="banner"/>
                    <div class="caption-inner">
                      <div class='tp-caption LargeTitle sft  tp-resizeme' data-x='85'  data-y='145'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'><?php echo $row->tag; ?> </div>
                      <div class='tp-caption ExtraLargeTitle sft  tp-resizeme' data-x='82'  data-y='200'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><?php echo $text_upper; ?> </div>
                      <div class='tp-caption ExtraLargeTitle jtv-text sft  tp-resizeme' data-x='85'  data-y='258'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><?php echo $text_lower; ?></div>
                      <div class='tp-caption decs sft  tp-resizeme' data-x='105'  data-y='305'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><?php echo $row->message; ?></div>
                      <div class='tp-caption sfb  tp-resizeme ' data-x='105'  data-y='375'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'>
                        <a href="<?php echo $row->url; ?>" class="shop-now-btn"><?php echo $row->btn_text; ?></a>
                      </div>
                    </div>
                  </li>
                  <?php
                }
              } ?>
              </ul>
              <div class="tp-bannertimer"></div>
            </div>
          </div>
        </div>
        <!-- End Main Slider --> 
      </div>
    </div>
  </div>
</div>


<!-- End Main Slider Area --> 
<div class="container"> 
  <!-- service section -->
  <div class="jtv-service-area">
    <div class="row">
      <?php
      $niggas = [
        [
          'icon' => 'icon-rocket', 
          'text' => 'free shipping & return', 
          'msg' => 'Lorem ipsum dolor sit amet, consectetur adipis elit'
        ],
        [
          'icon' => 'fa fa-dollar', 
          'text' => 'money back guarantee', 
          'msg' => 'Lorem ipsum dolor sit amet, consectetur adipis elit'
        ],
        [
          'icon' => 'fa fa-headphones', 
          'text' => 'online support 24/7', 
          'msg' => 'consectetur adipis elit. Lorem ipsum dolor sit amet'
        ]
      ];
      foreach ($niggas as $value) { ?>
        <div class="col col-md-4 col-sm-4 col-xs-12 no-padding">
          <div class="block-wrapper ship">
            <div class="text-des"> <i class="<?php echo $value['icon']; ?>"></i>
              <h3><?php echo strtoupper($value['text']); ?></h3>
              <p><?php echo $value['msg']; ?></p>
            </div>
          </div>
        </div>
        <?php 
      } ?>
    </div>
  </div>
</div>

<!-- Featured -->
<div class="container">
  <div class="row">
    <div class="best-selling-slider col-sm-12">
      <div class="title_block">
        <h3 class="products_title">Featured Products</h3>
      </div>
      <div class="slider-items-products">
        <div id="best-selling-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4">
            <?php
            if (count($featured_products) > 0) {
              foreach ($featured_products as $row) { ?>
                <div class="product-item">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <a href="<?php echo product_url($row->id, $row->name); ?>" class="product-item-photo"> <img class="product-image-photo" src="<?php echo $row->image_file; ?>" alt="<?php echo $row->name; ?>"></a>
                    </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="<?php echo $row->name; ?>" href="<?php echo product_url($row->id, $row->name); ?>"><?php echo $row->name; ?></a></h4>
                          </div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price"><?php echo $row->amount; ?></span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='<?php echo product_url($row->id, $row->name); ?>'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
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
  
<!-- Categories -->
<div class="container m-t-50">
  <div class="row">

    <!-- main container -->
    <div class="home-tab">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12"> 
            <!-- Home Tabs  -->
            
            <div class="tab-info">
              <h3 class="new-product-title pull-left">Products category</h3>
              <ul class="nav home-nav-tabs home-product-tabs">
                <?php
                $j = 1;
                if (count($product_cats) > 0) {
                  foreach ($product_cats as $row) { ?>
                    <li>
                      <a class="prod_cat clickable" data-id="<?php echo $row->id; ?>" aria-expanded="false"><?php echo $row->name; ?></a>
                    </li>
                    <?php 
                  } 
                } ?>  
              <!-- /.nav-tabs --> 
            </div>
            <div id="productTabContent" class="tab-content">
              <div class="tab-pane in active">
                <div id="catprods"></div>
              </div>  
            </div>
          </div>
          
        </div>
      </div>
      
      <!-- Latest news start -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title_block">
              <h3 class="products_title">Latest Post</h3>
            </div>
          </div>
          <div class="latest-post">
            <article class="jtv-entry col-md-4 col-xs-12">
              <div class="jtv-post-inner">
                <div class="feature-post images-hover"> <a href="single_post.html"><img src="<?php echo base_url(); ?>assets/web/template/images/blog-img1.jpg" alt="image"></a>
                  <div class="overlay"></div>
                </div>
                <div class="jtv-content-post">
                  <h4 class="title-post"> <a href="single_post.html">Donec massa pellentesque placerat</a> </h4>
                  <ul class="meta-post">
                    <li class="day"> <a href="#">May 05, 2017 /</a> </li>
                    <li class="author"> <a href="#">Admin /</a> </li>
                    <li class="travel"> <a href="#">Men</a> </li>
                  </ul>
                  <div class="jtv-entry-post excerpt">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nisi sapien, accumsan ut molestie a, laoreet.</p>
                  </div>
                  <div class="read-more"><a href="single_post.html"><i class="fa fa-caret-right"></i> Read More</a></div>
                </div>
              </div>
            </article>
            <article class="jtv-entry col-md-4 col-xs-12">
              <div class="jtv-post-inner">
                <div class="feature-post images-hover"> <a href="single_post.html"><img src="<?php echo base_url(); ?>assets/web/template/images/blog-img2.jpg" alt="image"></a>
                  <div class="overlay"></div>
                </div>
                <div class="jtv-content-post">
                  <h4 class="title-post"> <a href="single_post.html">Cras pretium arcu ex hendrerit arcu sit </a> </h4>
                  <ul class="meta-post">
                    <li class="day"> <a href="#">Jan 13, 2017 /</a> </li>
                    <li class="author"> <a href="#">Admin /</a> </li>
                    <li class="travel"> <a href="#">Headphone</a> </li>
                  </ul>
                  <div class="jtv-entry-post excerpt">
                    <p>Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores aut find fault. </p>
                  </div>
                  <div class="read-more"><a href="single_post.html"><i class="fa fa-caret-right"></i> Read More</a></div>
                </div>
              </div>
            </article>
            <article class="jtv-entry col-md-4 col-xs-12">
              <div class="jtv-post-inner">
                <div class="feature-post images-hover"> <a href="single_post.html"><img src="<?php echo base_url(); ?>assets/web/template/images/blog-img3.jpg" alt="image"></a>
                  <div class="overlay"></div>
                </div>
                <div class="jtv-content-post">
                  <h4 class="title-post"> <a href="single_post.html"> Mollis ligula in, finibus tortor</a> </h4>
                  <ul class="meta-post">
                    <li class="day"> <a href="#">Apr 12, 2017 /</a> </li>
                    <li class="author"> <a href="#">Admin /</a> </li>
                    <li class="travel"> <a href="#">Fashion</a> </li>
                  </ul>
                  <div class="jtv-entry-post excerpt">
                    <p>Praesent ornare tortor ac ante egestas hendrerit. Aliquam et metus pharetra, bibendum massa nec. </p>
                  </div>
                  <div class="read-more"><a href="single_post.html"><i class="fa fa-caret-right"></i> Read More</a></div>
                </div>
              </div>
            </article>
          
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- mobile menu -->
<div id="jtv-mobile-menu" class="jtv-mobile-menu">
  <ul>
    <li class=""><a href="index.html">Home</a>
    </li>
    <li><a href="shop_grid.html">Pages</a>
      <ul>
        <li><a href="shop_grid.html" class="">Shop Pages </a>
          <ul>
            <li> <a href="shop_grid.html"> Shop grid </a> </li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Ecommerce Pages </a>
          <ul>
            <li> <a href="wishlist.html"> Wishlists </a> </li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</div>