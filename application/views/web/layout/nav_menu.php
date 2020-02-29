<?php
$class_custom_menu = $_layout == 'header' ? 'custom-menu' : ''; 
?>
<ul class="<?php echo $_layout == 'header' ? 'hidden-xs' : ''; ?>">
  <li class="<?php echo $class_custom_menu; ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
  <li class="<?php echo $class_custom_menu; ?>"><a href="#"><i class="fa fa-cubes"></i> Categories</a>
    <ul class="<?php echo $_layout == 'header' ? 'dropdown' : ''; ?>">
      <?php
      if (count($product_cats) > 0) { 
        foreach ($product_cats as $row) { ?>
          <li><a href="<?php echo base_url('shop?cat_id='.$row->id); ?>"><?php echo $row->name; ?></a>
          <?php
        } 
      } ?>  
    </ul>
  </li>
  <li><a href="<?php echo base_url('shop'); ?>"><i class="fa fa-shopping-basket"></i> Shop</a></li>
  <li class="<?php echo $class_custom_menu; ?>"><a href="#"><i class="fa fa-shopping-cart"></i> Cart</a>
    <ul class="<?php echo $_layout == 'header' ? 'dropdown' : ''; ?>">
      <li><a href="<?php echo base_url('shop/cart'); ?>">My Cart (<?php echo intval(count($this->session->tempdata('cart_products'))); ?>)</a></li>
      <li><a href="<?php echo base_url('shop?type=wishlist'); ?>">My Wishlist (<?php echo intval(count($this->session->tempdata('wishlist_products'))); ?>)</a></li>
      <li><a href="<?php echo base_url('shop?type=viewed'); ?>">Viewed Items (<?php echo intval(count($this->session->tempdata('viewed_products'))); ?>)</a></li>
      <li><a href="<?php echo base_url('shop/checkout'); ?>">Checkout</a></li>
    </ul>
  </li>
  <li><a href="<?php echo base_url('about'); ?>"><i class="fa fa-info"></i> About</a></li>
  <li><a href="<?php echo base_url('contact'); ?>"><i class="fa fa-phone"></i> Contact</a></li>
  <li><a href="<?php echo base_url('blog'); ?>"><i class="fa fa-book"></i> Blog</a></li>
  <?php if (customer_user()) { ?>
    <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <?php } else { ?>
    <li><a href="<?php echo base_url('register'); ?>"><i class="fa fa-sign-up"></i> Register</a></li>
    <li><a href="<?php echo base_url('login'); ?>"><i class="fa fa-sign-in"></i> Login</a></li>
  <?php } ?>
</ul>