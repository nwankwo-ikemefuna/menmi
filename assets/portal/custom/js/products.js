jQuery(document).ready(function ($) {
    "use strict"; 
    var columns = [
        dt_image_col(),
        {data: 'name'},
        {data: 'category'},
        {data: 'size_name'},
        {data: 'stock'},
        {data: 'amount'},
        {data: 'rating', render: function(data) {return rating_stars(data)}}
    ];
    ajax_data_table('products_table', c_controller+'/data_ajax', columns);
});