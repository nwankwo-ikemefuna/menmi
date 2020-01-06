jQuery(document).ready(function ($) {
    "use strict";  
});

function ajax_post_form(form_id, url, redirect_url = '', success_msg = 'Successful', notice_elem = '.status_msg') {
    $('#'+form_id).off("submit"); //unbind event to prevent multiple firing
    $('#'+form_id).submit(function(e) {
        e.preventDefault();
        let form_data = $(this).serialize();
        $.ajax({
            url: base_url+url, 
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
    });
}

function ajax_post_form_dt(form_id, url, modal_id = '',  success_msg = 'Successful!', reload_table = true, notice_elem = '.status_msg') {
    $('#'+form_id).off("submit"); //unbind event to prevent multiple firing
    $('#'+form_id).submit(function(e) {
        e.preventDefault();
        let form_data = $(this).serialize();
        $.ajax({
            url: base_url+url, 
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

function confirm_actions(obj, ajax_url, title, msg, success_msg = 'Successful') {
    $('#m_confirm_action .modal-title').text(title); 
    $('#m_confirm_action .modal-body .msg').html(msg); 
    $('#m_confirm_action').modal('show');
    var id = $(obj).data('id');
    var tb = $(obj).data('tb');
    var mod = $(obj).data('mod');
    var md = $(obj).data('md');
    ajax_post_btn_data(ajax_url, mod, md, tb, id, 'confirm_btn', 'm_confirm_action', success_msg);
}

function modal_edit_record(obj, modal, form_id, attrs, url, item = 'Record') {
    //clear form
    $('#'+form_id)[0].reset();
    $.each(attrs, (key, name) => {
        var val = $(obj).data(key);
        //if name is not supplied, use the key as name
        name = name.length ? name : key;
        var field = $('#'+form_id).find(':input[name="'+name+'"]');
        //get input type or tagname if type is undefined (eg select, textarea)
        var type = field.attr('type') || field.prop('tagName').toLowerCase();
        if (type == 'select' || type == 'checkbox' || type == 'radio') {
            //we need to call change event on these guys
            field.val(val).change();
        } else {
            field.val(val);
        }
    });
    $('#'+modal+ ' .modal-title').text('Edit Record');
    $('#'+modal).modal('show'); //show the modal
    return ajax_post_form_dt(form_id, url, modal, item+' updated successfully.');
}