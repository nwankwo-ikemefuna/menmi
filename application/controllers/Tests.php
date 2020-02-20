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

}