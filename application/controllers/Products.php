<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/


class Products extends Core_controller {
    public function __construct() {
        parent::__construct();
        $this->page_scripts = ['products'];
    }


    public function cat_products_ajax() { 
        $cat_id = $this->input->post('cat_id', TRUE); 
        $sql = $this->product_model->sql();
        $where = array_merge($sql['where'], ['cat_id' => $cat_id]);
        $products = $this->common_model->get_rows($sql['table'], 0, $sql['joins'], $sql['select'], $where, $sql['order'], '', 8);
        $data = [];
        foreach ($products as $row) {
            $data[] = [
                'id' => $row->id,
                'name' => $row->name,
                'link' => product_url($row->id, $row->name),
                'image' => company_file_path($row->pix_dir, $row->image),
                'amount' => $row->amount
            ];
        }
        json_response($data);
    }
    
}