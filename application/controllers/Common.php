<?php
defined('BASEPATH') or die('Direct access not allowed');

/**
* Common controller to control objects, action and processes shared by other controllers.
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/


class Common extends Core_controller {
    public function __construct() {
        parent::__construct();
        $this->auth->login_restricted();
        $this->auth->token_restricted();
    }


    private function validate_input($right, $usergroup, $require_id = true) {
        // var_dump($_POST); 
        $module = $this->input->post('mod', TRUE);
        $this->auth->module_restricted($module, $right, $usergroup, true);
        //set validation rules
        $error = 'A validation error occured';
        $this->form_validation->set_rules('mod', 'Module', 'trim|required', ['required' => $error]);
        $this->form_validation->set_rules('tb', 'Table', 'trim|required', ['required' => $error]);
        $this->form_validation->set_rules('md', 'Model', 'trim|required', ['required' => $error]);
        if ($require_id) {
            $this->form_validation->set_rules('id', 'ID', 'trim|required', ['required' => 'No record selected']);
        }
        if ($this->form_validation->run() === FALSE)
            json_response(validation_errors(), false);
    }


    private function tg_details() {
        $table = xpost('tb');
        $id = xpost('id'); 
        $model = xpost('md').'_model'; 
        $model_method = xpost('cmm');
        $where = xpost('where');
        return ['table' => $table, 'id' => $id, 'model' => $model, 'cmm' => $model_method, 'where' => $where];
    }


    private function ba_record_idx() {
        $record_idx = xpost('id');
        if ( ! strlen($record_idx)) json_response('No record selected', false);
        $ba_record_idx = explode(',', $record_idx);
        return $ba_record_idx;
    }


    public function trash_ajax() { 
        $this->validate_input(DEL, null);
        $tg = $this->tg_details();
        $model = $tg['model'];
        $affected_rows = $this->$model->update($tg['table'], ['trashed' => 1], ['id' => $tg['id']]);
        json_response_db();
    }


    public function bulk_trash_ajax() { 
        $this->validate_input(DEL, null);
        $tg = $this->tg_details();
        $model = $tg['model'];
        $ba_record_idx = $this->ba_record_idx();
        foreach ($ba_record_idx as $id) {
            $this->$model->update($tg['table'], ['trashed' => 1], ['id' => $id]);
        }
        json_response_db();
    }


    public function trash_all_ajax() { 
        $this->validate_input(DEL, null, false);
        $tg = $this->tg_details();
        $model = $tg['model'];
        $where = is_array($tg['where']) && ! empty($tg['where']) ? array_merge($tg['where'], ['trashed' => 1]) : ['trashed' => 1];
        $this->$model->update($tg['table'], ['trashed' => 1], $where);
        json_response_db();
    }


    public function restore_ajax() { 
        $this->validate_input(DEL, null);
        $tg = $this->tg_details();
        $model = $tg['model'];
        $this->$model->update($tg['table'], ['trashed' => 0], ['id' => $tg['id']]);
        json_response_db();
    }


    public function restore_all_ajax() { 
        $this->validate_input(DEL, null, false);
        $tg = $this->tg_details();
        $model = $tg['model'];
        $where = is_array($tg['where']) && ! empty($tg['where']) ? array_merge($tg['where'], ['trashed' => 1]) : ['trashed' => 1];
        $this->$model->update($tg['table'], ['trashed' => 0], $where);
        json_response_db();
    }


    public function bulk_restore_ajax() { 
        $this->validate_input(DEL, null);
        $tg = $this->tg_details();
        $model = $tg['model'];
        $ba_record_idx = $this->ba_record_idx();
        foreach ($ba_record_idx as $id) {
            $this->$model->update($tg['table'], ['trashed' => 0], ['id' => $id]);
        }
        json_response_db();
    }


    private function delete($where) {
        $tg = $this->tg_details();
        $model = $tg['model'];
        $files = xpost('files');
        //if files is set, use delete with files method
        if (is_array($files) && ! empty($files)) {
            $this->$model->delete_with_files($tg['table'], $where, $files);
        } else {
            //is custom model method set? use default 'delete' otherwise
            $method = strlen($tg['cmm']) ? $tg['cmm'] : 'delete';
            $this->$model->$method($tg['table'], $where);
        }
    }


    public function delete_ajax() { 
        $this->validate_input(DEL, null);
        $this->delete(['id' => xpost('id'), 'trashed' => 1]);
        json_response_db();
    }


    public function bulk_delete_ajax() {
        $this->validate_input(DEL, null);
        $ba_record_idx = $this->ba_record_idx();
        foreach ($ba_record_idx as $id) {
            $this->delete(['id' => $id, 'trashed' => 1]);
        }
        json_response_db();
    }


    public function clear_trash_ajax() { 
        $this->validate_input(DEL, null, false);
        $tg = $this->tg_details();
        $where = is_array($tg['where']) && ! empty($tg['where']) ? array_merge($tg['where'], ['trashed' => 1]) : ['trashed' => 1];
        $rows = $this->db->get_where($tg['table'], $where)->result();
        foreach ($rows as $row) {
            $this->delete(['id' => $row->id, 'trashed' => 1]);
        }
        json_response_db();
    }
    
}