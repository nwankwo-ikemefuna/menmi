<?php
$headers = ['Image', 'Product Name' => ['class' => 'min-w-200'], 'Category', 'Size', 'Stock', 'Amount', 'Rating'];
ajax_table_render('products_table', $headers);
?>