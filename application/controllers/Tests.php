<?php
defined('BASEPATH') or die('Direct access not allowed');

class Tests extends Core_controller {
    public function __construct() {
        parent::__construct();
    }


    public function index() { 
        $this->guest_header('Tests');
        $this->load->view('guest/tests/index');
        $this->guest_footer();
    }    


    public function download_backup() {
        $backed_by = 'Nwankwo Ikemefuna';
        require FCPATH.'application/libraries/ZipStream/ZipStream.php';
        # create a new zipstream object
        $bk_file = date('Y-m-d.H-i-s').'.zip';
        $zip = new ZipStream\ZipStream($bk_file);
        $dir = FCPATH."uploads";
        $files = scandir_recursive($dir);
        foreach ($files as $file) {
            $file_path = $dir.'/'.$file;
            //Download file
            //Add to zip
            $zip->addFileFromPath($file, $file_path);
        }
        $zip->addFile('info.txt', 'Backup created on '. date('Y-m-d H:i:s') . ' by ' . $backed_by);
        $zip->finish();
        //clean up
        ob_clean();
        flush();
    }


    public function insert() {
        $items = array(
            'Abuja (FCT)',
            'Abia',
            'Adamawa',
            'Akwa Ibom',
            'Anambra',
            'Bauchi',
            'Bayelsa',
            'Benue',
            'Borno',
            'Cross River',
            'Delta',
            'Ebonyi',
            'Edo',
            'Ekiti',
            'Enugu',
            'Gombe',
            'Imo',
            'Jigawa',
            'Kaduna',
            'Kano',
            'Katsina',
            'Kebbi',
            'Kogi',
            'Kwara',
            'Lagos',
            'Nasarawa',
            'Niger',
            'Ogun',
            'Ondo',
            'Osun',
            'Oyo',
            'Plateau',
            'Rivers',
            'Sokoto',
            'Taraba',
            'Yobe',
            'Zamfara'
        );
        $data = [];
        $order = 1;
        foreach ($items as $item) {
            $row = [];
            $row['name'] = $item;
            $row['country_id'] = 135;
            $row['order'] = $order;
            $data[] = $row;
            $order++;
        }
        $this->common_model->insert_batch(T_STATES, $data);
    }
    

}