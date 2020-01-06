jQuery(document).ready(function ($) {
    "use strict";  

    //Login
    var redirect_url = $('[name="requested_page"]').val();
    var success_msg = 'Login successful. Redirecting... <p>If you are not automatically redirected, <a href="' + redirect_url + '">click here</a></p> ';
    ajax_post_form('login_form', c_controller+'/login_ajax', redirect_url, success_msg);
}); 