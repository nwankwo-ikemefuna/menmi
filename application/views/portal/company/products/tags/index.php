<h5 class="page_into_text">Tags are used to show related products and to increase SEO and customer conversions. Use them judiciously.</h5>

<?php
$headers = ['Short Name', 'Full Name', 'Order', 'Product Count'];
$columns = ['short_name', 'name', 'order', ['data' => 'product_count', 'searchable' => false, 'orderable' => false]];
ajax_table('data_table', $this->c_controller.'/tags_ajax', $headers, $columns); 

$modals = ['add', 'edit'];
require 'modals.php';