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
                $redirect_url = $this->session->login_redirect ? $this->session->requested_page : base_url('user');
                $attrs = ['id' => 'login_form', 'class' => 'ajax_form material-form', 'data-type' => 'redirect', 'data-redirect' => $redirect_url, 'data-msg' => "Login successful. Redirecting... <p>If you are not automatically redirected, <a href='{$redirect_url}'>click here</a></p>"];
                $fields = [
                    ['name' => 'email', 'type' => 'email', 'label' => 'Email', 'extra' => ['id' => 'email'], 'label_extra' => ['class' => 'floating-label']],
                    ['name' => 'password', 'type' => 'password', 'label' => 'Password', 'extra' => ['id' => 'password'], 'label_extra' => ['class' => 'floating-label']]
                ];
                xform($this->c_controller.'/login_ajax', $fields, $attrs, 'grid', 'Login', $attrs['id'], ['class' => 'btn-theme ripple btn-raised btn-block btn-submit']); ?>
            </div>
        </div>
    </div>
</div>