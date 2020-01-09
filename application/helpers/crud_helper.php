<?php 

function ajax_data_keys($keys) {
    $data = [];
    foreach ($keys as $key) {
        $data[] = ['data' => $key];
    }
    return json_encode($data);
}

function data_attrs($keys) {
    $data_attr = "";
    foreach ($keys as $key => $attr) {
        $key += 1;
        $data_attr .= 'data-'.$attr.'="$'.$key.'" ';
    }
    return $data_attr;
}

function ajax_view_btn($module, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $text = $params['with_text'] ? 'View' : '';
        return '<a type="button" href="'.base_url($params['url']).'" class="btn btn-primary text-white ajax_crud_btn" title="View record"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</a>';
    }
}

function ajax_view_btn_modal($module, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $data_attr = data_attrs($params['keys']);
        $text = $params['with_text'] ? 'View' : '';
        return '<button type="button" class="view_record btn btn-primary ajax_crud_btn" '.$data_attr.' data-x_modal="'.$modal.'" title="View record"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function ajax_edit_btn($module, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, EDIT, $usergroups)) { 
        $text = $params['with_text'] ? 'Edit' : '';
        return '<a type="button" href="'.base_url($params['url']).'" class="btn btn-info text-white ajax_crud_btn" title="Edit record"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</a>';
    }
}

function ajax_edit_btn_modal($module, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, EDIT, $usergroups)) { 
        $data_attr = data_attrs($params['keys']);
        $text = $params['with_text'] ? 'Edit' : '';
        return '<button type="button" class="edit_record btn btn-info ajax_crud_btn" '.$data_attr.' data-x_modal="'.$params['modal'].'" data-x_form_id="'.$params['form_id'].'" title="Edit record"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function ajax_trash_btn($module, $model, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
        $text = $params['with_text'] ? 'Trash' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$params['table'].'" data-id="$'.$params['offset'].'" class="trash_record btn btn-warning ajax_crud_btn" title="Trash record"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function ajax_restore_btn($module, $model, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
        $text = $params['with_text'] ? 'Restore' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$params['table'].'" data-id="$'.$params['offset'].'" class="restore_record btn btn-success ajax_crud_btn" title="Restore record"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function ajax_del_btn($module, $model, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
        $text = $params['with_text'] ? 'Delete' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$params['table'].'" data-id="$'.$params['offset'].'" class="delete_record btn btn-danger ajax_crud_btn" title="Delete record permanently"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function ajax_extra_options_btn($module, $usergroups = null, $params) {
    if ( ! is_array($params['options']) || count($params['options']) === 0)  return null;
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $_options = [];
        foreach ($params['options'] as $_opt) {
            $type = isset($_opt['type']) && strlen($_opt['type']) ? $_opt['type'] : 'url';
            $target = isset($_opt['target']) && strlen($_opt['target']) ? $_opt['target'] : '#!';
            $_options[] = [
                'type' => $type,
                'target' => $target,
                'text' => isset($_opt['text']) && strlen($_opt['text']) ? $_opt['text'] : null,
                'icon' => isset($_opt['icon']) && strlen($_opt['icon']) ? $_opt['icon'] : 'indent'
            ];
        }
        $options = json_encode($_options);
        $text = $params['with_text'] ? 'Options' : '';
        $offset = '$'.$params['offset'];
        $icon = $params['icon'];
        return "<button type='button' data-id='{$offset}' data-options='$options' class='record_extra_options btn btn-primary ajax_crud_btn' title='More Options'><i class='fa fa-{$icon}'></i> {$text}</button>";
    }
}

function table_crud_butts($module, $model, $usergroups, $table, $trashed, $keys, $show = [], $offset = 1, $with_text = false) {
    $ci =& get_instance();
    if (intval($trashed) == 1) {
        // restore and delete permanently for trashed pages
        // will always show on trashed list
        return  ajax_restore_btn($module, $model, $usergroups, ['table' => $table, 'offset' => $offset, 'with_text' => $with_text, 'icon' => 'refresh']) . ' ' . 
                ajax_del_btn($module, $model, $usergroups, ['table' => $table, 'offset' => $offset, 'with_text' => $with_text, 'icon' => 'trash-o']); 
    }
    $butts = "";
    $isset_show = isset($show) && is_array($show);
    //view
    if ($isset_show && array_key_exists('view', $show)) {
        $type = _crud_butt_param($show, 'view', 'type', 'url');
        $icon = _crud_butt_param($show, 'view', 'icon', 'eye');
        if ($type == 'url') {
            $url = _crud_butt_param($show, 'view', 'url', $ci->c_controller.'/view/$'.$offset);
            $butts .= ajax_view_btn($module, $usergroups, ['url' => $url, 'with_text' => $with_text, 'icon' => $icon]) . ' ';
        } else { //modal
            $modal = _crud_butt_param($show, 'view', 'modal', 'm_view');
            $butts .= ajax_view_btn_modal($module, $usergroups, ['keys' => $keys, 'modal' => $modal, 'with_text' => $with_text, 'icon' => $icon]) . ' '; 
        }
    }
    //edit
    if ($isset_show && array_key_exists('edit', $show)) {
        $type = _crud_butt_param($show, 'edit', 'type', 'url');
        $icon = _crud_butt_param($show, 'edit', 'icon', 'edit');
        if ($type == 'url') {
            $url = _crud_butt_param($show, 'edit', 'url', $ci->c_controller.'/edit/$'.$offset);
            $butts .= ajax_edit_btn($module, $usergroups, ['url' => $url, 'with_text' => $with_text, 'icon' => $icon]) . ' ';
        } else { //modal
            $modal = _crud_butt_param($show, 'edit', 'modal', 'm_edit');
            $form_id = _crud_butt_param($show, 'edit', 'form_id', 'edit_form');
            $form_action = _crud_butt_param($show, 'edit', 'form_action', base_url($ci->c_controller.'/edit_ajax'));
            $butts .= ajax_edit_btn_modal($module, $usergroups, ['keys' => $keys, 'modal' => $modal, 'form_id' => $form_id, 'form_action' => $form_action, 'with_text' => $with_text, 'icon' => $icon]) . ' '; 
        }
    }
    //trash: will always show on untrashed list
    $butts .=   ajax_trash_btn($module, $model, $usergroups, ['table' => $table, 'offset' => $offset, 'with_text' => $with_text, 'icon' => 'trash']) . ' ';
    //extra options
    if ($isset_show && array_key_exists('extra', $show)) {
        $icon = _crud_butt_param($show, 'extra', 'icon', 'navicon');
        $options = _crud_butt_param($show, 'extra', 'options', []);
        $butts .= ajax_extra_options_btn($module, $usergroups, ['options' => $options, 'offset' => $offset, 'with_text' => $with_text, 'icon' => $icon]) . ' ';
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
        //url
        $isset_url = is_array($butt) && isset($butt['url']) && !empty($butt['url']);
        //modal
        $isset_modal = is_array($butt) && isset($butt['modal']) && !empty($butt['modal']);
        //form
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
                    $url = $isset_url ? $butt['url'] : $ci->c_controller;
                    $icon = $isset_icon ? $butt['icon'] : 'list';
                    $btn = link_button('List', $url, $icon, $bg, 'Go to record list');
                    //trashed records?
                    if ($ci->trashed == 1) {
                        
                        $clear_all_btn = '';
                        $restore_all_btn = '';
                        if ($ci->page == 'index' && $record_count > 0) {
                            $clear_all_btn = tm_confirm('Clear All', $ci->module, $ci->model, $ci->table, 'tm_clear_trash', 'trash-o', 'danger', 'Empty trash');
                            $restore_all_btn = tm_confirm('Restore All', $ci->module, $ci->model, $ci->table, 'tm_restore_all', 'refresh', 'success', 'Restore all records');
                        }
                        //return early, cos we don't need to show other buttons
                        return $btn . ' ' . $refresh_btn . ' ' . $clear_all_btn . ' ' . $restore_all_btn;
                    } else {
                        if ($ci->page == 'index') {
                            $query_string = '?trashed=1';
                            $url = $isset_url ? $butt['url'].$query_string : $ci->c_controller.$query_string;
                            $icon = $isset_icon ? $butt['icon'] : 'trash';
                            $btn = link_button('Trashed', $url, $icon, $bg, 'View trashed records');
                        } else {
                            $btn = $btn;
                        }
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
                            $type = isset($_opt['type']) && strlen($_opt['type']) ? $_opt['type'] : 'url';
                            $target = isset($_opt['target']) && strlen($_opt['target']) ? $_opt['target'] : '#!';
                            $text = isset($_opt['text']) && strlen($_opt['text']) ? $_opt['text'] : null;
                            $icon = isset($_opt['icon']) && strlen($_opt['icon']) ? $_opt['icon'] : 'indent';
                            if ($type == 'url') {
                                $btn .= link_button($text, $_opt['target'], $icon, $bg) . ' ';
                            } else {
                                $btn .= modal_button($text, $target, $icon, $bg) . ' ';
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
    if ($ci->page == 'index' && $record_count > 0) {
        $trash_all_btn = tm_confirm('Trash All', $ci->module, $ci->model, $ci->table, 'tm_trash_all', 'trash', 'warning', 'Trash all records');
    }
    //append other button
    $buttons[] = $refresh_btn;
    $buttons[] = $trash_all_btn;
    return join(" ", $buttons); 
}