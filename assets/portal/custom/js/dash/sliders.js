jQuery(document).ready(function ($) {
    "use strict"; 

    var columns = [
        record_image_col(),
        {data: 'name'},
        {data: 'message'},
        {data: 'tag'},
        {data: 'btn_text'},
        {data: 'url'},
        {data: 'category'},
        {data: 'order'}
    ];
    ajax_data_table('sliders_table', c_controller+'/data_ajax', columns);
});