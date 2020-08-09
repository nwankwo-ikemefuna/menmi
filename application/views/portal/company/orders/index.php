<?php 
if (company_user()) { ?>

	<div class="page_into_text">
		<h4 class="text-bold">Note</h4>
		<ul>
			<li>When orders are marked <b>Paid</b>, the ordered quantity will be deducted from the product inventory.</li>
			<li class="hide">Only cancelled orders can be deleted.</li>
		</ul>
	</div>

	<?php
	xform_input('status', 'hidden', xget('status'));
	$headers = ['Customer' => ['class' => 'min-w-200'], 'Ref ID', 'Total Items', 'Date Placed' => ['class' => 'min-w-200'], 'Status', 'Paid', 'Amount Paid', 'Date Paid', 'Payment Mode', 'Payment Ref ID', 'Processed By', 'Date Processed'];
	ajax_table('orders_table', '', $headers, [], ['created' => false, 'updated' => false, 'actions_class' => 'min-w-150']);

	//modals
	$modals = ['order_status', 'payment_status'];
	require 'modals.php';

} else {

	$headers = ['Ref ID', 'Total Items', 'Date Placed' => ['class' => 'min-w-200'], 'Status', 'Paid', 'Amount Paid', 'Date Paid', 'Payment Mode', 'Payment Ref ID'];
	ajax_table('orders_table', '', $headers, [], ['checker' => false, 'created' => false, 'updated' => false, 'actions_class' => 'min-w-50']);
}