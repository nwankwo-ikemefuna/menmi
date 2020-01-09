<?php
$columns = ['Template Name' => 'min-w-200', 'VAT (%)', 'Item Count', 'Actions' => 'min-w-100'];

$keys = ['name', 'vat', 'total_items' => ['searchable' => false, 'orderable' => false], 'actions' => ['searchable' => false, 'orderable' => false]];
ajax_table('templates_table', $columns, $keys, $this->c_controller.'/templates_ajax');

require 'modals.php';