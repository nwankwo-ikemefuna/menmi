<?php 
function paginate($records, $total_rows, $offset, $per_page = 15, $url = '') {
    $ci =& get_instance();
    if ($offset != 0) {
        $offset = ($offset - 1) * $per_page;
    }
    $config['base_url'] = strlen($url) ? $url : base_url($ci->c_controller.'/'.$ci->c_method);
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $per_page;
    $config['next_link'] = '&raquo;';
    $config['prev_link'] = '&laquo;';
    $config['first_link'] = 'Last';
    $config['last_link'] = 'Last';
    $config['full_tag_open'] = '<ul>';
    $config['full_tag_close'] = '</ul>';
    $config['cur_tag_open'] = '<li><a class="active clickable">';   
    $config['cur_tag_close'] = '</a></li>';
    $config['first_tag_open'] = $config['last_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] = $config['num_tag_open'] = '<li>';
    $config['first_tag_close'] = $config['last_tag_close'] = $config['prev_tag_close'] = $config['next_tag_close'] = $config['num_tag_close'] = '</li>';
    $ci->pagination->initialize($config);
    $data['pagination'] = $ci->pagination->create_links();
    $data['records'] = $records;
    $data['total_rows'] = $total_rows;
    $data['total_rows_formatted'] = number_format($total_rows);
    return $data;
}