//selectfield params to update and refresh selectfield when a new item is added from another form
var selectfield_url = ''; 
var selectfield_name = ''; 

jQuery(document).ready(function ($) {
    "use strict"; 

    $(document).on( "submit", ".ajax_form", function(e) {
        $(this).off("submit"); //unbind event to prevent multiple firing
        e.preventDefault();
        let obj = $(this);
        var url = obj.attr('action'),
            form_id = obj.attr('id'),
            type = obj.attr('data-type') ? obj.data('type') : 'modal_dt',
            msg = obj.attr('data-msg') ? obj.data('msg') : 'Successful',
            notice = obj.attr('data-notice') ? obj.data('notice') : 'status_msg',
            modal = obj.attr('data-modal') ? obj.data('modal') : null,
            reload = obj.attr('data-reload') ? Boolean(obj.data('reload')) : true;
        let form_data = new FormData(this);
        if (url.length && form_id.length && type.length) {
            switch (type) {

                //modal datatables, with selectpicker
                case 'modal_dt':
                case 'modal_sp':
                    if (modal.length) {
                        ajax_post_form_refresh(form_data, url, modal, type, msg, reload, notice);
                    }
                    break;

                //alert, redirect
                case 'js_alert':
                case 'redirect':
                    var redirect = obj.attr('data-redirect') ? obj.data('redirect') : '_self';
                    ajax_post_form(form_data, url, type, redirect, msg, notice);
                    break;
            }
        } else {
            console.error('Setup Error: url, form id or type missing');
        }
    });

    //Edit item: modal
    $(document).on( "click", ".edit_record", function() {
        var modal = $(this).data('x_modal'),
            form_id = $(this).data('x_form_id');
        //clear form
        $('#'+form_id)[0].reset();
        var inputs = $('form#'+form_id+' :input');
        $.each(inputs, (i, input) => {
            var name = $(input).attr('name');
            if (typeof name !== "undefined") {
                var val = $(this).data(name);
                var field = $('#'+form_id).find(':input[name="'+name+'"]');
                //get input type or tagname if type is undefined (eg select, textarea)
                var type = field.attr('type') || field.prop('tagName').toLowerCase();
                if (type == 'select' || type == 'checkbox' || type == 'radio') {
                    //we need to call change event on these guys
                    field.val(val).change();
                } else {
                    field.val(val);
                }
            }
        });
        $('#'+modal+ ' .modal-title').text('Edit Record');
        $('#'+modal).modal('show'); //show the modal
    });

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


    //selectpicker multiple items render on edit
    var select_mult = $('.select_mult'); 
    if ($(select_mult).length) {
        $.each($(select_mult), (i, obj) => {
            if (i % 2 !== 0) { //at every odd position
                console.log($(obj));
                if (typeof $(obj).attr('data-selected') !== "undefined") {
                    var selectfield = $(obj).attr('name'),
                        selected = $(obj).data('selected');
                    $('[name="'+selectfield+'"]').selectpicker('val', selected).change();
                }
            }
        });
    }

    //set selectfield url and name
    $(document).on( "click", ".ajax_select_btn", function() {
        selectfield_url = $(this).data('url');
        selectfield_name = $(this).data('selectfield');
    });

});

function get_select_options(url, selectfield, current_val) {
    $.ajax({
        url: base_url+url, 
        type: 'GET',
        dataType: 'json',
    }).done( jres => {
        $('[name="'+selectfield+'"]').empty(); //empty selectfield
        var options = '<option value="">Select</option>';
        if (jres.status) { 
            var result = jres.body.msg;
            if (result.length) {
                $.each(result, (i, row) => {
                    // var selected = row.id == current_val ? 'selected' : '';
                    options += `<option ${row.id == current_val ? 'selected' : ''} value="${row.id}">${row.name}</option>`;
                });
            } else {
                options += `<option value="" style="color: red">${jres.error}</option>`;
            }

        } else {
            //status is false, show error message in red
            options += `<option value="" style="color: red">${jres.error}</option>`;
        }
        //append the options to the select field
        $('[name="'+selectfield+'"]').append(options);
        $('[name="'+selectfield+'"]').selectpicker('refresh');
    });
}

function ajax_post_form(form_data, url, fm_type, redirect_url = '', success_msg = 'Successful', notice_elem = 'status_msg') {
    $.ajax({
        url: url, 
        type: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.'+notice_elem).empty();
            $('.ajax_spinner').removeClass('hide').addClass('fa-spin');
        },
        complete: function() {
            $('.ajax_spinner').addClass('hide').removeClass('fa-spin');
        }
    }).done(function(jres) {
        if (jres.status) {
            if (fm_type == 'js_alert') {
                alert(jQuery(success_msg).text());
            } else {
                status_box(notice_elem, success_msg, 'success');
            }
            setTimeout(function() { 
                switch (redirect_url) {
                    case '_void':
                        //no redirect
                        //do nothing
                        break;
                    case '_self':
                        //self redirect
                        location.reload();
                        break;
                    case '_dynamic':
                        //dynamic redirect
                        $(location).attr('href', base_url+jres.body.msg.redirect);
                        break;
                    default:
                        //as provided
                        $(location).attr('href', redirect_url);
                        break;
                }
            }, 3000);  
        } else {
            if (fm_type == 'js_alert') {
                alert(jQuery(jres.error).text());
            } else {
                status_box(notice_elem, jres.error, 'danger');
            }
        }
    });
}

function ajax_post_form_refresh(form_data, url, modal_id = '', fm_type = 'modal_dt', success_msg = 'Successful!', refresh = true, notice_elem = 'status_msg') {
    $.ajax({
        url: url, 
        type: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.'+notice_elem).empty();
            $('.ajax_spinner').removeClass('hide').addClass('fa-spin');
        },
        complete: function() {
            $('.ajax_spinner').addClass('hide').removeClass('fa-spin');
        }
    }).done(function(jres) {
        if (jres.status) {
            if (refresh) {
                if (fm_type == 'modal_sp') {
                    //refresh selectfield
                    get_select_options(selectfield_url, selectfield_name);
                } else {
                    $('.ajax_dt_table').DataTable().ajax.reload();
                }
            }
            status_box(notice_elem, success_msg, 'success');
            if (modal_id.length) {
                setTimeout(function() { 
                    $('#'+modal_id).modal('hide');
                }, 3000);  
            }
        } else {
            status_box(notice_elem, jres.error, 'danger');
        }
    });
}

function ajax_post_btn_data(url, post_data, btn_id, modal_id = '', success_msg = 'Successful', reload_table = true) {
    // post_data = extra.length ? {...post_data, ...extra} : post_data;
    $('#'+btn_id).off("click"); //unbind event to prevent multiple firing
    $('#'+btn_id).click(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url+url, 
            type: 'POST',
            data: post_data,
            dataType: 'json',
            beforeSend: function() {
                $('.confirm_status').empty();
                $('.ajax_spinner').removeClass('hide').addClass('fa-spin');
            },
            complete: function() {
                $('.ajax_spinner').addClass('hide').removeClass('fa-spin');
            }
        }).done(function(jres) {
            if (jres.status) {
                if (modal_id.length) {
                    status_box('confirm_status', success_msg, 'success');
                    setTimeout(function() { 
                        $('#'+modal_id).modal('hide');
                    }, 3000);
                }
                if (reload_table) {
                    $('.ajax_dt_table').DataTable().ajax.reload();
                }
            } else {
                status_box('confirm_status', jres.error, 'danger');
            }
        });
    });
}

function paginate(url, elem, row_render, pagination = 'pagination', succ_callbk = null, err_callbk = null) {
  $('#'+pagination).on('click', 'ul li a', function(e){
    e.preventDefault(); 
    var page_num = $(this).attr('data-ci-pagination-page');
    paginate_data(url, elem, row_render, pagination, page_num, {}, succ_callbk, succ_callbk, err_callbk);
  });
}

function paginate_data(url, elem, row_render, paginate_elem = 'pagination', page_num = 0, data = {}, succ_callbk = null, err_callbk = null) {
  $.ajax({
    url: base_url+url+'/'+page_num,
    type: 'POST',
    dataType: 'json',
    data: data
  }).done(function(jres) {
    $('#'+paginate_elem).html(jres.body.msg.pagination);
    $('#'+elem).empty();
    if (jres.status) {
      var accum = '';
      $.each(jres.body.msg.records, (i, row) => {
          if ( typeof row_render == "function" )
            accum += row_render(row);
      });
      $('#'+elem).html(accum);
      if ( typeof succ_callbk == "function" ) 
        succ_callbk(jres);
    } 
  }).fail(function(jres) {
    if ( typeof err_callbk == "function" ) 
        err_callbk(jres);
  });
}

function status_box(elem, msg, type = 'success', delay = 10000) {
    var status_div = 
    `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${msg}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`;
    $('.'+elem).html(status_div)
        .fadeIn( 'fast' )
        .delay( 10000 )
        .fadeOut( 'slow' );
}