<?php
$headers = ['Short Name', 'Full Name', 'Order', 'Product Count'];
$columns = ['short_name', 'name', 'order', ['data' => 'product_count', 'searchable' => false, 'orderable' => false]];
ajax_table('data_table', $this->c_controller.'/tags_ajax', $headers, $columns); 

$modals = ['add', 'edit'];
require 'modals.php';
?>