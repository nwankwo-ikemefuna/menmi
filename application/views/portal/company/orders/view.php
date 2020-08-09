<div class="card card-shadowless card-borderless">
    <ul class="nav nav-tabs nav-tabs-linetriangle" id="tabLinetriangleFade" role="tablist">
    	<li class="nav-item">
            <a class="nav-link active" id="order_items-tab" data-toggle="tab" role="tab" href="#order_items" aria-controls="order_items" aria-expanded="true">
                <span>Order Items</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="order_details-tab" data-toggle="tab" role="tab" href="#order_details" aria-controls="order_details" aria-expanded="true">
                <span>Order Details</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="customer-tab" data-toggle="tab" role="tab" href="#customer" aria-controls="customer" aria-expanded="true">
                <span><?php echo company_user() ? 'Customer' : 'My'; ?> Details</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="shipping-tab" data-toggle="tab" role="tab" href="#shipping" aria-controls="shipping" aria-expanded="true">
                <span>Shipping Details</span></a>
        </li>
    </ul>
	<div class="tab-content" id="tabLinetriangleFadeContent">

    	<div role="tabpanel" class="tab-pane fade active show" id="order_items" aria-labelledby="order_items-tab" aria-expanded="true">
			<div class="m-t-20">
				<?php
				xform_input('order_id', 'hidden', $row->id);
				if (company_user()) { 
	                //bulk action options
	                if ($row->product_count > 0) {
	                	$options = [
	                		'Unprocessed' => ['label' => 'Mark Unprocessed', 'modal' => 'm_item_status'],
	                		'Processed' => ['label' => 'Mark Processed', 'modal' => 'm_item_status']
	                	];
	                    bulk_action($options, $row->product_count);
	                }
					$headers = ['Image', 'Product Name' => ['class' => 'min-w-200'], 'Category' => ['class' => 'min-w-150'], 'Status', 'Size' => ['class' => 'min-w-100'], 'Color', 'Qty', 'In Stock', 'Purchase Price', 'Current Price'];
					ajax_table('items_table', '', $headers, [], ['created' => false, 'updated' => false]);
				} else {
					$headers = ['Image', 'Product Name' => ['class' => 'min-w-200'], 'Category' => ['class' => 'min-w-150'], 'Status', 'Size' => ['class' => 'min-w-100'], 'Color', 'Qty', 'Purchase Price'];
					ajax_table('items_table', '', $headers, [], ['checker' => false, 'actions' => false, 'created' => false, 'updated' => false]);
				} ?>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane fade" id="order_details" aria-labelledby="order_details-tab" aria-expanded="true">
			<?php view_section_title('Order Details', 'indent', false); ?>
			<div class="row">
				<div class="<?php echo grid_col(12, 6); ?>">
					<?php
					if (company_user()) {
						data_show_grid('Customer', $row->customer_name);
					}
					data_show_grid('Ref ID', $row->ref_id);
					data_show_grid('Total Products', $row->product_count);
					data_show_grid('Date Placed', $row->placed_on);
					data_show_grid('Status', order_status_bg($row->order_status, $row->order_status_bg));
					data_show_grid('Paid', $row->has_paid);
					data_show_grid('Amount Paid', $row->amount_paid_name);
					?>
				</div>
				<div class="<?php echo grid_col(12, 6); ?>">
					<?php
					data_show_grid('Date Paid', $row->paid_on);
					data_show_grid('Payment Mode', $row->payment_mode_name);
					data_show_grid('Payment Ref ID', $row->payment_ref_id);
					data_show_grid('Processed By', $row->processed_by_name);
					data_show_grid('Date Processed', $row->processed_on);
					?>
				</div>
			</div>
			<?php view_section_title('Additional Notes', 'edit'); ?>
			<div class="row">
				<div class="<?php echo grid_col(12); ?>">
					<?php echo $row->ship_extra; ?>
				</div>
			</div>
			<?php view_section_title('Comments', 'comments'); ?>
			<div class="row">
				<div class="<?php echo grid_col(12); ?>">
					<?php echo $row->comment; ?>
				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane fade" id="customer" aria-labelledby="customer-tab" aria-expanded="true">
			<?php view_section_title((company_user() ? 'Customer' : 'My'). ' Details', 'user', false); ?>
			<div class="row">
				<div class="<?php echo grid_col(12, 6); ?>">
					<?php 
					data_show_grid('Name', $row->customer_name);
					data_show_grid('Email', $row->email);
					data_show_grid('Phone', $row->phone);
					?>
				</div>
				<div class="<?php echo grid_col(12, 6); ?>">
					<?php
					data_show_grid('State', $row->state_name);
					data_show_grid('Address', $row->address);
					data_show_grid('Apartment', $row->apartment);
					?>
				</div>
			</div>
		</div>
		
		<div role="tabpanel" class="tab-pane fade" id="shipping" aria-labelledby="shipping-tab" aria-expanded="true">
			<?php view_section_title('Shipping Details', 'paper-plane', false); ?>
			<?php 
			if ($row->ship_is_bill == 1) { ?>
				<h5>Same as <?php echo company_user() ? 'customer' : 'my'; ?> details</h5>
				<?php
			} else { ?>
				<div class="row">
					<div class="<?php echo grid_col(12, 6); ?>">
						<?php 
						data_show_grid('Name', $row->ship_name);
						data_show_grid('Email', $row->ship_email);
						data_show_grid('Phone', $row->ship_phone);
						?>
					</div>
					<div class="<?php echo grid_col(12, 6); ?>">
						<?php
						data_show_grid('State', $row->ship_state_name);
						data_show_grid('Address', $row->ship_address);
						data_show_grid('Apartment', $row->ship_apartment);
						?>
					</div>
				</div>
				<?php 
			} ?>
		</div>

	</div>
</div>

<?php
if (company_user()) {
	//modals
	$modals = ['item_status'];
	require 'modals.php';
}