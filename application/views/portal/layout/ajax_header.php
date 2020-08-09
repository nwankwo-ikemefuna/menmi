<!-- page content -->
<div class="main-content small-gutter" role="main">
    <div class="row bg-title clearfix page-title">
        <div class="<?php echo grid_col(12, '', 9); ?>">
            <h4 class="page-title">
                <?php echo $page_title;
                if ((bool) $this->trashed) {
                    echo '<span class="text-danger"> [Trashed]</span>'; 
                } ?>
            </h4>
        </div>
        <?php
        //record count [with max data]
        if (strlen($record_count)) {
            $_affix = intval($record_count) === 1 ? '' : 's'; ?>
            <div class="<?php echo grid_col(12, '', 3); ?>">
                <h4 class="page-title float-md-right">
                    <?php
                    echo number_format(intval($record_count)) . ' record' . $_affix . (strlen($max_data) && $max_data != -1 ? ' <small class="text-danger">(max: '.number_format(intval($max_data)).')</small>' : ''); ?>
                </h4>
            </div>
            <?php
        } ?>
    </div>
    
    <?php 
    //crud buttons not empty?
    if (is_array($this->butts) && !empty($this->butts)) { ?>
        <div class="row page_buttons">
            <div class="<?php echo grid_col(12); ?>">
                <div class="pull-left">
                    <?php echo page_crud_butts($this->module, null, $this->butts, $crud_rec_id, $record_count); ?>
                </div>
            </div>
        </div>
        <?php 
    } ?>
    
    <div class="row m-t-15">
        <div class="<?php echo grid_col(12); ?> m-b-10">
            <div class="bg-white padding-25 h-100">
                <div class="m-t-10">
                    <?php
                    //flash messages
                    flash_message('info_msg', 'info');
                    flash_message('success_msg', 'success');
                    flash_message('error_msg', 'danger'); 
                    ?>
                </div>

                <?php 
                //bulk action options
                if (is_array($this->ba_opts) && !empty($this->ba_opts)) 
                    bulk_action($this->ba_opts, $record_count);