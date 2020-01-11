<?php 

function attr_isset($key, $val, $default) {
    return isset($key) && strlen($key) ? $val : $default;
}

function input_key_isset($arr, $key, $default = '', $val = '') {
    if (array_key_exists($key, $arr) && !empty($arr[$key])) {
        return strlen($val) ? $val : $arr[$key];
    } 
    return $default;
}

function set_extra_attrs($extra) {
    $attrs = "";
    if (count($extra) > 0) { 
        foreach ($extra as $attr => $value) {
            $attrs .= $attr.'='.'"'.$value.'" ';
        } 
    } 
    return $attrs;
}

function xform_label($label, $for = '', $extra = [], $ajax = false) {
    //prepend bs class
    $extra['class'] = 'form-control-label '.input_key_isset($extra, 'class', '');
    $for = attr_isset($for, 'for="'.$for.'"', '');
    $elem = '<label '.$for.' '.set_extra_attrs($extra).'  style="padding-top: 10px">'.$label.':</label>';
    if ($ajax) return $elem;
    echo $elem;
}

function xform_input($name, $type = 'text', $value = '', $required = false, $extra = [], $ajax = false) {
    //prepend bs class
    if ( ! in_array($type, ['checkbox', 'radio'])) {
        $extra['class'] = 'form-control '.input_key_isset($extra, 'class', '');
    }
    $attrs = set_extra_attrs($extra);
    $is_required = $required ? 'required' : '';
    if ($type == 'textarea') {
        $rows = input_key_isset($extra, 'rows', 8);
        $elem = '<textarea name="'.$name.'" rows="'.$rows.'" '.$is_required.' '.$attrs.'>'.$value.'</textarea>';
    } else {
        $elem = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$is_required.' '.$attrs.' />';
    }
    if ($ajax) return $elem;
    echo $elem;
}

function xform_select($name, $value = '', $required = false, $extra = [], $ajax = false) { 
    $is_required = $required ? 'required' : '';
    //is it a db record set? All db recordset must have a text_col key
    if (array_key_exists('text_col', $extra) && strlen($extra['text_col'])) {
        //value column
        $val_col = input_key_isset($extra, 'val_col', 'id');
        $text_col = input_key_isset($extra, 'text_col', 'Not set!');
        $options = select_options_db($extra['options'], $val_col, $text_col, $value);
    } else {
        //just a regular array
        $options = select_options($extra['options'], $value);
    }  
    $elem = '<select name="'.$name.'" '.$is_required.' class="form-control">';
    $elem .= '<option value="">Select</option>';
    $elem .= $options;
    $elem .= '</select>';
    if ($ajax) return $elem;
    echo $elem;
}

/**
 * Select options with hard-coded data
 * @param $options_arr: the data array
 * @param $selected_val: the currently selected value
 * @return html
 */
function select_options($options_arr, $selected_val = NULL) {
    //is options associative? if not, copy values to keys
    $options_arr = is_assoc_array($options_arr) ? $options_arr : array_combine($options_arr, $options_arr);
    $options = "";
    foreach ($options_arr as $key => $label) {
        $selected = $key == $selected_val ? 'selected' : NULL;
        $options .= '<option ' . $selected . ' value="' . $key . '">' . $label . '</option>';
    }
    return $options;
}

/**
 * Select options with data populated from DB
 * @param $options_obj: the data object
 * @param $key: the key field to be saved
 * @param $label: the associated value field for rendering
 * @param $selected_val: the currently selected value
 * @return html
 */
function select_options_db($options_obj, $key, $label, $selected_val = NULL) {
    $options = "";
    foreach ($options_obj as $row) {
        $selected = $row->$key == $selected_val ? 'selected' : NULL;
        $options .= '<option ' . $selected . ' value="' . $row->$key . '">' . $row->$label . '</option>';
    }
    return $options;
}

function xform_group_list($label, $name, $type = 'text', $value = '', $required = false, $input_extra = [], $label_extras = [], $fg_extra = []) {
    //prepend bs class
    $fg_extra['class'] = 'form-group '.input_key_isset($fg_extra, 'class', '');
    $for = input_key_isset($input_extra, 'id', '');

    //hide label if type is hidden, and don't wrap in form-group div to save real estate
    if ($type == 'hidden') {
        xform_input($name, $type, $value, $required, $input_extra);
    } else { ?>
        <div <?php echo set_extra_attrs($fg_extra); ?>>
            <?php
            xform_label($label, $for, $label_extras);
            if ($type == 'select') { 
                xform_select($name, $value, $required, $input_extra);
            } else {
                xform_input($name, $type, $value, $required, $input_extra);
            } ?>
        </div>
        <?php
    } 
}

function xform_group_grid($label, $name, $type = 'text', $value = '', $required = false, $input_extra = [], $label_extras = [], $fg_extra = [], $label_col_attrs = ['class' => 'col-12 col-sm-6 col-md-4 col-lg-3'], $input_col_attrs = ['class' => 'col-12 col-sm-6 col-md-8 col-lg-9']) {
    //prepend bs class
    $fg_extra['class'] = 'form-group '.input_key_isset($fg_extra, 'class', '');
    $for = input_key_isset($input_extra, 'id', '');

    //hide label if type is hidden, and don't wrap in form-group div to save real estate
    if ($type == 'hidden') {
        xform_input($name, $type, $value, $required, $input_extra);
    } else { ?>
        <div class="row">
            <div <?php echo set_extra_attrs($label_col_attrs); ?>>
                <div <?php echo set_extra_attrs($fg_extra); ?>>
                    <?php
                    xform_label($label, $for, $label_extras); ?>
                </div>
            </div>
            <div <?php echo set_extra_attrs($input_col_attrs); ?>>
                <div <?php echo set_extra_attrs($fg_extra); ?>>
                    <?php
                    if ($type == 'select') { 
                        xform_select($name, $value, $required, $input_extra);
                    } else {
                        xform_input($name, $type, $value, $required, $input_extra);
                    } ?>
                </div>
            </div>
        </div>
        <?php
    } 
}

function xform_submit($text = 'Save', $form_id = '', $extra = ['class' => 'btn btn-theme'], $fg_extra = ['class' => 'form-group']) {
    $form_id = attr_isset($form_id, 'form="'.$form_id.'"', ''); 
    $text .= ' <i class="fa fa-spinner ajax_spinner hide"></i>'; ?>
    <div <?php echo set_extra_attrs($fg_extra); ?>>
        <button type="submit" <?php echo $form_id; ?> <?php echo set_extra_attrs($extra); ?> >
            <span><?php echo $text; ?></span>
        </button>
    </div>
    <?php
}

function xform_notice($class = 'status_msg', $id = '') {
    $id = attr_isset($id, 'id="'.$id.'"', ''); ?>
    <div class="m-t-10 m-b-10 <?php echo $class; ?>" <?php echo $id; ?>></div>
    <?php
}

function xform($action, $fields, $attrs = [], $butt_text = 'Save', $butt_form = '', $butt_attrs = [], $notice_attrs = []) {
    echo form_open($action, $attrs);
        //form fields
        foreach ($fields as $field) {
            $layout = input_key_isset($field, 'layout', 'grid');
            $label = input_key_isset($field, 'label', '');
            $name = input_key_isset($field, 'name', '');
            $type = input_key_isset($field, 'type', '');
            $value = input_key_isset($field, 'value', '');
            $required = input_key_isset($field, 'required', '');
            $extra = input_key_isset($field, 'extra', []);
            $label_extras = input_key_isset($field, 'label_extra', []);
            $fg_extra = input_key_isset($field, 'fg_extra', []);
            //layout type
            if ($layout == 'list') { //list
                xform_group_list($label, $name, $type, $value, $required, $extra, $label_extras, $fg_extra);
            } else { //grid
                $label_col_attrs = input_key_isset($field, 'label_col_attrs', ['class' => 'col-12 col-sm-6 col-md-4 col-lg-3']);
                $input_col_attrs = input_key_isset($field, 'input_col_attrs', ['class' => 'col-12 col-sm-6 col-md-8 col-lg-9']);
                xform_group_grid($label, $name, $type, $value, $required, $extra, $label_extras, $fg_extra, $label_col_attrs, $input_col_attrs);
            }
        }
        //form notice
        $notice_class = input_key_isset($notice_attrs, 'class', 'status_msg');
        $notice_id = input_key_isset($notice_attrs, 'id', '');
        xform_notice($notice_class, $notice_id);
        //form button
        $butt_class = input_key_isset($butt_attrs, 'class', 'btn btn-theme');
        xform_submit($butt_text, $butt_form, $butt_attrs);
    echo form_close();
}

function adit_form_modal($crud_type, $item, $fields, $butt_attrs = ['class' => 'btn btn-theme'], $prefix = 'm', $reload = 1) {
    $ci =& get_instance();
    $modal = $prefix.'_'.$crud_type;
    $title = ucfirst($crud_type).' ' . $item;
    $form_id = $crud_type.'_form';
    $action = $ci->c_controller.'/'.$crud_type.'_item_ajax';
    $id_field = $crud_type == 'edit' ? xform_input('id', 'hidden') : '';
    $attrs = ['id' => $form_id, 'class' => 'ajax_form', 'data-type' => 'modal_dt', 'data-modal' => $modal, 'data-msg' => $item.' '.$crud_type.'ed successfully', 'data-reload' => $reload];
    modal_header($modal, $title);
        xform($action, $fields, $attrs, ucfirst($crud_type), $form_id, $butt_attrs);
    modal_footer(false);
}