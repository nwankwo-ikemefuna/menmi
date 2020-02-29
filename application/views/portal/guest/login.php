<?php
$redirect_url = $this->session->login_redirect ? $this->session->requested_page : base_url('user');
$attrs = ['id' => 'login_form', 'class' => 'ajax_form material-form', 'data-type' => 'redirect', 'data-redirect' => $redirect_url, 'data-msg' => "Login successful. Redirecting... <p>If you are not automatically redirected, <a href='{$redirect_url}'>click here</a></p>"];
echo form_open($this->c_controller.'/login_ajax', $attrs);
    xform_group_grid('Email', 'email', 'email', '', true, ['id' => 'email'], ['class' => 'floating-label']);
    xform_group_grid('Password', 'password', 'password', '', true, ['id' => 'password'], ['class' => 'floating-label']);
    xform_notice();
    xform_submit('Login', $attrs['id'], ['class' => 'btn-theme ripple btn-raised btn-block btn-submit']);
echo form_close();
?>
<div class="form-group mt-3 mb-0">
    <div class="text-center form-bottom">
        <p>Don't have an account? <a href="<?php echo base_url('register'); ?>" class="text-theme m-l-5"><b>Sign Up</b></a></p>
    </div>
</div>