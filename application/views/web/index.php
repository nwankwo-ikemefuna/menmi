
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
                $sliders = [
                  'tag' => 'Huge Discount', 
                  'text' => 'New Year Splash Deals!', 
                  'msg' => 'Lorem ipsum dolor sit amet, consectetur adipis elit. Nunc imperdiet, nulla.'
                ];
                for ($i = 0; $i < 2; $i++) { 

                  $text = $sliders['text'];
                  $ex = preg_split('/[\s,\.]+/', $text, 3);
                  $text_upper = (isset($ex[0]) ? $ex[0].' ' : '') . (isset($ex[1]) ? $ex[1] : '');
                  $text_lower = isset($ex[2]) ? $ex[2] : '';
                  ?>
  
                  <li data-transition='slideup' data-slotamount='7' data-masterspeed='1000' data-thumb=''><img src='<?php echo base_url(); ?>assets/web/template/images/slider/slider-img<?php echo $i+1; ?>.jpg' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' alt="banner"/>
                  <div class="caption-inner">
                    <div class='tp-caption LargeTitle sft  tp-resizeme' data-x='85'  data-y='145'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'><?php echo $sliders['tag']; ?> </div>
                    <div class='tp-caption ExtraLargeTitle sft  tp-resizeme' data-x='82'  data-y='200'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><?php echo $text_upper; ?> </div>
                    <div class='tp-caption ExtraLargeTitle jtv-text sft  tp-resizeme' data-x='85'  data-y='258'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><?php echo $text_lower; ?></div>
                    <div class='tp-caption decs sft  tp-resizeme' data-x='105'  data-y='305'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><?php echo $sliders['msg']; ?></div>
                    <div class='tp-caption sfb  tp-resizeme ' data-x='105'  data-y='375'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'>
                      <a href="<?php echo base_url('shop'); ?>" class="shop-now-btn">Shop Now </a>
                    </div>
                  </div>
                </li>
                <?php 
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

<div class="container">
  <div class="row">
    <div class="best-selling-slider col-sm-6">
      <div class="title_block">
        <h3 class="products_title">Best selling</h3>
      </div>
      <div class="slider-items-products">
        <div id="best-selling-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4">
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="icon-sale-label sale-left">Sale</div>
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img02.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="icon-sale-label sale-right">Sale</div>
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img08.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box"> <span class="regular-price"> <span class="price">$175.88</span> </span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="icon-new-label new-right">new</div>
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img06.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                        <div class="item-price">
                          <div class="price-box">
                            <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $299.00 </span> </p>
                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $399.00 </span> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img15.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box"> <span class="regular-price"> <span class="price">$125.99</span> </span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img11.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box">
                            <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $188.80 </span> </p>
                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $299.00 </span> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Featured Products -->
    
    <div class="featured-products-slider col-sm-6">
      <div class="title_block">
        <h3 class="products_title">Featured products</h3>
      </div>
      <div class="slider-items-products">
        <div id="featured-products-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col4">
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img16.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img18.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box"> <span class="regular-price"> <span class="price">$175.88</span> </span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="icon-new-label new-right">new</div>
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img09.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                        <div class="item-price">
                          <div class="price-box">
                            <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $299.00 </span> </p>
                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $399.00 </span> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img11.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box"> <span class="regular-price"> <span class="price">$125.99</span> </span> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-item">
              <div class="item-inner">
                <div class="product-thumbnail">
                  <div class="box-hover">
                    <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                    <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                  </div>
                  <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img03.jpg" alt=""></a> </div>
                <div class="pro-box-info">
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title">
                        <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                      </div>
                      <div class="item-content">
                        <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                        <div class="item-price">
                          <div class="price-box">
                            <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $188.80 </span> </p>
                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $299.00 </span> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-hover">
                    <div class="product-item-actions">
                      <div class="pro-actions">
                        <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Offer banner -->
<div class="container">
  <div class="row">
    <div class="offer-add">
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="jtv-banner-box banner-inner">
          <div class="image"> <a class="jtv-banner-opacity" href="#"><img src="<?php echo base_url(); ?>assets/web/template/images/top-banner5.jpg" alt=""></a> </div>
          <div class="jtv-content-text">
            <h3 class="title">Buy 2 items</h3>
            <span class="sub-title">get one for free!</span><a href="#" class="button">Shop now!</a> </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="jtv-banner-box banner-inner">
          <div class="image"> <a class="jtv-banner-opacity" href="#"><img src="<?php echo base_url(); ?>assets/web/template/images/top-banner3.jpg" alt=""></a> </div>
          <div class="jtv-content-text hidden">
            <h3 class="title">New Arrival</h3>
          </div>
        </div>
        <div class="jtv-banner-box banner-inner">
          <div class="image "> <a class="jtv-banner-opacity" href="#"><img src="<?php echo base_url(); ?>assets/web/template/images/top-banner4.jpg" alt=""></a> </div>
          <div class="jtv-content-text">
            <h3 class="title">shoes</h3>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="jtv-banner-box">
          <div class="image"> <a class="jtv-banner-opacity" href="#"><img src="<?php echo base_url(); ?>assets/web/template/images/top-banner2.jpg" alt=""></a> </div>
          <div class="jtv-content-text">
            <h3 class="title">perfect light </h3>
            <span class="sub-title">on brand-new models</span> <a href="#" class="button">Buy Now</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
<!-- Best selling -->
<div class="container">
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
                <li class="active"><a href="#all" data-toggle="tab" aria-expanded="false">All</a></li>
                <li> <a href="#women" data-toggle="tab" aria-expanded="false">Women</a> </li>
                <li> <a href="#men" data-toggle="tab" aria-expanded="false">Men</a> </li>
                <li> <a href="#kids" data-toggle="tab" aria-expanded="false">Kids</a> </li>
              </ul>
              <!-- /.nav-tabs --> 
            </div>
            <div id="productTabContent" class="tab-content">
              <div class="tab-pane active in" id="all">
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-sale-label sale-left">Sale</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img01.jpg" alt=""></a>
                      <div class="jtv-box-timer">
                        <div class="countbox_1 jtv-timer-grid"></div>
                      </div>
                    </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-new-label new-left">new</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <div class="slider-items-products">
                        <div id="pro1-slider" class="product-flexslider hidden-buttons">
                          <div class="slider-items slider-width-col6"> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img10.jpg" alt=""></a> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img16.jpg" alt=""></a> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img17.jpg" alt=""></a> </div>
                        </div>
                      </div>
                    </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $299.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $399.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img04.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.99</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img08.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.99</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img05.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $188.80 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $299.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img09.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.99</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img10.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $188.80 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $299.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img06.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $188.80 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $299.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="women">
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-sale-label sale-left">Sale</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <div class="slider-items-products">
                        <div id="pro2-slider" class="product-flexslider hidden-buttons">
                          <div class="slider-items slider-width-col6"> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img06.jpg" alt=""></a> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img20.jpg" alt=""></a> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img19.jpg" alt=""></a> </div>
                        </div>
                      </div>
                    </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img07.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$175.88</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-new-label new-left">new</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img08.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $299.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $399.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img11.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $188.80 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $299.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="men">
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-sale-label sale-left">Sale</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img11.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img12.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$175.88</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <div class="slider-items-products">
                        <div id="pro3-slider" class="product-flexslider hidden-buttons">
                          <div class="slider-items slider-width-col6"> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img14.jpg" alt=""></a> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img15.jpg" alt=""></a> <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img05.jpg" alt=""></a> </div>
                        </div>
                      </div>
                    </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$275.88</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-new-label new-left">new</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img13.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $299.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $399.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="kids">
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-sale-label sale-left">Sale</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img16.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img17.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$175.88</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="icon-new-label new-left">new</div>
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img18.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $299.00 </span> </p>
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $399.00 </span> </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product-item col-md-3 col-sm-6">
                  <div class="item-inner">
                    <div class="product-thumbnail">
                      <div class="box-hover">
                        <div class="btn-quickview"> <a href="#" data-toggle="modal" data-target="#modal-quickview"><i class="fa fa-search-plus" aria-hidden="true"></i> Quick View</a> </div>
                        <div class="add-to-links" data-role="add-to-links"> <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"></a> <a href="compare.html" class="action add-to-compare" title="Add to Compare"></a> </div>
                      </div>
                      <a href="single_product.html" class="product-item-photo"> <img class="product-image-photo" src="<?php echo base_url(); ?>assets/web/template/images/products/img19.jpg" alt=""></a> </div>
                    <div class="pro-box-info">
                      <div class="item-info">
                        <div class="info-inner">
                          <div class="item-title">
                            <h4> <a title="Product Title Here" href="single_product.html">Product Title Here </a></h4>
                          </div>
                          <div class="item-content">
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"> <span class="price">$125.99</span> </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-hover">
                        <div class="product-item-actions">
                          <div class="pro-actions">
                            <button onclick="location.href='shopping_cart.html'" class="action add-to-cart" type="button" title="Add to Cart"> <span>Add to Cart</span> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- prom banner-->
          <div class="jtv-promotion">
            <div class="container">
              <div class="row">
                <div class="col-md-4 col-sm-5 col-xs-12">
                  <div class="add-banner wow animated fadeInUp animated"> <a href="#"><img src="<?php echo base_url(); ?>assets/web/template/images/home-banner4.jpg" alt="banner"></a> </div>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-12">
                  <div class="wrap">
                    <div class="wow animated fadeInRight animated">
                      <div class="box jtv-custom">
                        <div class="box-content">
                          <div class="promotion-center">
                            <p class="text_medium">Limited Time Only</p>
                            <div class="text_large">
                              <div class="theme-color">45% off</div>
                              Flash Sale</div>
                            <p class="text_small">Fashion for all outerwear, shirt &amp; accessories</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
      
      <!-- Banner block-->
      <div class="container">
        <div class="row">
          <div class="jtv-banner-block">
            <div class="jtv-subbanner1 col-sm-4"><a href="#"><img class="img-respo" alt="jtv-subbanner1" src="<?php echo base_url(); ?>assets/web/template/images/banner3.jpg"></a>
              <div class="text-block">
                <div class="text1 wow animated fadeInUp animated"><a href="#">Favorites</a></div>
                <div class="text2 wow animated fadeInUp animated"><a href="#">Depth in detail </a></div>
                <div class="text3 wow animated fadeInUp animated"><a href="#">Shop for women</a></div>
              </div>
            </div>
            <div class="jtv-subbanner2 col-sm-4"><a href="#"><img class="img-respo" alt="jtv-subbanner2" src="<?php echo base_url(); ?>assets/web/template/images/banner4.jpg"></a>
              <div class="text-block">
                <div class="text1 wow animated fadeInUp animated"><a href="#">Laredo</a></div>
                <div class="text2 wow animated fadeInUp animated"><a href="#">on brand-new models </a></div>
                <div class="text3 wow animated fadeInUp animated"><a href="#">Shop Now</a></div>
              </div>
            </div>
            <div class="jtv-subbanner2 col-sm-4"><a href="#"><img class="img-respo" alt="jtv-subbanner2" src="<?php echo base_url(); ?>assets/web/template/images/banner5.jpg"></a>
              <div class="text-block">
                <div class="text1 wow animated fadeInUp animated"><a href="#">New Arrivals</a></div>
                <div class="text2 wow animated fadeInUp animated"><a href="#">Love These Styles</a></div>
                <div class="text3 wow animated fadeInUp animated"><a href="#">shop for girls</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- our clients Slider -->

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
            <li> <a href="shop_grid_right_sidebar.html"> Shop grid right sidebar</a> </li>
            <li> <a href="shop_list.html"> Shop list </a> </li>
            <li> <a href="shop_list_right_sidebar.html"> Shop list right sidebar</a> </li>
            <li> <a href="shop_grid_full_width.html"> Shop Full width </a> </li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Ecommerce Pages </a>
          <ul>
            <li> <a href="wishlist.html"> Wishlists </a> </li>
            <li> <a href="checkout.html"> Checkout </a> </li>
            <li> <a href="compare.html"> Compare </a> </li>
            <li> <a href="shopping_cart.html"> Shopping cart </a> </li>
          </ul>
        </li>
        <li> <a href="shop_grid.html">Static Pages </a>
          <ul>
            <li> <a href="create_account_page.html"> Create Account Page </a> </li>
            <li> <a href="about_us.html"> About Us </a> </li>
            <li> <a href="contact_us.html"> Contact us </a> </li>
            <li> <a href="404error.html"> Error 404 </a> </li>
            <li> <a href="faq.html"> FAQ </a> </li>
            <li> <a href="register_page.html"> Register Page </a> </li>
          </ul>
        </li>
        <li> <a href="shop_grid.html">Single Product Pages </a>
          <ul>
            <li><a href="single_product.html"> single product </a> </li>
            <li> <a href="single_product_left_sidebar.html"> single product left sidebar</a> </li>
            <li> <a href="single_product_right_sidebar.html"> single product right sidebar</a> </li>
            <li> <a href="single_product_magnific_popup.html"> single product magnific popup</a> </li>
            <li> <a href="cat-4-col.html"> 4 Column Sidebar</a> </li>
          </ul>
        </li>
        <li> <a href="shop_grid.html"> Blog Pages </a>
          <ul>
            <li><a href="blog_right_sidebar.html">Blog – Right sidebar </a></li>
            <li><a href="blog_left_sidebar.html">Blog – Left sidebar </a></li>
            <li><a href="blog_full_width.html">Blog_ - Full width</a></li>
            <li><a href="single_post.html">Single post </a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="shop_grid.html">Women</a>
      <ul class="">
        <li><a href="">Clother</a>
          <ul>
            <li><a href="shop_grid.html">Cocktail</a></li>
            <li><a href="shop_grid.html">Day</a></li>
            <li><a href="shop_grid.html">Evening</a></li>
            <li><a href="shop_grid.html">Sports</a></li>
            <li><a href="shop_grid.html">Sexy Dress</a></li>
            <li><a href="shop_grid.html">Fsshion Skirt</a></li>
            <li><a href="shop_grid.html">Evening Dress</a></li>
            <li><a href="shop_grid.html">Children's Clothing</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Dress and skirt</a>
          <ul>
            <li><a href="shop_grid.html">Sports</a></li>
            <li><a href="shop_grid.html">Run</a></li>
            <li><a href="shop_grid.html">Sandals</a></li>
            <li><a href="shop_grid.html">Books</a></li>
            <li><a href="shop_grid.html">A-line Dress</a></li>
            <li><a href="shop_grid.html">Lacy Looks</a></li>
            <li><a href="shop_grid.html">Shirts-T-Shirts</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">shoes</a>
          <ul>
            <li><a href="shop_grid.html">blazers</a></li>
            <li><a href="shop_grid.html">table</a></li>
            <li><a href="shop_grid.html">coats</a></li>
            <li><a href="shop_grid.html">Sports</a></li>
            <li><a href="shop_grid.html">kids</a></li>
            <li><a href="shop_grid.html">Sweater</a></li>
            <li><a href="shop_grid.html">Coat</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li class=""><a href="shop_grid.html">Men</a>
      <ul class="">
        <li><a href="shop_grid.html">Bages</a>
          <ul>
            <li><a href="shop_grid.html">Bootes Bages</a></li>
            <li><a href="shop_grid.html">Blazers</a></li>
            <li><a href="shop_grid.html">Mermaid</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Clothing</a>
          <ul>
            <li><a href="shop_grid.html">coats</a></li>
            <li><a href="shop_grid.html">T-shirt</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">lingerie</a>
          <ul>
            <li><a href="shop_grid.html">brands</a></li>
            <li><a href="shop_grid.html">furniture</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="shop_grid.html">Handbags</a>
      <ul class="">
        <li><a href="shop_grid.html">Footwear Man</a>
          <ul>
            <li><a href="shop_grid.html">Gold Rigng</a></li>
            <li><a href="shop_grid.html">paltinum Rings</a></li>
            <li><a href="shop_grid.html">Silver Ring</a></li>
            <li><a href="shop_grid.html">Tungsten Ring</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Footwear Womens</a>
          <ul>
            <li><a href="shop_grid.html">Brand Gold</a></li>
            <li><a href="shop_grid.html">paltinum Rings</a></li>
            <li><a href="shop_grid.html">Silver Ring</a></li>
            <li><a href="shop_grid.html">Tungsten Ring</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Band</a>
          <ul>
            <li><a href="shop_grid.html">Platinum Necklaces</a></li>
            <li><a href="shop_grid.html">Gold Ring</a></li>
            <li><a href="shop_grid.html">silver ring</a></li>
            <li><a href="shop_grid.html">Diamond Bracelets</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="shop_grid.html">Shoes</a>
      <ul class="">
        <li><a href="shop_grid.html">Rings</a>
          <ul>
            <li><a href="shop_grid.html">Coats & jackets</a></li>
            <li><a href="shop_grid.html">blazers</a></li>
            <li><a href="shop_grid.html">raincoats</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Dresses</a>
          <ul>
            <li><a href="shop_grid.html">footwear</a></li>
            <li><a href="shop_grid.html">blazers</a></li>
            <li><a href="shop_grid.html">clog sandals</a></li>
            <li><a href="shop_grid.html">combat boots</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Accessories</a>
          <ul>
            <li><a href="shop_grid.html">bootees Bags</a></li>
            <li><a href="shop_grid.html">blazers</a></li>
            <li><a href="shop_grid.html">jackets</a></li>
            <li><a href="shop_grid.html">kids</a></li>
            <li><a href="shop_grid.html">shoes</a></li>
          </ul>
        </li>
        <li><a href="shop_grid.html">Top</a>
          <ul>
            <li><a href="shop_grid.html">briefs</a></li>
            <li><a href="shop_grid.html">camis</a></li>
            <li><a href="shop_grid.html">nigthwear</a></li>
            <li><a href="shop_grid.html">kids</a></li>
            <li><a href="shop_grid.html">shapewer</a></li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</div>

</body>
</html>
