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
    if (typeof dt.attr('id') !== "undefined") {
        var table = dt.attr('id'),
            url = dt.data('ajax_url'),
            keys = dt.data('ajax_keys');
        ajax_data_table(table, url, keys);
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

function adjust_index(arr) {
    // var new_arr = arr.map(n => n + 2);
}

function ajax_data_table(table_id, url, columns, no_search = [], no_order = [], page_length = 10) {
    //common column names
    let common_cols = [
        {"data": "checker"},
        {"data": null}
    ];
    //common column index
    let common_ignore = [0, 1];
    //adjust no_search and no_order index to account for the 2 guys above
    /*no_search = adjust_index(no_search);
    no_order = adjust_index(no_order);*/

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
        ajax: {
            url: base_url + url + '/' + trashed, 
            type: "POST",
            //data: { 'q2r_secure' : csrf_hash } //cross site request forgery protection
        },
        columns: [...common_cols, ...columns],
        columnDefs: [
            {searchable: false, targets: [...common_ignore, ...no_search]},
            {orderable: false, targets: [...common_ignore, ...no_order]},
        ],
        order: [],
        buttons: ExportButtons,
        dom: "<'dt_buttons'B>frtp",
        rowCallback: function(row, data, iDisplayIndex) {
            var index = iDisplayIndex + 1;
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(1)', row).html(index); //counter
        }
     
    });
}