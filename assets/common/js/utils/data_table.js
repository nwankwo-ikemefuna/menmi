jQuery(document).ready(function ($) {
    "use strict";  

    //Non-server side datatables
    var table = $('#table_client').DataTable({ 
        "paging": true,
        "pageLength" : 25,
        "lengthChange": true, 
        "searching": true,
        "info": true,
        "scrollX": true,
        "autoWidth": false,
        "ordering": true,
        "stateSave": true,
        "processing": false, 
        "pagingType": "simple_numbers", 
        "language": {
            "search": "Search/filter: ",
            "emptyTable": "Nothing to show.",
        }
    });

    //ajax datatables trigger
    var dt = $('.ajax_dt_table');
    if (dt.length) {
        var table = dt.attr('id'),
            custom = dt.data('custom'),
            url = dt.data('url'),
            cols = dt.data('cols'),
            col_defs = dt.attr('data-col_defs') ? dt.data('col_defs') : [],
            per_page = dt.attr('data-per_page') ? dt.data('per_page') : 30;
        if ( ! custom)
            ajax_data_table(table, url, cols, col_defs, per_page);
    }
});


//print and export buttons for DataTables
var ExportButtons = [
    {
        extend: 'colvis', //column visibility
    },
    {
        extend: 'print',
        exportOptions: {
            columns: ':visible'
        }
    },
    {
        extend: 'excel',
        exportOptions: {
            text: 'Export',
            columns: ':visible'
        }
    },
    {
        extend: 'csv',
        exportOptions: {
            columns: ':visible'
        }
    },
    {
        extend: 'pdf',
        exportOptions: {
            columns: ':visible'
        }
    }
];


// Setup datatables
$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
    return {
  "iStart": oSettings._iDisplayStart,
  "iEnd": oSettings.fnDisplayEnd(),
  "iLength": oSettings._iDisplayLength,
  "iTotal": oSettings.fnRecordsTotal(),
  "iFilteredTotal": oSettings.fnRecordsDisplay(),
  "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
  "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};

function ajax_data_table(table_id, url, columns, column_defs = [], page_length = 30) {
    //extras
    var extras = $('.ajax_dt_table').data('extras');    
    if ( ! $.isEmptyObject(extras)) {
        var prepend = [], append = [];
        //checker
        if (extras.checker) {
            var checker_obj = [{"data": "checker", "searchable": false, "orderable": false}];
            prepend = [...prepend, ...checker_obj];
        }
        //actions
        if (extras.actions) {
            var actions_obj = [{"data": "actions", "searchable": false, "orderable": false}];
            prepend = [...prepend, ...actions_obj];
        }
        columns = [...prepend, ...columns];
        //date created
        if (extras.created) {
            var created_obj = [{"data": "created_on"}];
            append = [...append, ...created_obj];
        }
        //date updated
        if (extras.updated) {
            var updated_obj = [{"data": "updated_on"}];
            append = [...append, ...updated_obj];
        }
        columns = [...columns, ...append];
    }
    var table = $('#'+table_id).dataTable({ 
        initComplete: function() {
            var api = this.api();
            $('#'+table_id+'_filter input')
                .off('.DT')
                .on('input.DT', function() {
                    api.search(this.value).draw();
                 });
        },
        searching: true,
        language: {
           processing: "loading..."
        },
        paging: true,
        pageLength : page_length,
        // scrollX: true,
        stateSave: true,
        processing: true,
        serverSide: true,
        info: true,
        ajax: {
            url: base_url + url + '/' + trashed, 
            type: "POST",
            //data: { 'q2r_secure' : csrf_hash } //cross site request forgery protection
        },
        columns: columns,
        columnDefs: column_defs,
        order: [],
        buttons: ExportButtons,
        dom: "<'dt_buttons'B>frtip",
        rowCallback: function(row, data, iDisplayIndex) {
            var index = iDisplayIndex + 1;
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
        //     $('td:eq(1)', row).html(index); //counter
        }
     
    });
}

function record_image(url) { 
    // var src = image_exists(url) ? url : base_url+'assets/common/img/icons/not_found.png';
    return '<img class="record_image clickable tm_image" src='+url+'>'; 
}

function record_image_col(image = 'image_file') {
    return {
        data: image, 
        searchable: false,
        orderable: false,
        render: function (data, type, row) { 
            return record_image(data);
        }
    };
}

function table_query_var(name) {
    var data = $('[name="'+name+'"]').val();
    data = data === "undefined" || data == '' ? 0 : data;
    return data;
}
