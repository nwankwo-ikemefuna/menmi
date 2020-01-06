<?php
$columns = ['Template Name' => 'min-w-200', 'VAT (%)', 'Item Count', 'Actions' => 'min-w-100'];
ajax_table('templates_table', $columns); ?>

<!-- Add Modal -->
<?php 
//header
modal_header('m_add', 'New Template', '', ''); 
//form
$attrs = ["id" => "add_template_form"]; 
echo form_open(null, $attrs);
    form_group_input('Name', 'name', 'text');
    form_group_input('Vat', 'vat', 'number');
    form_notice();
    form_submit();
echo form_close();
//footer
modal_footer(false); 

