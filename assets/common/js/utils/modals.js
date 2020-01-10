jQuery(document).ready(function ($) {
    "use strict";

    //Note: tm is short for trigger_modal 
    
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
    
    //trash record
    $(document).on( "click", ".trash_record", function() {
        confirm_actions(this, 'common/trash_ajax', 'Trash Record', 'Sure to trash this record?', 'Record trashed successfully');
    });

    //trash all records
    $(document).on( "click", ".tm_trash_all", function() {
        confirm_actions(this, 'common/trash_all_ajax', 'Trash all Records', 'Sure to trash all records? To trash only selected records, use the Bulk Action feature.', 'Records trashed successfully');
    });

    //restore trashed record
    $(document).on( "click", ".restore_record", function() {
        confirm_actions(this, 'common/restore_ajax', 'Restore Record', 'Sure to restore this record?', 'Record restored successfully');
    });

    //restore all records
    $(document).on( "click", ".tm_restore_all", function() {
        confirm_actions(this, 'common/restore_all_ajax', 'Restore all Records', 'Sure to restore all records? To restore only selected records, use the Bulk Action feature.', 'Records restored successfully');
    });

    //delete a trashed record permanently
    $(document).on( "click", ".delete_record", function() {
        confirm_actions(this, 'common/delete_ajax', 'Delete Record', 'Sure to delete this record? This action cannot be undone!', 'Record deleted successfully');
    });

    //delete all trashed records permanently
    $(document).on( "click", ".tm_clear_trash", function() {
        confirm_actions(this, 'common/clear_trash_ajax', 'Clear Trash', 'Sure to clear trash? This action cannot be undone! To permanently delete only selected records, use the Bulk Action feature.', 'Trash cleared successfully');
    });


    //bulk action
    var ba_modal = '',
        ba_val = '';
    $(document).on( "change", '[name="ba_option"]', function() {
        var selected = $('[name="ba_option"] option:selected');
        ba_modal = selected.data('modal');
        ba_val = $(this).val();
    });
    $(".ba_apply").click(function(){
        //if trash, restore or delete, use common url to process form
        let ba_mod = $(this).data('mod'),
            ba_md = $(this).data('md'),
            ba_tb = $(this).data('tb'),
            m_title = '',
            m_msg = '';
            //get checked records
            var record_idx = checked_records();
            // console.log('ba record idx', record_idx);
        switch (ba_val) {

            case 'Trash':
                m_title = 'Bulk Trash';
                m_msg = 'Sure to trash the selected records?';
                ajax_post_btn_data('common/bulk_trash_ajax', ba_mod, ba_md, ba_tb, record_idx, 'ba_confirm_btn', 'm_confirm_ba', 'Records trashed successfully');
                break;

            case 'Restore':
                m_title = 'Bulk Restore';
                m_msg = 'Sure to restore the selected records?';
                ajax_post_btn_data('common/bulk_restore_ajax', ba_mod, ba_md, ba_tb, record_idx, 'ba_confirm_btn', 'm_confirm_ba', 'Records trashed successfully');
                break;

            case 'Delete':
                m_title = 'Bulk Delete';
                m_msg = 'Sure to permanently delete the selected records? This action cannot be undone!';
                ajax_post_btn_data('common/bulk_delete_ajax', ba_mod, ba_md, ba_tb, record_idx, 'ba_confirm_btn', 'm_confirm_ba', 'Records trashed successfully');
                break;

        }
        $('#'+ba_modal+ ' .modal-title').text(m_title);
        $('#'+ba_modal+ ' .modal-body .ba_msg').text(m_msg);
        $('#'+ba_modal).modal('show');
    });

    function checked_records() {
        //get checked records
        var record_idx = [];
        $.each($('[name="ba_record_idx[]"]:checked'), function(){
            record_idx.push($(this).val());
        });
        return record_idx;
    }


    //table row options
    $(document).on( "click", ".record_extra_options", function() {
        var id = $(this).data('id');
        var options = $(this).data('options'); 
        var butts = "";
        $.each(options, (i, opt) => {
            butts += modal_option_btn(id, opt.text, opt.type, opt.target, opt.icon);
        });
        $('#m_row_options .modal-title').text('More Options'); 
        $('#m_row_options .modal-body').empty().html(butts); 
        $('#m_row_options').modal('show'); //show the modal
    });


    function modal_option_btn(id, text, type, target, icon) {
        if (type == 'url') {
            const url = base_url + target + '/' + id;
            return '<p><a type="button" href="'+url+'" class="btn btn-outline-primary btn-sm btn-block action-btn"><i class="fa fa-'+icon+'"></i> '+text+'</a></p>';
        } else {
            return '<p><button type="button" data-toggle="modal" data-target="#'+target+'" class="btn btn-outline-primary btn-sm btn-block action-btn"><i class="fa fa-'+icon+'"></i> '+text+'</button></p>';
        }
    }


     //email user
    $(document).on( "click", ".tm_email_user", function() {
        //get data value params
        var title = $(this).data('title'); 
        var email = $(this).data('email');
        $('#modal_email_user .modal-title').text(title); 
        $('#modal_email_user .modal-body #m_user_email').val(email);
        $('#modal_email_user').modal('show'); //show the modal
    });


    //Login via ajax
    const form_url = 'misc/email_user_ajax';
    const success_msg = 'Email sent successfully';
    ajax_post_form('m_email_user_form', form_url, '.status_msg', '', '', success_msg);


    //media
    $(document).on( "click", ".tm_media", function() {
        //get data value params
        var title = $(this).data('title'); 
        var type = $(this).data('type'); 
        var file_exists = $(this).data('file_exists'); 
        $('#modal_media .modal-body').empty(); 
        $('#modal_media .modal-footer').empty(); 
        $('#modal_media .modal-title').text(title); 
        if (file_exists) {
            var file_path = $(this).data('file_path'); 
            var file_index = $(this).data('file_index'); 
            var file_name = $(this).data('file_name'); 
            var download_url = base_url+'misc/download/'+file_index+'/'+file_name; 
            var body; 
            switch (type) {
                case 'img':
                    body = `<img class="img-responsive" src="${file_path}" />`;
                    break;
                case 'pdf':
                    body =  `<div id="doc_area">
                              <object data="${file_path}?#zoom=85&scrollbar=0&toolbar=1navpanes=0" width="100%" height="400">
                                <p class="text-danger text-center">Unable to render PDF document! Check your browser settings or switch to a different browser.</p>
                              </object>
                            </div>`;
                    break;
                default: 
                    body = '<h4 class="text-danger m-b-15">Online media renderer unavailable, download for offline view.</h4>';
                    break;
            }
            $('#modal_media .modal-body').html(body); 
            $('#modal_media .modal-footer').append('<a type="button" class="btn btn-primary f_download"><i class="fa fa-download"></i> Download</a>'); 
            $('#modal_media .modal-footer .f_download').attr('href', download_url); 
        } else {
            $('#modal_media .modal-body').html('<h4 class="text-danger">File not found!</h4>'); 
            $('#modal_media .modal-footer').empty(); 
        }
        $('#modal_media').modal('show'); //show the modal
    });

});
 

