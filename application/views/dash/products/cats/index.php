<?php
$headers = ['Category Name' => ['class' => 'min-w-200'], 'Order', 'Product Count'];
$columns = ['name', 'order', ['data' => 'product_count', 'searchable' => false, 'orderable' => false]];
ajax_table('data_table', $this->c_controller.'/cats_ajax', $headers, $columns);

$modals = ['add', 'edit'];
require 'modals.php';
?>