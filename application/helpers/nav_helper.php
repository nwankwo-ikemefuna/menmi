<?php

function sidebar_menu($name, $url, $icon = 'cube', $title = '') { ?>
    <li class="nav-item">
        <a href="<?php echo base_url($url); ?>" title="<?php echo strlen($title) ? $title : $name; ?>">
            <i class="fa fa-<?php echo $icon; ?>" aria-hidden="true"></i>
            <span><?php echo $name; ?></span>
        </a>
    </li>
    <?php
}

function sidebar_menu_auth($module, $right, $usergroups = null, $name, $url, $icon = 'cube', $title = '') {
    $ci =& get_instance();
    if ($ci->auth->vet_access($module, $right, $usergroups)) { 
        sidebar_menu($name, $url, $icon, $title);
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