<?php 

function site_meta($page_title = '') { 
    $ci =& get_instance();
    ?>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title><?php echo $page_title; ?> | <?php echo $ci->site_name; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="description" content="<?php echo $ci->site_description; ?>" />
    <meta name="author" content="<?php echo $ci->site_author; ?>"  />
    <meta name="keywords" content="">

    <link rel="shortcut icon" type="image/png" href="<?php echo SITE_FAVICON; ?>" />
    <?php
}
function data_show_list($label, $data) { ?>
    <div class="row m-b-5">
        <div class="<?php echo grid_col(12); ?>">
            <div class="view_label"><?php echo $label; ?>:</div>
            <div class="view_data"><?php echo $data; ?></div>
        </div>
    </div>
    <?php
}

function data_show_grid($label, $data) { ?>
    <div class="row m-b-5">
        <div class="<?php echo grid_col(12, 6, 4, 3); ?>">
            <div class="view_label"><?php echo $label; ?>:</div>
        </div>
        <div class="<?php echo grid_col(12, 6, 8, 9); ?>">
            <div class="view_data"><?php echo $data; ?></div>
        </div>
    </div>
    <?php
}

function view_section_title($title = '', $icon = '', $hr_top = true) { 
    if ($hr_top) echo "<hr />"; ?>
    <h4 class="view_section_title"><i class="<?php echo strlen($icon) ? 'fa fa-'.$icon : ''; ?>"></i> <?php echo $title; ?></h4>
    <?php
}

function bulk_action($options_arr, $record_count = 0, $default_modal = 'm_confirm_ba') {
    /*sample usage 
    
    */
    if (count($options_arr) === 0 || $record_count == 0) return;
    $ci =& get_instance();
    ?>
    <div class="row m-b-10">
        <div class="<?php echo grid_col(12, 8, '', 4); ?>">
            <h5>Bulk Action (<em>with selected</em>) <span id="ba_selected_msg" class="text-danger"></span></h5>
            <div class="input-group">
                <select name="ba_option" class="form-control" style="height: 35px;">
                    <option value="">Select</option>
                    <?php
                    //append trash, restore and delete options
                    if (in_array('delete', $options_arr)) {
                        if ($ci->trashed == 0) {
                            $options_arr = array_merge($options_arr, ['Trash']);
                        } else {
                            $options_arr = array_merge($options_arr, ['Restore', 'Delete']);
                        }
                    }
                    $options = "";
                    foreach ($options_arr as $_key => $vals) {
                        if ($vals == 'delete') continue;
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
                    <?php
                    echo tm_confirm('Apply', $ci->module, $ci->model, $ci->table, 'ba_apply btn-lg', '', 'primary', 'Execute bulk action'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function ajax_table($id, $url, $headers, $columns = [], $extras = [], $col_defs = []) { 
    $custom = empty($columns); //custom or general?
    $responsive = $extras['responsive'] ?? true; 
    $head_class = $extras['head_class'] ?? 'thead-default';
    $extras_arr = [
        'custom' => $extras['custom'] ?? true,
        'checker' => $extras['checker'] ?? true,
        'actions' => $extras['actions'] ?? true,
        'created' => $extras['created'] ?? true,
        'updated' => $extras['updated'] ?? true
    ]; ?>
    <div class="row">
        <div class="<?php echo grid_col(12); ?> m-b-10">
            <div class="<?php echo $responsive ? 'table-responsive' : ''; ?>">
                <?php echo csrf_hidden_input();
                //data columns and configs
                $cols = [];
                if (count($columns) > 0) {
                    foreach ($columns as $value) {
                        if (is_array($value)) {
                            $cols[] = $value;
                        } else {
                            $cols[] = ['data' => $value];
                        }
                    } 
                } ?>
                <table 
                    class="table ajax_dt_table mb-0" 
                    id="<?php echo $id; ?>" 
                    data-url="<?php echo $url; ?>" 
                    <?php if ( ! $custom) { ?> data-cols='<?php echo json_encode($cols); ?>' <?php } ?> 
                    <?php if (count($col_defs) > 0) { ?> data-col_defs='<?php echo json_encode($col_defs); ?>' <?php } ?>
                    data-extras='<?php echo json_encode($extras_arr); ?>' 
                    data-custom='<?php echo json_encode($custom); ?>'>
                    <thead class="<?php echo $head_class; ?>">
                        <tr>
                            <?php if ($extras_arr['checker']) { ?>
                                <th style="width: 10px"><?php echo xform_input('', 'checkbox', '', false, ['class' => 'ba_check_all']); ?></th>
                                <?php 
                            } ?>
                            <?php if ($extras_arr['actions']) { ?>
                                <th class="min-w-100">Actions</th>
                                <?php 
                            } ?>
                            <?php 
                            foreach ($headers as $key => $value) {
                                $name = is_array($value) ? $key : $value;
                                $class = isset($value['class']) && strlen($value['class']) ? $value['class'] : '';
                                echo '<th class="'.$class.'">'.$name.'</th>';
                            } ?>
                            <?php if ($extras_arr['created']) { ?>
                                <th class="min-w-200">Created On</th>
                                <?php 
                            } ?>
                            <?php if ($extras_arr['updated']) { ?>
                                <th class="min-w-200">Updated On</th>
                                <?php 
                            } ?>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php
}

function sidebar_menu($name, $url, $icon = 'cube', $title = '', $target = '') { ?>
    <li class="nav-item">
        <a href="<?php echo base_url($url); ?>" title="<?php echo strlen($title) ? $title : $name; ?>" target="<?php echo $target; ?>">
            <i class="fa fa-<?php echo $icon; ?>" aria-hidden="true"></i>
            <span><?php echo $name; ?></span>
        </a>
    </li>
    <?php
}

function sidebar_menu_auth($module, $right, $usergroups = null, $name, $url, $icon = 'cube', $title = '', $target = '') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, $right, $usergroups)) { 
        sidebar_menu($name, $url, $icon, $title, $target);
    }
}

function sidebar_menu_parent($name, $children = [], $icon = 'cube', $title = '') { ?>
    <li class="nav-item has-child">
        <a href="javascript:void(0);" class="ripple" title="<?php echo strlen($title) ? $title : $name; ?>">
            <i class="fa fa-<?php echo $icon; ?>" aria-hidden="true"></i>
            <span><?php echo $name; ?></span>
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
        </a>
        <ul class="nav child-menu">
            <?php 
            foreach ($children as $child_name => $child_url) { ?>
                <li><a href="<?php echo base_url($child_url); ?>"><?php echo $child_name; ?></a></li>
                <?php
            } ?>
        </ul>
    </li>
    <?php
}

function sidebar_menu_parent_auth($module, $right, $usergroups = null, $name, $children = [], $icon = 'cube', $title = '') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, $right, $usergroups)) { 
        sidebar_menu_parent($name, $children, $icon, $title);
    }
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