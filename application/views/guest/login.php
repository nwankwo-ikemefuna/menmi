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
                $this->auth->requested_page_input();
                $attrs = ['id' => 'login_form', 'class' => 'ajax_form material-form'];
                $fields = [
                    ['name' => 'email', 'type' => 'email', 'extra' => ['id' => 'email'], 'label_extra' => ['class' => 'floating-label']],
                    ['name' => 'password', 'type' => 'password', 'extra' => ['id' => 'password'], 'label_extra' => ['class' => 'floating-label']]
                ];
                xform($this->c_controller.'/login_ajax', $fields, $attrs, 'Login', $attrs['id'], ['class' => 'btn-theme ripple btn-raised btn-block btn-submit']); ?>
            </div>
        </div>
    </div>
</div>