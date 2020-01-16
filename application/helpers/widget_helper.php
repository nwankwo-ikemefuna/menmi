<?php 
function grid_col($cols, $position = 'left') {
    $data = [
        1 => ['left' => 'col-12 col-lg-12'],
        2 => ['left' => 'col-12 col-lg-5', 'right' => 'col-12 col-lg-5 offset-lg-2'],
        3 => ['left' => 'col-12 col-lg-4', 'center' => 'col-12 col-lg-4', 'right' => 'col-12 col-lg-4'],
        4 => ['left' => 'col-12 col-lg-3', 'center' => 'col-12 col-lg-3', 'right' => 'col-12 col-lg-3'],
    ];
    return $data[$cols][$position];
}

function bulk_action($options_arr, $record_count = 0, $default_modal = 'm_confirm_ba') {
    if ($record_count == 0) return;
    $ci =& get_instance();
    ?>
    <div class="row m-b-10">
        <div class="col-12 col-lg-4 col-sm-8">
            <h5>Bulk Action (<em>with selected</em>)</h5>
            <div class="input-group">
                <select name="ba_option" class="form-control" style="height: 35px;">
                    <option value="">Select</option>
                    <?php
                    //append trash, restore and delete options
                    if ($ci->trashed == 0) {
                        $options_arr = array_merge($options_arr, ['Trash']);
                    } else {
                        $options_arr = array_merge($options_arr, ['Restore', 'Delete']);
                    }
                    $options = "";
                    foreach ($options_arr as $_key => $vals) {
                        $label = is_array($vals) ? $_key : $vals;
                        //is array?
                        if (is_array($vals)) {
                            $key = $_key;
                            $label = isset($vals['label']) && strlen($vals['label']) ? $vals['label'] : $key;
                            $modal = isset($vals['modal']) && strlen($vals['modal']) ? $vals['modal'] : $default_modal;
                        } else {
                            $key = $label = $vals;
                            $modal = $default_modal;
                        }
                        $options .= '<option value="' . $key . '" data-modal="'.$modal.'">' . $label . '</option>';
                    }
                    echo $options;
                    ?>
                </select>
                <div class="input-group-append">
                    <?php echo tm_confirm('Apply', $ci->module, $ci->model, $ci->table, 'ba_apply btn-lg', '', 'primary', 'Execute bulk action'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function ajax_table($id, $url, $headers, $columns, $col_defs = [], $col_grid = 'col-12', $responsive = true, $head_class = 'thead-default') { ?>
    <div class="row">
        <div class="<?php echo $col_grid; ?> m-b-10">
            <div class="<?php echo $responsive ? 'table-responsive' : ''; ?>">
                <?php echo csrf_hidden_input();
                //data columns and configs
                $cols = [];
                foreach ($columns as $value) {
                    if (is_array($value)) {
                        $cols[] = $value;
                    } else {
                        $cols[] = ['data' => $value];
                    }
                } ?>
                <table class="table ajax_dt_table mb-0" id="<?php echo $id; ?>" data-url="<?php echo $url; ?>" data-cols='<?php echo json_encode($cols); ?>' <?php if (count($col_defs) > 0) { ?> data-col_defs='<?php echo json_encode($col_defs); ?>' <?php } ?> >
                    <thead class="<?php echo $head_class; ?>">
                        <tr>
                            <th style="width: 10px"><?php echo xform_input('', 'checkbox', '', false, ['class' => 'ba_check_all']); ?></th><!-- Select all -->
                            <!-- <th style="width: 20px">#</th> -->
                            <th class="min-w-100">Actions</th>
                            <?php 
                            foreach ($headers as $key => $value) {
                                $name = is_array($value) ? $key : $value;
                                $class = isset($value['class']) && strlen($value['class']) ? $value['class'] : '';
                                echo '<th class="'.$class.'">'.$name.'</th>';
                            } ?>
                            <th class="min-w-150">Created On</th>
                            <th class="min-w-150">Updated On</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php
}

function ajax_table_render($id, $headers, $col_grid = 'col-12', $responsive = true, $head_class = 'thead-default') { ?>
    <div class="row">
        <div class="<?php echo $col_grid; ?> m-b-10">
            <div class="<?php echo $responsive ? 'table-responsive' : ''; ?>">
                <?php echo csrf_hidden_input(); ?>
                <table class="table ajax_dt_table mb-0" id="<?php echo $id; ?>">
                    <thead class="<?php echo $head_class; ?>">
                        <tr>
                            <th style="width: 10px"><?php echo xform_input('', 'checkbox', '', false, ['class' => 'ba_check_all']); ?></th><!-- Select all -->
                            <!-- <th style="width: 20px">#</th> -->
                            <th class="min-w-100">Actions</th>
                            <?php 
                            foreach ($headers as $key => $value) {
                                $name = is_array($value) ? $key : $value;
                                $class = isset($value['class']) && strlen($value['class']) ? $value['class'] : '';
                                echo '<th class="'.$class.'">'.$name.'</th>';
                            } ?>
                            <th class="min-w-150">Created On</th>
                            <th class="min-w-150">Updated On</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php
}

function table_data_collapse($collapse_id, $content, $link_text = 'View details') {
    if ($content === NULL || $content === '') return NULL;
    $collapse = '<a class="underline-link" data-toggle="collapse" href="#'.$collapse_id.'">'.$link_text.'</a>';
    $collapse .= '<div class="collapse m-t-10" id="'.$collapse_id.'">';
    $collapse .= $content;
    $collapse .= '</div>';
    return $collapse;
}

function table_more_data_collapse($collapse_id, $intro, $content, $link_text = 'More details') {
    if ($content === NULL || $content === '') return NULL;
    $collapse = $intro;
    $collapse .= '<br />';
    $collapse .= '<a class="underline-link" data-toggle="collapse" href="#'.$collapse_id.'">'.$link_text.'</a>';
    $collapse .= '<div class="collapse m-t-10" id="'.$collapse_id.'">';
    $collapse .= $content;
    $collapse .= '</div>';
    return $collapse;
}

/* Show more, show less collapsible */
function tc_show_more($content, $show_char = 100) {
    if ($content === NULL || $content === '') return NULL;
    $collapse = '<span class="more" data-show_char="'.$show_char.'">';
    $collapse .= $content;
    $collapse .= '</span>';
    return $collapse;
}