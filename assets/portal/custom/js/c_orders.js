jQuery(document).ready(function ($) {
    "use strict"; 
    //orders
    var columns = [
        {data: 'ref_id'},
        {data: 'product_count', searchable: false, orderable: false},
        {data: 'placed_on'},
        dt_custom_status_badge_col('status', 'order_status', 'order_status_bg'),
        dt_status_badge_col('paid', 'has_paid'),
        {data: 'amount_paid_name'},
        {data: 'paid_on'},
        {data: 'payment_mode_name'},
        {data: 'payment_ref_id'}
    ];
    var status = table_query_var('status');
    ajax_data_table('orders_table', c_controller+'/data_ajax/'+status, columns);

    //order items
    var columns = [
        dt_image_col(),
        {data: 'product_name'},
        {data: 'category'},
        dt_status_badge_col('status', 'item_status'),
        {data: 'size_name'},
        {data: 'color_name'},
        {data: 'qty'},
        {data: 'purchase_price'}
    ];
    var order_id = $('[name="order_id"]').val();
    ajax_data_table('items_table', c_controller+'/items_ajax/'+order_id, columns);
});