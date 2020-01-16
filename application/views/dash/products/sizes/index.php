<?php
$headers = ['Size Name' => ['class' => 'min-w-200'], 'Order', 'Product Count'];
$columns = ['name', 'order', ['data' => 'product_count', 'searchable' => false, 'orderable' => false]];
ajax_table('data_table', $this->c_controller.'/sizes_ajax', $headers, $columns); 

$modals = ['add', 'edit'];
require 'modals.php';
?>