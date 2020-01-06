<?php 

function form_input($name, $type = 'text', $value = '', $class = '', $id = '', $required = true, $readonly = false, $disabled = false, $min = 0, $max = '') {
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
    ?>
    <input 
        type="<?php echo $type; ?>" 
        name="<?php echo $name; ?>" 
        value="<?php echo $value; ?>" 
        min="<?php echo $min; ?>" 
        max="<?php echo $max; ?>" 
        class="form-control <?php echo $class; ?>" 
        <?php echo $id; ?> 
        <?php echo $required ? 'required':''; ?> 
        <?php echo $readonly ? 'readonly':''; ?> 
        <?php echo $disabled ? 'disabled':''; ?> 
    />
    <?php
}

function form_check($name, $value = '', $class = '', $id = '', $checked = false, $required = false, $readonly = false, $disabled = false) {
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
    ?>
    <input 
        type="checkbox" 
        name="<?php echo $name; ?>" 
        value="<?php echo $value; ?>" 
        class="<?php echo $class; ?>" 
        <?php echo $id; ?> 
        <?php echo $checked ? 'checked':''; ?> 
        <?php echo $required ? 'required':''; ?> 
        <?php echo $readonly ? 'readonly':''; ?> 
        <?php echo $disabled ? 'disabled':''; ?> 
    />
    <?php
}

function form_radio($name, $value = '', $class = '', $id = '', $checked = false, $required = false, $readonly = false, $disabled = false) {
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
    ?>
    <input 
        type="radio" 
        name="<?php echo $name; ?>" 
        value="<?php echo $value; ?>" 
        class="<?php echo $class; ?>" 
        <?php echo $id; ?> 
        <?php echo $checked ? 'checked':''; ?> 
        <?php echo $required ? 'required':''; ?> 
        <?php echo $readonly ? 'readonly':''; ?> 
        <?php echo $disabled ? 'disabled':''; ?> 
    />
    <?php
}


function form_check_dt($name, $value = '', $class = '') {
    return '<input type="checkbox" name="'.$name.'" value="'.$value.'" class="'.$class.'"/>'; 
}

function form_group_input($label, $name, $type = 'text', $value = '', $class = '', $group_class = '', $id = '', $required = true, $readonly = false, $disabled = false, $min = 0, $max = '') {
    $for = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
	?>
    <div class="form-group <?php echo $group_class; ?>">
     	<label <?php echo $for; ?>><?php echo $label; ?></label>
        <?php form_input($name, $type, $value, $class, $id, $required, $readonly, $disabled, $min, $max); ?>
    </div>
    <?php
}

function bs_form_input_group($label, $name, $type = 'text', $value = '', $prepend, $append, $class = '', $id = '', $required = true, $readonly = false, $disabled = false, $min = 0, $max = '') {
    ?>
    <div class="input-group">
        <?php 
        if (strlen($prepend)) { ?>
            <div class="input-group-prepend">
                <span class="input-group-text"><?php echo $prepend; ?></span>
            </div>
            <?php 
        }
        form_input($name, $type, $value, $class, $id, $required, $readonly, $disabled, $min, $max);
        if (strlen($append)) { ?>
            <div class="input-group-append">
                <span class="input-group-text"><?php echo $append; ?></span>
            </div>
            <?php 
        } ?>
    </div>
    <?php
}

function form_submit($title = 'Save', $form_id = '', $class = 'btn-theme', $group_class = '', $id = '') {
    $form_id = isset($form_id) && strlen($form_id) ? 'form="'.$form_id.'"' : '';
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
	?>
    <div class="form-group <?php echo $group_class; ?>">
        <button type="submit" <?php echo $form_id; ?> class="btn <?php echo $class; ?>" <?php echo $id; ?>>
            <span><?php echo $title; ?></span>
        </button>
    </div>
    <?php
}

function form_notice($class = 'status_msg', $id = '') {
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
	?>
    <div class="m-t-10 m-b-10 <?php echo $class; ?>" <?php echo $id; ?>>
    </div>
    <?php
}

function form_after_link($title, $link  = '', $link_text  = '', $class = '', $group_class = '') {
	?>
	<div class="form-group <?php echo $group_class; ?>">
        <p><?php echo $title; ?> <a href="<?php echo $link; ?>" class="<?php echo $title; ?>"><b><?php echo $link_text; ?></b></a></p>
    </div>
    <?php
}

function form_select($name, $options_arr, $selected_val = '', $class = '', $id = '', $required = true, $readonly = false, $disabled = false) {
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
    ?>
    <select 
        name="<?php echo $name; ?>" 
        class="form-control <?php echo $class; ?>" 
        <?php echo $id; ?>
        <?php echo $required ? 'required':''; ?> 
        <?php echo $readonly ? 'readonly':''; ?> 
        <?php echo $disabled ? 'disabled':''; ?> 
        >
        <option value="">Select</option>
        <?php select_options($options_arr, $selected_val); ?>
    </select>
    <?php
}

function form_select_db($name, $options_arr, $key, $label, $selected_val = '', $class = '', $id = '', $required = true, $readonly = false, $disabled = false) {
    $id = isset($id) && strlen($id) ? 'id="'.$id.'"' : '';
    ?>
    <select 
        name="<?php echo $name; ?>" 
        class="form-control selectpicker <?php echo $class; ?>" 
        <?php echo $id; ?>
        <?php echo $required ? 'required':''; ?>  
        <?php echo $readonly ? 'readonly':''; ?> 
        <?php echo $disabled ? 'disabled':''; ?> 
        >
        <option value="">Select</option>
        <?php select_options_db($options_arr, $key, $label, $selected_val); ?>
    </select>
    <?php
}

function form_group_select($label, $name, $options_arr, $selected_val = '', $class = '', $group_class = '', $id = '', $readonly = false, $disabled = false) {
    $for = isset($id) && strlen($id) ? 'for="'.$id.'"' : '';
    ?>
    <div class="form-group <?php echo $group_class; ?>">
        <label <?php echo $for; ?>><?php echo $label; ?></label>
        <?php form_select($name, $options_arr, $selected_val, $class, $id, $required, $readonly, $disabled); ?>
    </div>
    <?php
}

function form_group_select_db($label, $name, $options_arr, $key, $field_title, $selected_val = '', $class = '', $group_class = '', $id = '', $required = true, $readonly = false, $disabled = false) {
    $for = isset($id) && strlen($id) ? 'for="'.$id.'"' : '';
    ?>
    <div class="form-group <?php echo $group_class; ?>">
        <label <?php echo $for; ?>><?php echo $label; ?></label>
        <?php form_select_db($name, $options_arr, $key, $field_title, $selected_val, $class, $id, $required, $readonly, $disabled); ?>
    </div>
    <?php
}


/**
 * Select options with hard-coded data
 * @param $options_arr: the data array
 * @param $selected_val: the currently selected value
 * @return html
 */
function select_options($options_arr, $selected_val = NULL)
{
    //is options associative? if not, copy values to keys
    $options_arr = is_assoc_array($options_arr) ? $options_arr : array_combine($options_arr, $options_arr);
    $options = "";
    foreach ($options_arr as $key => $label) {
        $selected = $key == $selected_val ? 'selected' : NULL;
        $options .= '<option ' . $selected . ' value="' . $key . '">' . $label . '</option>';
    }
    echo $options;
}

/**
 * Select options with data populated from DB
 * @param $options_obj: the data object
 * @param $key: the key field to be saved
 * @param $label: the associated value field for rendering
 * @param $selected_val: the currently selected value
 * @return html
 */
function select_options_db($options_obj, $key, $label, $selected_val = NULL)
{
    $options = "";
    foreach ($options_obj as $row) {
        $selected = $row->$key == $selected_val ? 'selected' : NULL;
        $options .= '<option ' . $selected . ' value="' . $row->$key . '">' . $row->$label . '</option>';
    }
    echo $options;
}