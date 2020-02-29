<?php
$attrs = ['id' => 'forgot_pass_form', 'class' => 'ajax_form material-form', 'data-type' => 'none', 'data-redirect' => '_void', 'data-msg' => "An email has been sent to your email address"];
echo form_open($this->c_controller.'/login_ajax', $attrs);
    xform_group_grid('Email', 'email', 'email', '', true, ['id' => 'email'], ['class' => 'floating-label']);
    xform_notice();
    xform_submit('Recover', $attrs['id'], ['class' => 'btn-theme ripple btn-raised btn-block btn-submit hide']);
echo form_close();
?>
<div class="form-group mt-3 mb-0">
    <div class="text-center form-bottom">
        <p>Don't have an account? <a href="<?php echo base_url('register'); ?>" class="text-theme m-l-5"><b>Sign Up</b></a></p>
    </div>
</div>