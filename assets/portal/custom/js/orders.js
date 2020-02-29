jQuery(document).ready(function ($) {
    "use strict"; 
    //orders
    var columns = [
        {data: 'customer_name'},
        {data: 'ref_id'},
        {data: 'product_count', searchable: false, orderable: false},
        {data: 'placed_on'},
        {data: 'order_status', 
            render: function(data, type, row) {
                return `<span class="badge badge-pill badge-${row.order_status_bg} text-bold">${data}</span>`;
            }
        },
        {data: 'has_paid'},
        {data: 'amount_paid_name'},
        {data: 'paid_on'},
        {data: 'payment_mode_name'},
        {data: 'payment_ref_id'},
        {data: 'processed_by_name'},
        {data: 'processed_on'}
    ];
    var status = table_query_var('status');
    ajax_data_table('orders_table', c_controller+'/data_ajax/'+status, columns);

    //order items
    var columns = [
        record_image_col(),
        {data: 'product_name'},
        {data: 'category'},
        {data: 'size_name'},
        {data: 'color_name'},
        {data: 'qty'},
        {data: 'stock'},
        {data: 'amount_paid'},
        {data: 'current_amount'},
        {data: 'item_status'},
    ];
    var order_id = $('[name="order_id"]').val();
    ajax_data_table('items_table', c_controller+'/items_ajax/'+order_id, columns);
});