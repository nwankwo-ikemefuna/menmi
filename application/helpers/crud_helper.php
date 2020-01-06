<?php 

function data_attrs($keys) {
    $data_attr = "";
    foreach ($keys as $key => $attr) {
        $key += 1;
        $data_attr .= 'data-'.$attr.'="$'.$key.'" ';
    }
    return $data_attr;
}

function ajax_view_btn($module, $usergroups = null, $offset = 1, $with_text = false, $icon = 'eye') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $url = base_url($ci->c_controller.'/view/$'.$offset);
        $text = $with_text ? 'View' : '';
        return '<a type="button" href="'.$url.'" class="btn btn-primary text-white ajax_crud_btn" title="View record"><i class="fa fa-'.$icon.'"></i> '.$text.'</a>';
    }
}

function ajax_view_btn_modal($module, $usergroups = null, $keys, $with_text = false, $icon = 'eye') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $data_attr = data_attrs($keys);
        $text = $with_text ? 'View' : '';
        return '<button type="button" class="view_record btn btn-primary ajax_crud_btn" '.$data_attr.'  title="View record"><i class="fa fa-'.$icon.'"></i> '.$text.'</button>';
    }
}

function ajax_edit_btn($module, $usergroups = null, $offset = 1, $with_text = false, $icon = 'edit') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, EDIT, $usergroups)) { 
        $url = base_url($ci->c_controller.'/edit/$'.$offset);
        $text = $with_text ? 'Edit' : '';
        return '<a type="button" href="'.$url.'" class="btn btn-info text-white ajax_crud_btn" title="Edit record"><i class="fa fa-'.$icon.'"></i> '.$text.'</a>';
    }
}

function ajax_edit_btn_modal($module, $usergroups = null, $keys, $with_text = false, $icon = 'edit') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, EDIT, $usergroups)) { 
        $data_attr = data_attrs($keys);
        $text = $with_text ? 'Edit' : '';
        return '<button type="button" class="edit_record btn btn-info ajax_crud_btn" '.$data_attr.'  title="Edit record"><i class="fa fa-'.$icon.'"></i> '.$text.'</button>';
    }
}

function ajax_trash_btn($module, $model, $usergroups = null, $table, $offset = 1, $with_text = false, $icon = 'trash') {
    $ci =& get_instance();
    $has_access = $ci->auth->vet_access($module, DEL, $usergroups);
    if ($has_access) { 
        $text = $with_text ? 'Trash' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$table.'" data-id="$'.$offset.'" class="trash_record btn btn-warning ajax_crud_btn" title="Trash record"><i class="fa fa-'.$icon.'"></i> '.$text.'</button>';
    }
}

function ajax_restore_btn($module, $model, $usergroups = null, $table, $offset = 1, $with_text = false, $icon = 'refresh') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
        $text = $with_text ? 'Restore' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$table.'" data-id="$'.$offset.'" class="restore_record btn btn-success ajax_crud_btn" title="Restore record"><i class="fa fa-'.$icon.'"></i> '.$text.'</button>';
    }
}

function ajax_del_btn($module, $model, $usergroups = null, $table, $offset = 1, $with_text = false, $icon = 'trash') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
        $text = $with_text ? 'Delete' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$table.'" data-id="$'.$offset.'" class="delete_record btn btn-danger ajax_crud_btn" title="Delete record permanently"><i class="fa fa-'.$icon.'"></i> '.$text.'</button>';
    }
}

function ajax_extra_options_btn($module, $usergroups = null, $options_arr, $offset = 1, $with_text = false, $icon = 'navicon') {
    if ( ! is_array($options_arr) || count($options_arr) === 0)  return null;
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $_options = [];
        foreach ($options_arr as $_opt) {
            if (isset($_opt['url']) && strlen($_opt['url']) ) {
                $type = 'url';
                $target = $_opt['url'];
            } elseif (isset($_opt['modal']) && strlen($_opt['modal'])) {
                $type = 'modal';
                $target = $_opt['modal'];
            } else {
                $type = '';
                $target = '';
            }
            $_options[] = [
                'type' => $type,
                'target' => $target,
                'text' => isset($_opt['text']) && strlen($_opt['text']) ? $_opt['text'] : null,
                'icon' => isset($_opt['icon']) && strlen($_opt['icon']) ? $_opt['icon'] : 'indent'
            ];
        }
        $options = json_encode($_options);
        $text = $with_text ? 'Options' : '';
        $offset = '$'.$offset;
        return "<button type='button' data-id='{$offset}' data-options='$options' class='record_extra_options btn btn-primary ajax_crud_btn' title='More Options'><i class='fa fa-{$icon}'></i> {$text}</button>";
    }
}

function table_crud_butts($module, $model, $usergroups, $table, $trashed, $keys, $show = [], $offset = 1, $with_text = false) {
    if (intval($trashed) == 1) {
        // restore and delete permanently for trashed pages
        // will always show on trashed list
        return  ajax_restore_btn($module, $model, $usergroups, $table, $offset, $with_text, 'refresh') . ' ' . 
                ajax_del_btn($module, $model, $usergroups, $table, $offset, $with_text, 'trash-o'); 
    }
    $butts = "";
    $isset_show = isset($show) && is_array($show);
    //view
    if ($isset_show && array_key_exists('view', $show)) {
        $type = _crud_butt_param($show, 'view', 'type', 'url');
        $icon = _crud_butt_param($show, 'view', 'icon', 'eye');
        if ($type == 'url') {
            $butts .= ajax_view_btn($module, $usergroups, $offset, $with_text, $icon) . ' ';
        } else { //modal
            $butts .= ajax_view_btn_modal($module, $usergroups, $keys, $with_text, $icon) . ' '; 
        }
    }
    //edit
    if ($isset_show && array_key_exists('edit', $show)) {
        $type = _crud_butt_param($show, 'edit', 'type', 'url');
        $icon = _crud_butt_param($show, 'edit', 'icon', 'edit');
        if ($type == 'url') {
            $butts .= ajax_edit_btn($module, $usergroups, $offset, $with_text, $icon) . ' ';
        } else { //modal
            $butts .= ajax_edit_btn_modal($module, $usergroups, $keys, $with_text, $icon) . ' '; 
        }
    }
    //trash: will always show on untrashed list
    $butts .=   ajax_trash_btn($module, $model, $usergroups, $table, $offset, $with_text, 'trash') . ' ';
    //extra options
    if ($isset_show && array_key_exists('extra', $show)) {
        $icon = _crud_butt_param($show, 'extra', 'icon', 'navicon');
        $options = _crud_butt_param($show, 'extra', 'options', []);
        $butts .= ajax_extra_options_btn($module, $usergroups, $options, $offset, $with_text, $icon) . ' ';
    }
    //vomit
    return $butts;
}

function _crud_butt_param($show, $type, $key, $default) {
    return is_array($show[$type]) && isset($show[$type][$key]) && ! empty($show[$type][$key]) ? $show[$type][$key] : $default;
}

function link_button($text, $url, $icon = '', $bg = 'primary', $title = '', $full_url = false) {
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    $url = $full_url ? $url : base_url($url);
    return '<a class="btn btn-'.$bg.'" href="'.$url.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$text.'</a>';
}

function save_button($text, $form_id, $icon = 'save', $bg = 'primary', $title = '') {
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    return '<button type="submit" form="'.$form_id.'" class="btn btn-'.$bg.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$text.'</button>';
}

function modal_button($text, $target, $icon = '', $bg = 'primary', $title = '', $class = '') {
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    return '<button class="btn btn-'.$bg.' '.$class.'" data-toggle="modal" data-target="#'.$target.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$text.'</button>';
}

function tm_confirm($text, $module, $model, $table, $class = 'tm_confirm', $icon = '', $bg = 'primary', $title = '') {
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    return '<button class="btn btn-'.$bg.' '.$class.'" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$table.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$text.'</button>';
}

function page_crud_butts($module, $usergroups, $butts, $record_id = null, $record_count = 0) {
    $ci =& get_instance();

    //refresh button to be appended
    $current_url = current_url() . (strlen($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
    $refresh_btn = link_button('Refresh', $current_url, 'refresh', 'primary', 'Reload page', true);

    $buttons = [];
    foreach ($butts as $_key => $butt) {

        //is array?
        $key = is_array($butt) ? $_key : $butt;

        //url/target
        $isset_url = is_array($butt) && isset($butt['url']) && !empty($butt['url']);
        $isset_modal = is_array($butt) && isset($butt['modal']) && !empty($butt['modal']);
        $isset_form = is_array($butt) && isset($butt['form']) && !empty($butt['form']);
        //icon
        $isset_icon = is_array($butt) && isset($butt['icon']) && !empty($butt['icon']);
        //bg color
        $bg = (is_array($butt) && isset($butt['bg']) && !empty($butt['bg'])) ? $butt['bg'] : 'primary';

        switch ($key) {

            //List:
            case 'list':
                $btn = '';
                if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
                    //trashed records?
                    if ($ci->trashed == 1) {
                        $url = $isset_url ? $butt['url'] : $ci->c_controller;
                        $icon = $isset_icon ? $butt['icon'] : 'list';
                        $btn = link_button('List', $url, $icon, $bg, 'Go to record list');
                        $clear_all_btn = '';
                        $restore_all_btn = '';
                        if ($record_count > 0) {
                            $clear_all_btn = tm_confirm('Clear All', $ci->module, $ci->model, $ci->table, 'tm_clear_trash', 'trash-o', 'danger', 'Empty trash');
                            $restore_all_btn = tm_confirm('Restore All', $ci->module, $ci->model, $ci->table, 'tm_restore_all', 'refresh', 'success', 'Restore all records');
                        }
                        //return early, cos we don't need to show other buttons
                        return $btn . ' ' . $refresh_btn . ' ' . $clear_all_btn . ' ' . $restore_all_btn;
                    } else {
                        $query_string = '?trashed=1';
                        $url = $isset_url ? $butt['url'].$query_string : $ci->c_controller.$query_string;
                        $icon = $isset_icon ? $butt['icon'] : 'trash';
                        $btn = link_button('Trashed', $url, $icon, $bg, 'View trashed records');
                    }
                }
                break;

            //View:
            case 'view':
                $btn = '';
                if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
                    $url = $isset_url ? $butt['url'] : $ci->c_controller.'/view/'.$record_id;
                    $icon = $isset_icon ? $butt['icon'] : 'eye';
                    $btn = link_button('View', $url, $icon, $bg, 'View this record');
                }
                break;

            //Add: url
            case 'add':
                $btn = '';
                if ($ci->auth->vet_access($module, ADD, $usergroups)) { 
                    $url = $isset_url ? $butt['url'] : $ci->c_controller.'/add';
                    $icon = $isset_icon ? $butt['icon'] : 'plus';
                    $btn = link_button('Add', $url, $icon, $bg, 'Add new record');
                }
                break;

            //Add: modal
            case 'add_m':
                $btn = '';
                if ($ci->auth->vet_access($module, ADD, $usergroups)) { 
                    $modal = $isset_modal ? $butt['modal'] : 'm_add';
                    $icon = $isset_icon ? $butt['icon'] : 'plus';
                    $btn = modal_button('Add', $modal, $icon, $bg, 'Add new record');
                }
                break;

            //Edit:
            case 'edit':
                $btn = '';
                if ($ci->auth->vet_access($module, EDIT, $usergroups)) { 
                    $url = $isset_url ? $butt['url'] : $ci->c_controller.'/edit/'.$record_id;
                    $icon = $isset_icon ? $butt['icon'] : 'edit';
                    $btn = link_button('Edit', $url, $icon, $bg, 'Edit this record');
                }
                break;

            //Save:
            case 'save':
                $form_id = $isset_form ? $butt['form'] : 'save';
                $icon = $isset_icon ? $butt['icon'] : 'save';
                $btn = save_button('Save', $form_id, $icon, $bg, 'Save changes');
                break;

            //Delete: modal
            case 'del':
                $btn = '';
                if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
                    $modal = $isset_modal ? $butt['modal'] : $ci->c_controller.'/delete/'.$record_id;
                    $icon = $isset_icon ? $butt['icon'] : 'trash';
                    $btn = modal_button('Delete', $modal, $icon, 'danger', 'Delete this record');
                }
                break;

            //Extra:
            case 'extra':
                $btn = '';
                if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
                    $_butts = [];
                    $options_arr = $butt;
                    if (is_array($options_arr) && count($options_arr) > 0)  {
                        foreach ($options_arr as $_opt) {
                            $text = isset($_opt['text']) && strlen($_opt['text']) ? $_opt['text'] : null;
                            $icon = isset($_opt['icon']) && strlen($_opt['icon']) ? $_opt['icon'] : 'indent';
                            if (isset($_opt['url']) && strlen($_opt['url']) ) {
                                $btn .= link_button($text, $_opt['url'], $icon, $bg) . ' ';
                            } else {
                                $modal = isset($_opt['modal']) && strlen($_opt['modal']) ? $_opt['modal'] : '';
                                $btn .= modal_button($text, $modal, $icon, $bg) . ' ';
                            }
                        }
                    }
                }
                break;
            
            default:
                $btn = '';
                break;
        }
        $buttons[] = $btn;
    } 
    $trash_all_btn = "";
    if ($record_count > 0) {
        $trash_all_btn = tm_confirm('Trash All', $ci->module, $ci->model, $ci->table, 'tm_trash_all', 'trash', 'warning', 'Trash all records');
    }
    //append other button
    $buttons[] = $refresh_btn;
    $buttons[] = $trash_all_btn;
    return join(" ", $buttons); 
}