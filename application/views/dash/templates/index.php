<?php
$columns = ['Template Name' => ['class' => 'min-w-200'], 'VAT (%)', 'Item Count', 'Actions' => ['class' => 'min-w-100']];

$keys = ['name', 'vat', 'total_items' => ['searchable' => false, 'orderable' => false], 'actions' => ['searchable' => false, 'orderable' => false]];
ajax_table('templates_table', $columns, $keys, $this->c_controller.'/templates_ajax');

require 'modals.php';