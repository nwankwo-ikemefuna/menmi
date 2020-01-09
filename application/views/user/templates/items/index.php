<?php
$columns = ['Item Name' => ['class' => 'min-w-200'], 'Category', 'Actions' => ['class' => 'min-w-100']];
$keys = ['name', 'category', 'actions' => ['searchable' => false, 'orderable' => false]];
ajax_table('items_table', $columns, $keys, $this->c_controller.'/items_ajax/'.$row->id); 

require 'modals.php';