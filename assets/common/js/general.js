jQuery(document).ready(function ($) {
    "use strict";  

    //auto-close flashdata alert boxes
    $(".alert-dismissable.auto_dismiss").delay(10000).fadeOut('slow', function() {
        $(this).alert('close');
    });

    //select picker
    $('.selectpicker').selectpicker({
        liveSearch: true
    });


    var req_attr = $('input.form-control').attr('required');
	if (typeof req_attr !== typeof undefined && req_attr !== false) {
	    $('input.form-control').css('border-color', '#f2f2f2');
	    $(this).focusout(function(){
	    	if ($(this).val() == '') {
	    		$(this).css('border-color', '#eb7374');
	    	} 
	    });
	    $(document).on('input', 'input.form-control', function(){
	    	if ($(this).val() !== '') {
	    		$(this).css('border-color', '#f2f2f2');
	    	} 
	    });
	}

	//bulk action: disable action button if no bulk action type is selected
    $('[name="ba_option"]').change(function () {
    	$('.ba_apply').removeClass('hide');
        $('.ba_apply').prop('disabled', ! Boolean($(this).val()));
    });
    
    //bulk action: select all checkbox items if select all is checked
    $('.ba_check_all').change(function(){  //"select all" change 
        $('.ba_record').prop('checked', $(this).prop('checked'));//change all ".checkbox" checked status
    });
    
    //".checkbox" change 
    $('.ba_record').change(function(){ 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(false == $(this).prop('checked')){ //if this item is unchecked
            $('.ba_check_all').prop('checked', false); //change "select all" checked status to false
        }
        //check "select all" if all checkbox items are checked
        if ($('.ba_record:checked').length == $('.checkbox').length ){
            $('.ba_check_all').prop('checked', true);
        }
    });


});