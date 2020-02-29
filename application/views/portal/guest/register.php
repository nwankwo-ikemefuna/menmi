<?php
$redirect_url = base_url('login');
$attrs = ['id' => 'register_form', 'class' => 'ajax_form material-form', 'data-type' => 'redirect', 'data-redirect' => $redirect_url, 'data-msg' => "Registration successful. Redirecting... <p>If you are not automatically redirected, <a href='{$redirect_url}'>click here</a></p>"];
echo form_open($this->c_controller.'/customer_register_ajax', $attrs);
    xform_group_grid('First Name', 'first_name', 'text', '', true, ['id' => 'first_name'], ['class' => 'floating-label']);
    xform_group_grid('Last Name', 'last_name', 'text', '', true, ['id' => 'last_name'], ['class' => 'floating-label']);
    xform_group_grid('Email', 'email', 'email', '', true, ['id' => 'email'], ['class' => 'floating-label']);
    xform_group_grid('Phone No.', 'phone', 'number', '', true, ['id' => 'phone'], ['class' => 'floating-label']);
    xform_group_grid('Password', 'password', 'password', '', true, ['id' => 'password'], ['class' => 'floating-label']);
    xform_group_grid('Confirm Password', 'c_password', 'password', '', true, ['id' => 'c_password'], ['class' => 'floating-label']);
    xform_notice();
    xform_submit('Sign Up', $attrs['id'], ['class' => 'btn-theme ripple btn-raised btn-block btn-submit']);
echo form_close();
?>
<div class="form-group mt-3 mb-0">
    <div class="text-center form-bottom">
        <p>Already have an account? <a href="<?php echo base_url('login'); ?>" class="text-theme m-l-5"><b>Sign In</b></a></p>
    </div>
</div>