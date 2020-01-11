<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ===== Documentation ===== 
Name: modal_helper
Role: Helper
Description: custom general modals helper
Author: Nwankwo Ikemefuna
Date Created: 22nd June, 2019
Date Modified: 22nd June, 2019
*/ 


/**
 * Template Class: 
 * size - bd-example-modal-lg, bd-example-modal-sm, full-width-modal
 * animation: slide-down|up|right|left|fill-in
 *
 * Dialog: modal-sm, modal-lg
 */
function modal_header($id, $title = '', $xclass = 'fill-in', $xdialog = '') { ?>
    <div class="modal custom fade <?php echo $xclass; ?>" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $id; ?>" aria-hidden="true">
        <div class="modal-dialog <?php echo $xdialog; ?>" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content goes here -->
    <?php        
}

function modal_footer($with_footer = true, $with_btn = false, $btn_id = 'confirm_btn', $btn_text = 'Yes, Continue', $with_close_btn = true, $close_btn_text = 'Cancel') { ?>
                </div><!--/.modal-body-->
                <?php 
                if ($with_footer) { ?>
                    <div class="modal-footer">
                        <?php 
                        if ($with_btn) { 
                            $btn_text .= ' <i class="fa fa-spinner ajax_spinner hide"></i>'; ?>
                            <button class="btn btn-sm btn-warning text-white" role="button" id="<?php echo $btn_id; ?>"><?php echo $btn_text; ?></button>
                            <?php
                        }
                        //close button?
                        if ($with_close_btn) { ?>
                            <button type="button" class="btn btn-dark" data-dismiss="modal"><?php echo $close_btn_text; ?></button>
                            <?php 
                        } ?>
                    </div>
                    <?php 
                } ?>
            </div><!--/.modal-content-->
        </div><!--/.modal-dialog-->
    </div><!--/.modal-->
    <?php        
}