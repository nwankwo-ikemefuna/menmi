<?php
xform_input('cat_id', 'hidden', xget('cat_id'));
$headers = ['Image', 'Name' => ['class' => 'min-w-200'], 'URL' => ['class' => 'min-w-200'], 'Category', 'Order'];
ajax_table('sliders_table', '', $headers);
?>