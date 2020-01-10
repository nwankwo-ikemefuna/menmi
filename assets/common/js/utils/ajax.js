jQuery(document).ready(function ($) {
    "use strict";  

    $(document).on( "submit", ".ajax_form", function(e) {
        $(this).off("submit"); //unbind event to prevent multiple firing
        e.preventDefault();
        let obj = $(this);
        let form_data = obj.serialize();
        var url = obj.attr('action'),
            form_id = obj.attr('id'),
            type = obj.attr('data-type') ? obj.data('type') : 'modal_dt',
            msg = obj.attr('data-msg') ? obj.data('msg') : 'Successful',
            notice = obj.attr('data-notice') ? obj.data('notice') : '.status_msg';

        if (url.length && form_id.length && type.length) {
            switch (type) {
                //modal datatables
                case 'modal_dt':
                    var modal = obj.attr('data-modal') ? obj.data('modal') : null,
                        reload = obj.attr('data-reload') ? Boolean(obj.data('reload')) : true;
                    if (modal.length) {
                        ajax_post_form_dt(form_data, url, modal, msg, reload, notice);
                    }
                    break;
                //redirect
                case 'redirect':
                    var redirect = obj.attr('data-redirect') ? obj.data('redirect') : '_self';
                    ajax_post_form(form_data, url, redirect, msg, notice);
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

});

function ajax_post_form(form_data, url, redirect_url = '', success_msg = 'Successful', notice_elem = '.status_msg') {
    $.ajax({
        url: url, 
        type: 'POST',
        data: form_data,
        dataType: 'json'
    }).done(function(jres) {
        if (jres.status) {
            $(notice_elem).html('<div class="alert alert-success">'+success_msg+'</div>')
                .fadeIn('fast')
                .delay( 10000 )
                .fadeOut( 'slow' );
            setTimeout(function() { 
                if (redirect_url == '_self') {
                    location.reload();
                } else {
                    $(location).attr('href', redirect_url);
                }
            }, 3000);  
        } else {
            $(notice_elem).html('<div class="alert alert-danger text-center">' + jres.error + '</div>')
                .fadeIn( 'fast' )
                .delay( 10000 )
                .fadeOut( 'slow' );
        }
    });
}

function ajax_post_form_dt(form_data, url, modal_id = '',  success_msg = 'Successful!', reload_table = true, notice_elem = '.status_msg') {
    $.ajax({
        url: url, 
        type: 'POST',
        data: form_data,
        dataType: 'json'
    }).done(function(jres) {
        if (jres.status) {
            if (reload_table) {
                $('.ajax_dt_table').DataTable().ajax.reload();
            }
            $(notice_elem).html('<div class="alert alert-success">'+success_msg+'</div>')
                .fadeIn('fast')
                .delay( 10000 )
                .fadeOut( 'slow' );
            if (modal_id.length) {
                setTimeout(function() { 
                    $('#'+modal_id).modal('hide');
                }, 3000);  
            }
        } else {
            $(notice_elem).html('<div class="alert alert-danger text-center">' + jres.error + '</div>')
                .fadeIn( 'fast' )
                .delay( 10000 )
                .fadeOut( 'slow' );
        }
    });
}

//form multipart
function ajax_post_form_mp(form_id, url, notice_elem = '.status_msg', redirect_url = '', success_msg = '') {
    $('#'+form_id).off("submit"); //unbind event to prevent multiple firing
    $('#'+form_id).submit(function(e) {
        e.preventDefault();
        let form_data = new FormData();
        $.ajax({
            url: base_url+url, 
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false
        }).done(function(jres) {
            if (jres.status) {
                $(notice_elem).html('<div class="alert alert-success">'+success_msg+'</div>')
                    .fadeIn('fast');
                if (redirect_url.length) {
                    setTimeout(function() { 
                        $(location).attr('href', base_url+redirect_url);
                    }, 3000);
                }    
            } else {
                $(notice_elem).html('<div class="alert alert-danger text-center">' + jres.error + '</div>')
                    .fadeIn( 'fast' )
                    .delay( 10000 )
                    .fadeOut( 'slow' );
            }
        });
    });
}

function ajax_post_btn_data(url, mod, md, tb, id, btn_id, modal_id = '', success_msg = 'Successful', extra = {}, reload_table = true) {
    //is id an array
    id = Array.isArray(id) && id.length ? id.join() : id;
    var post_data = {mod: mod, md: md, tb: tb, id: id};
    console.log('ba record idx', id);
    // post_data = extra.length ? {...post_data, ...extra} : post_data;
    $('#'+btn_id).off("click"); //unbind event to prevent multiple firing
    $('#'+btn_id).click(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url+url, 
            type: 'POST',
            data: post_data,
            dataType: 'json'
        }).done(function(jres) {
            if (jres.status) {
                if (modal_id.length) {
                    $('.confirm_status')
                        .removeClass('alert alert-danger')
                        .addClass('alert alert-success')
                        .html(success_msg)
                        .fadeIn( 'fast' )
                        .delay( 3000 )
                        .fadeOut( 'slow' );
                    setTimeout(function() { 
                        $('#'+modal_id).modal('hide');
                    }, 3000);
                }
                if (reload_table) {
                    $('.ajax_dt_table').DataTable().ajax.reload();
                }
            } else {
                $('.confirm_status')
                    .removeClass('alert alert-success')
                    .addClass('alert alert-danger')
                    .html(jres.error)
                    .fadeIn( 'fast' )
                    .delay( 3000 )
                    .fadeOut( 'slow' );
            }
        });
    });
}