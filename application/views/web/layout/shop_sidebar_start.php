<!-- Main Container -->
<?php 
//is custom position set?
$position = $sidebar_position ?? $this->session->company_shop_sidebar_position;
// var_dump($sidebar_position); die;
$position_col = $position == 'left' ? 'col-sm-push-3' : ''; ?>
<div class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="col-main col-sm-9 col-xs-12 <?php echo $position_col; ?>">

        <?php
        //flash messages
        flash_message('info_msg', 'info');
        flash_message('success_msg', 'success');
        flash_message('error_msg', 'danger'); 

      	if ( ! isset($hide_title)) { ?> 
      		<div class="page-title">
      			<h2>
      				<?php echo $page_title;
      				if (xget('type') == 'wishlist') { ?>
						<button type="button" id="empty_wishlist" class="btn btn-danger btn-sm" title="Empty wishlist" onclick="location.href='<?php echo base_url('shop/empty_wishlist'); ?>'"><i class="fa fa-trash"></i></button>
						<?php
      				} ?> 
      			</h2>
      		</div>
        	<?php
        } ?>