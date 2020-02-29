<?php
xform_input('status', 'hidden', xget('status'));
$headers = ['Customer' => ['class' => 'min-w-200'], 'Ref ID', 'Total Products', 'Date Placed' => ['class' => 'min-w-200'], 'Status', 'Paid', 'Amount Paid', 'Date Paid', 'Payment Mode', 'Payment Ref ID', 'Processed By', 'Date Processed'];
ajax_table('orders_table', '', $headers, [], ['created' => false, 'updated' => false]);