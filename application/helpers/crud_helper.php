<?php 

function mod_view_page($id = '', $page = 'view') {
    $ci =& get_instance();
    return $ci->c_controller.'/'.$page.'/'.$id;
}

function mod_edit_page($id = '', $page = 'edit') {
    $ci =& get_instance();
    return $ci->c_controller.'/'.$page.'/'.$id;
}

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
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$params['table'].'" data-id="$'.$params['offset'].'" data-cmm="'.$params['cmm'].'" data-files=\''.$params['files'].'\' class="delete_record btn btn-danger ajax_crud_btn" title="Delete record permanently"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function ajax_extra_options_btn($module, $usergroups = null, $params) {
    if ( ! is_array($params['options']) || count($params['options']) === 0)  return null;
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
        $_options = [];
        foreach ($params['options'] as $_opt) {
            $type = $_opt['type'] ?? 'url';
            $target = $_opt['target'] ?? '#!';
            $_options[] = [
                'type' => $type,
                'target' => $target,
                'text' => $_opt['text'] ?? '',
                'icon' => $_opt['icon'] ?? 'indent'
            ];
        }
        $options = json_encode($_options);
        $text = $params['with_text'] ? 'Options' : '';
        $offset = '$'.$params['offset'];
        $icon = $params['icon'];
        return "<button type='button' data-id='{$offset}' data-options='$options' class='record_extra_options btn btn-primary ajax_crud_btn' title='More Options'><i class='fa fa-{$icon}'></i> {$text}</button>";
    }
}

function ajax_extra_btn($butt, $offset) {
    $id = $butt['id'] ?? '$'.$offset;
    $name = $butt['name'] ?? 'id'; //name of element to insert our id to be sent to server
    $type = $butt['type'] ?? 'url';
    $target = $butt['target'] ?? '#!';
    $text = $butt['text'] ?? '';
    $icon = $butt['icon'] ?? 'indent';
    $title = $butt['title'] ?? '';
    $bg = $butt['bg'] ?? 'primary';   
    if ($type == 'modal') {
        return "<button type='button' data-modal='#{$target}' data-name='{$name}' data-id='{$id}' class='btn btn-{$bg} ajax_crud_btn ajax_extra_modal_btn' title='{$title}'><i class='fa fa-{$icon}'></i> {$text}</button>";
    } else {
        $url = base_url($target);
        return "<a type='button' href='{$url}' class='btn btn-{$bg} ajax_crud_btn' title='{$title}'><i class='fa fa-{$icon}'></i> {$text}</a>";
    }
}


function table_crud_butts($module, $model, $usergroups, $table, $trashed, $keys = [], $show = [], $offset = 1, $with_text = false) {
    $ci =& get_instance();
    if (intval($trashed) == 1) {
        // restore and delete permanently for trashed pages
        // will always show on trashed list
        /* sample usage 
        $this->butts = ['list' => ['url' => 'orders', 'where' => ['company_id' => 3]];
        */
        $btn = ajax_restore_btn($module, $model, $usergroups, ['table' => $table, 'offset' => $offset, 'with_text' => $with_text, 'icon' => 'refresh']) . ' ';
        //check for custom model method (cmm) specified?
        $cmm = array_key_exists('delete', $show) && array_key_exists('cmm', $show['delete']) ? $show['delete']['cmm'] : '';
        //check for files
        $files = array_key_exists('delete', $show) && array_key_exists('files', $show['delete']) ? $show['delete']['files'] : [];
        $files = json_encode($files);
        //trash: will always show on trashed list unless $show['delete'] == false
        $show_delete = $show['delete'] ?? true;
        if ($show_trashed) {
            $btn .= ajax_del_btn($module, $model, $usergroups, ['table' => $table, 'offset' => $offset, 'cmm' => $cmm, 'files' => $files, 'with_text' => $with_text, 'icon' => 'trash-o']);
        }
        return $btn;
    }
    $butts = "";
    //view
    if (array_key_exists('view', $show)) {
        /* sample usage
        $butts = ['view' => ['type' => 'url', 'url' => 'products/view/$2']]; //where $2 = $keys[2-1]
        $keys = ['id', 'product_id'];
        $buttons = table_crud_butts($this->module, $this->model, null, T_ORDER_DETAILS, $trashed, $keys, $butts);
        NB: if targeting the view of the item itself, 'view' as array element is sufficient
        */
        $type = _crud_butt_param($show, 'view', 'type', 'url');
        $icon = _crud_butt_param($show, 'view', 'icon', 'eye');
        $qry = _crud_butt_param($show, 'view', 'qry', '');
        if ($type == 'url') {
            $url = _crud_butt_param($show, 'view', 'url', $ci->c_controller.'/view/$'.$offset.$qry);
            $butts .= ajax_view_btn($module, $usergroups, ['url' => $url, 'with_text' => $with_text, 'icon' => $icon]) . ' ';
        } else { //modal
            $modal = _crud_butt_param($show, 'view', 'modal', 'm_view');
            $butts .= ajax_view_btn_modal($module, $usergroups, ['keys' => $keys, 'modal' => $modal, 'with_text' => $with_text, 'icon' => $icon]) . ' '; 
        }
    }
    //edit
    if (array_key_exists('edit', $show)) {
        /* sample usage 
        
        */
        $type = _crud_butt_param($show, 'edit', 'type', 'url');
        $icon = _crud_butt_param($show, 'edit', 'icon', 'edit');
        $qry = _crud_butt_param($show, 'edit', 'qry', '');
        if ($type == 'url') {
            $url = _crud_butt_param($show, 'edit', 'url', $ci->c_controller.'/edit/$'.$offset.$qry);
            $butts .= ajax_edit_btn($module, $usergroups, ['url' => $url, 'with_text' => $with_text, 'icon' => $icon]) . ' ';
        } else { //modal
            $modal = _crud_butt_param($show, 'edit', 'modal', 'm_edit');
            $form_id = _crud_butt_param($show, 'edit', 'form_id', 'edit_form');
            $form_action = _crud_butt_param($show, 'edit', 'form_action', base_url($ci->c_controller.'/edit_ajax'));
            $butts .= ajax_edit_btn_modal($module, $usergroups, ['keys' => $keys, 'modal' => $modal, 'form_id' => $form_id, 'form_action' => $form_action, 'with_text' => $with_text, 'icon' => $icon]) . ' '; 
        }
    }
    //trash: will always show on untrashed list unless $show['trashed'] == false
    $show_trashed = $show['trashed'] ?? true;
    if ($show_trashed) {
        $butts .= ajax_trash_btn($module, $model, $usergroups, ['table' => $table, 'offset' => $offset, 'with_text' => $with_text, 'icon' => 'trash']) . ' ';
    }
    //extra buttons
    if (array_key_exists('xtra_butts', $show)) {
        /* sample usage
        $xtra_butts = [
            ['type' => 'url', 'target' => 'some_class/view/$3', 'icon' => 'indent'],
            ['type' => 'modal', 'target' => 'm_status_actions', 'icon' => 'wrench']
        ];
        $butts = ['view' => ['url' => 'products/view/$2'], 'extra' => $xtra_butts]; 
        */
        $xtra_butts = $show['xtra_butts'] ?? [];
        foreach ($xtra_butts as $butt) {
            $butts .= ajax_extra_btn($butt, $offset).' ';
        }
    }
    //extra options
    /*if (array_key_exists('extra', $show)) {
        //usage
        $icon = _crud_butt_param($show, 'extra', 'icon', 'navicon');
        $options = _crud_butt_param($show, 'extra', 'options', []);
        $butts .= ajax_extra_options_btn($module, $usergroups, ['options' => $options, 'offset' => $offset, 'with_text' => $with_text, 'icon' => $icon]) . ' ';
    }*/
    //vomit
    return $butts;
}

function _crud_butt_param($show, $type, $key, $default) {
    return is_array($show[$type]) && isset($show[$type][$key]) && ! empty($show[$type][$key]) ? $show[$type][$key] : $default;
}

function link_button($text, $url, $icon = '', $bg = 'primary', $title = '', $class = '', $full_url = false, $extra= []) {
    $attrs = set_extra_attrs($extra);
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    $url = $full_url ? $url : base_url($url);
    return '<a class="btn btn-'.$bg.' '.$class.'" href="'.$url.'" title="'.$title.'"><i class="'.$icon.'" '.$attrs.'></i> '.$text.'</a>';
}

function save_button($text, $form_id, $icon = 'save', $bg = 'primary', $title = '', $extra= []) {
    $attrs = set_extra_attrs($extra);
    $text .= ajax_spinner();
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    return '<button type="submit" form="'.$form_id.'" class="btn btn-'.$bg.'" title="'.$title.'" '.$attrs.'><i class="'.$icon.'"></i> '.$text.'</button>';
}

function modal_button($text, $target, $icon = '', $bg = 'primary', $title = '', $class = '', $extra= []) {
    $attrs = set_extra_attrs($extra);
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    return '<button type="button" class="btn btn-'.$bg.' '.$class.'" data-toggle="modal" data-target="#'.$target.'" title="'.$title.'" '.$attrs.'><i class="'.$icon.'"></i> '.$text.'</button>';
}

function tm_confirm($text, $module, $model, $table, $class = 'tm_confirm', $icon = '', $bg = 'primary', $title = '', $extra = []) {
    $attrs = set_extra_attrs($extra);
    $icon = strlen($icon) ? 'fa fa-'.$icon : '';
    return '<button class="btn btn-'.$bg.' '.$class.'" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$table.'" title="'.$title.'" '.$attrs.'><i class="'.$icon.'"></i> '.$text.'</button>';
}

function del_btn($module, $model, $usergroups = null, $params) {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
        $text = $params['with_text'] ? 'Delete' : '';
        return '<button type="button" data-mod="'.$module.'" data-md="'.$model.'" data-tb="'.$params['table'].'" data-id="$'.$params['offset'].'" data-cmm="'.$params['cmm'].'" data-files=\''.$params['files'].'\' class="delete_record btn btn-danger ajax_crud_btn" title="Delete record permanently"><i class="fa fa-'.$params['icon'].'"></i> '.$text.'</button>';
    }
}

function page_crud_butts($module, $usergroups, $butts, $record_id = null, $record_count = 0) {
    $ci =& get_instance();

    //any additional where clause? For trash all, restore all and clear trash.
    $where = isset($butts['where']) && ! empty($butts['where']) ? json_encode($butts['where']) : '';

    //refresh button to be appended
    $refresh_btn = link_button('Refresh', get_requested_page(), 'refresh', 'primary', 'Reload page', '', true);

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
                        
                        $restore_all = '';
                        $clear_all = '';
                        if ($ci->page == 'index' && $record_count > 0) {
                            $restore_all = tm_confirm('Restore All', $ci->module, $ci->model, $ci->table, 'tm_restore_all', 'refresh', 'success', 'Restore all records', ['data-where' => $where]);
                            //any files to be deleted?
                            $files = isset($butt['files']) ? $butt['files'] : [];
                            $clear_all = tm_confirm('Clear All', $ci->module, $ci->model, $ci->table, 'tm_clear_trash', 'trash-o', 'danger', 'Empty trash', ['data-files' => json_encode($files), 'data-where' => $where]);
                        }
                        //return early, cos we don't need to show other buttons
                        return $btn.' '.$restore_all.' '.$clear_all.' '.$refresh_btn;
                    } else {
                        if ($ci->page == 'index') {
                            $query_string = query_param('trashed', 1);
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
                if ($ci->auth->vet_access($module, VIEW, $usergroups)) {$url = $isset_url ? $butt['url'] : $ci->c_controller.'/view/'.$record_id;
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

            //Delete: (with confirm modal)
            case 'delete':
                $btn = '';
                if ($ci->auth->vet_access($module, DEL, $usergroups)) { 
                    $modal = $isset_modal ? $butt['modal'] : $ci->c_controller.'/delete/'.$record_id;
                    $icon = $isset_icon ? $butt['icon'] : 'trash';
                    $btn = modal_button('Delete', $modal, $icon, 'danger', 'Delete this record');
                }
                break;

            //Extra buttons
            case 'xtra_butts':
                /* sample usage
                $xtra_butts = [
                    ['text' => 'Link Button', 'type' => 'url', 'target' => 'products/items/93'],
                    ['text' => 'Modal Button', 'type' => 'modal', 'target' => 'm_approve', 'icon' => 'book']
                ];
                $this->butts = ['xtra_butts' => $xtra_butts];
                */
                $btn = '';
                if ($ci->auth->vet_access($module, VIEW, $usergroups)) { 
                    $xtra_butts = $butt;
                    if (is_array($xtra_butts) && count($xtra_butts) > 0)  {
                        foreach ($xtra_butts as $_opt) {
                            $type = $_opt['type'] ?? 'url';
                            $target = $_opt['target'] ?? '#!';
                            $text = $_opt['text'] ?? '';
                            $icon = $_opt['icon'] ?? 'indent';
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
        $buttons[$key] = $btn;
    } 
    $trash_all_btn = "";
    if ($ci->page == 'index' && $record_count > 0) {
        $trash_all_btn = tm_confirm('Trash All', $ci->module, $ci->model, $ci->table, 'tm_trash_all', 'trash', 'warning', 'Trash all records', ['data-where' => $where]);
        $buttons['trash_all'] = $trash_all_btn;
    }
    //append other buttons
    $buttons['refresh'] = $refresh_btn;
    //button sort order
    $order = ['save', 'add', 'add_m', 'edit', 'delete', 'view', 'list', 'restore_all', 'trash_all', 'clear_trash', 'xtra_butts', 'refresh'];
    //let's do the sort
    $sorted = sort_array($buttons, $order);
    return join(" ", $sorted); 
}