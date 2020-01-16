jQuery(document).ready(function ($) {
    "use strict"; 
    var columns = [
        record_image_col(),
        {data: 'name'},
        {data: 'category'},
        {data: 'size_name'},
        {data: 'stock'},
        {data: 'amount'}
    ];
    ajax_data_table('products_table', c_controller+'/data_ajax', columns);
});