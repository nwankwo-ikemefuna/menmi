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
    $elem = '<label '.$for.' '.set_extra_attrs($extra).'>'.$label.'</label>';
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
        $rows = input_key_isset($extra, 'rows', 100);
        $elem = '<textarea name="'.$name.'" rows="'.$rows.'" '.$is_required.' '.$attrs.'>'.$value.'</textarea>';
    } else {
        $elem = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$is_required.' '.$attrs.' />';
    }
    if ($ajax) return $elem;
    echo $elem;
}

function xform_select($name, $value = '', $required = false, $extra = [], $ajax = false) { 
    $is_required = $required ? 'required' : '';
    // var_dump($extra['options']); die;
    if (array_key_exists('db', $extra) && $extra['db']) {
        //value column
        $val_col = input_key_isset($extra, 'val_col', 'id');
        $text_col = input_key_isset($extra, 'text_col', 'Not set!');
        $options = select_options_db($extra['options'], $val_col, $text_col, $value);
    } else {
        $options = select_options($extra['options'], $value);
    }  
    $elem = '<select name="'.$name.'" '.$is_required.' class="form-control">';
    $elem .= '<option value="">Select</option>';
    $elem .= $options;
    $elem .= '</select>';
    if ($ajax) return $elem;
    echo $elem;
}

function xform_group($label, $name, $type = 'text', $value = '', $required = false, $input_extra = [], $label_extras = [], $fg_extra = []) {
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

function xform_submit($title = 'Save', $form_id = '', $extra = ['class' => 'btn btn-theme'], $fg_extra = ['class' => 'form-group']) {
    $form_id = attr_isset($form_id, $form_id, ''); ?>
    <div <?php echo set_extra_attrs($fg_extra); ?>>
        <button type="submit" <?php echo $form_id; ?> <?php echo set_extra_attrs($extra); ?> >
            <span><?php echo $title; ?></span>
        </button>
    </div>
    <?php
}

function xform_notice($class = 'status_msg', $id = '') {
    $id = attr_isset($id, 'id="'.$id.'"', ''); ?>
    <div class="m-t-10 m-b-10 <?php echo $class; ?>" <?php echo $id; ?>></div>
    <?php
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

function adit_form_modal($crud_type, $item, $fields, $prefix = 'm', $reload = 1) {
    $ci =& get_instance();
    $modal = $prefix.'_'.$crud_type;
    $title = ucfirst($crud_type).' ' . $item;
    $form_id = $crud_type.'_form';
    $action = $ci->c_controller.'/'.$crud_type.'_item_ajax';
    $id_field = $crud_type == 'edit' ? xform_input('id', 'hidden') : '';
    $attrs = ['id' => $form_id, 'class' => 'ajax_form', 'data-modal' => $modal, 'data-crud_type' => $crud_type, 'data-msg' => $item.' '.$crud_type.'ed successfully', 'data-reload' => $reload];
    // var_dump($fields); die;
    modal_header($modal, $title);
        echo form_open($action, $attrs);
            //form fields
            if ($crud_type == 'edit') form_input('id', 'hidden');
            foreach ($fields as $field) {
                $label = input_key_isset($field, 'label', '');
                $name = input_key_isset($field, 'name', '');
                $type = input_key_isset($field, 'type', '');
                $value = input_key_isset($field, 'value', '');
                $required = input_key_isset($field, 'required', '');
                $extra = input_key_isset($field, 'extra', []);
                $label_extras = input_key_isset($field, 'label_extras', []);
                $fg_extra = input_key_isset($field, 'fg_extra', []);
                xform_group($label, $name, $type, $value, $required, $extra, $label_extras, $fg_extra);
            }
            xform_notice();
            xform_submit();
        echo form_close();
    modal_footer(false);
}