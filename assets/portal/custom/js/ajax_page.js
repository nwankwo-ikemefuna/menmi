jQuery(document).ready(function ($) {
	//ajax datatables trigger
	//bs select wraps select in a div, and this class is applied to the div too, so we target the selectfield, which is at odd index ie 1, 3, 5, etc
	var ajxs = $('.ajax_select'); 
	if ($(ajxs).length) {
	    $.each($(ajxs), (i, obj) => {
	        if (i % 2 !== 0) { //at every odd position
	            if (typeof $(obj).attr('data-url') !== "undefined") {
	                var url = $(obj).data('url'),
	                    selectfield = $(obj).attr('name'),
	                    selected = $(obj).attr('data-selected') ? $(obj).data('selected') : '';
	                get_select_options(url, selectfield, selected);
	            }
	        }
	    });
	}

	//ajax datatables trigger
    var dt = $('.ajax_dt_table');
    if (dt.length) {
        var table = dt.attr('id'),
            custom = dt.data('custom'),
            url = dt.data('url'),
            cols = dt.data('cols'),
            col_defs = dt.attr('data-col_defs') ? dt.data('col_defs') : [],
            per_page = dt.attr('data-per_page') ? dt.data('per_page') : 30;
        if ( ! custom) {
            ajax_data_table(table, url, cols, col_defs, per_page);
        }
    }

});