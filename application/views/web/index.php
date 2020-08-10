
<!-- Main Slider Area -->
<?php
if ($this->session->company_home_slider == 1 && !empty($sliders)) { ?>
  <div class="main-slider-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12"> 
          <div class="category-description">
             <div class="slider-items-products">
                <div id="category-slider" class="product-flexslider hidden-buttons">
                  <div class="slider-items slider-width-col4">
                    <?php
                    foreach ($sliders as $row) { ?>
                      <a href="<?php echo strlen($row->url) ? $row->url : '#!'; ?>"><img src="<?php echo base_url($row->image_file); ?>" alt="<?php echo $row->name; ?>"></a>
                      <?php 
                    } ?>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
} ?>

<!-- End Main Slider Area --> 
<div class="container"> 
  <!-- service section -->
  <div class="jtv-service-area">
    <div class="row">
      <?php
      $stuffs = [
        [
          'icon' => 'icon-rocket', 
          'text' => 'Pay on Delivery', 
          'msg' => 'Make your order and pay when you receive the order.'
        ],
        [
          'icon' => 'fa fa-dollar', 
          'text' => 'Money Back Guarantee', 
          'msg' => 'Request for refund if unsatisfied with order.'
        ],
        [
          'icon' => 'fa fa-headphones', 
          'text' => 'Online Support 24/7', 
          'msg' => '24 hours support, 7 days a week'
        ]
      ];
      foreach ($stuffs as $value) { ?>
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
<?php products_col_slider('Featured Products', $featured_products, 'shop?type=featured'); ?>

<!-- Categories -->
<div class="container section_30">
  <div class="row">

    <!-- main container -->
    <div class="home-tab">

      <div class="container section_30">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12"> 
            <!-- Home Tabs  -->
            <div class="tab-info">
              <h3 class="new-product-title pull-left">Products categories</h3>
              <!-- /.nav-tabs -->
              <ul class="nav home-nav-tabs home-product-tabs">
                <li><a href="<?php echo base_url('shop'); ?>">Browse All &raquo;</a></li>
              </ul> 
            </div>
            <div id="productTabContent" class="tab-content home">
              <div class="tab-pane in active">
                <div class="prod_cat_tab">
                  <?php
                  if (!empty($product_cats)) {
                    foreach ($product_cats as $row) { 
                      if ($row->product_count == 0) continue; ?>
                      <button class="prod_cat btn_theme_white" data-id="<?php echo $row->id; ?>" aria-expanded="false"><?php echo $row->name; ?></button>
                      <?php 
                    } 
                  } ?> 
                </div> 
                <div id="catprods"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row m-b-20">
          <div class="col-xs-12" id="cats_all_link"></div>
        </div>
      </div>
      
      <!-- Latest news start -->
      <div class="container section_30 hide">
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

<?php if (!empty($banners)) { ?>
  <div class="container">
    <div class="row">
      <div class="jtv-banner-block">
        <?php
        foreach ($banners as $row) { ?>
          <div class="jtv-subbanner1 col-sm-4"><a href="<?php echo strlen($row->url) ? $row->url : '#!'; ?>"><img class="img-respo" src="<?php echo base_url($row->image_file); ?>" alt="<?php echo $row->name; ?>"></a>
            <div class="text-block hide">
              <div class="text1 wow animated fadeInUp animated"><a href="#">Favorites</a></div>
              <div class="text2 wow animated fadeInUp animated"><a href="#">Depth in detail </a></div>
              <div class="text3 wow animated fadeInUp animated"><a href="#">Shop for women</a></div>
            </div>
          </div>
          <?php 
        } ?>
      </div>
    </div>
  </div>
  <?php 
} ?>

<!-- Featured -->
<?php products_col_slider('Products You Viewed', $viewed_products, 'shop?type=viewed'); ?>

<?php 
cart_modal();