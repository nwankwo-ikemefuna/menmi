jQuery(document).ready(function ($) {
    "use strict"; 
    var columns = [
        dt_name_col('m_'),
        {data: 'email'},
        {data: 'phone'}
    ];
    ajax_data_table('messages_table', c_controller+'/data_ajax', columns);
});