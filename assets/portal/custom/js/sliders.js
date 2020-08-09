jQuery(document).ready(function ($) {
    "use strict"; 

    var columns = [
        dt_image_col(),
        {data: 'name'},
        {data: 'url'},
        {data: 'category'},
        {data: 'order'}
    ];
    var cat_id = table_query_var('cat_id');
    ajax_data_table('sliders_table', c_controller+'/data_ajax/'+cat_id, columns);
});