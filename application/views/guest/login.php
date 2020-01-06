<div class="main-container login-register">
    <div class="d-flex justify-content-center h-100vh w-100 align-items-center">
        <div class="login-container">
            <div class="text-center site_title">
                <a href="<?php echo base_url(); ?>" class="text-white">
                    <h5><?php echo $this->site_name; ?></h5>
                </a>
            </div>
            <div class="form-container">
                <?php echo flash_message('success_msg'); ?>
                <?php echo flash_message('error_msg', 'danger'); ?>
                <h4 class="text-center">Login</h4>
                <?php
                $attrs = ["id" => "login_form", "class" => "material-form"];
                echo form_open(null, $attrs);
                    $this->auth->requested_page_input();
                    form_group_input('Email', 'email', 'email', '', '', 'floating-label', 'email');
                    form_group_input('Password', 'password', 'password', '', '', 'floating-label', 'password');
                    form_notice();
                    form_submit('Login', '', 'btn-theme ripple btn-raised btn-block btn-submit');
                echo form_close(); ?>
            </div>
        </div>
    </div>
</div>