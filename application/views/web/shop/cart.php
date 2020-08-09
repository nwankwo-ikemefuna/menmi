
<section class="main-container col1-layout">
  <div class="main container">
    <div class="col-main">
      <div class="cart">
        <?php cart_table(); ?>
        <div class="totals col-sm-4">
          <h3>Shopping Cart Total</h3>
          <div class="inner">
            <?php product_order_summary(); ?>
            <ul class="checkout">
              <li>
                <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout cart_actions" onClick="location.href='<?php echo base_url('shop/checkout'); ?>'"><span>Proceed to Checkout</span></button>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php products_col_slider('Products You Viewed', $viewed_products, 'shop?type=viewed');
products_col_slider('Products In Your Wishlist', $wishlist_products, 'shop?type=wishlist');
cart_modal();
