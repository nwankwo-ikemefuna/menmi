<?php
$columns = ['Item Name' => ['class' => 'min-w-200'], 'Category'];
$keys = ['name', 'category'];
ajax_table('items_table', $columns, $keys, $this->c_controller.'/items_ajax/'.$row->id); 

require 'modals.php';