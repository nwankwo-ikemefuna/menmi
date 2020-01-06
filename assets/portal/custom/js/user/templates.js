jQuery(document).ready(function ($) {
    "use strict"; 

    //Add template
    ajax_post_form_dt('add_form', c_controller+'/add_ajax', 'm_add', 'Template added successfully');

    //templates
    var columns = [
        {"data": "name"},
        {"data": "vat"},
        {"data": "total_items"},
        {"data": "actions"}
    ];
    var _ignore = [4, 5];
    ajax_data_table('templates_table', c_controller+'/templates_ajax/', columns, _ignore, _ignore);

    //template items
    var columns = [
        {"data": "name"},
        {"data": "category"},
        {"data": "actions"}
    ];
    var _ignore = [4];
    var template_id = $('[name="template_id"]').val();
    ajax_data_table('items_table', c_controller+'/items_ajax/'+template_id, columns, _ignore, _ignore);

    //Add item
    ajax_post_form_dt('add_form', c_controller+'/add_item_ajax', 'm_add', 'Item added successfully');
    //Edit item
    $(document).on( "click", ".edit_record", function() {
        var attrs = {id: '', name: '', cat_id: ''};
        modal_edit_record(this, 'm_edit', 'edit_form', attrs, c_controller+'/edit_item_ajax', 'Item');

    });

});