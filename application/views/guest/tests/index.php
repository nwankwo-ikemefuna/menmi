
<div class="container">
    <div class="row m-t-50">
        <div class="col-12 col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header"><h4>Backup Files List</h4></div>
                <div class="card-body">
                    <div id="files_area">
                        <?php   
                        $dir = FCPATH."uploads";
                        $files = scandir_recursive($dir);
                        foreach ($files as $file) { ?>
                            <div class="file_path"><?php echo $file; ?></div>
                            <?php
                        } ?>
                    </div>
                    <a class="btn btn-primary btn-lg" id="download" href="<?php echo base_url('tests/download_backup'); ?>">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    #files_area {
        border: 2px solid #ddd;
        padding: 10px;
        margin-bottom: 20px;
        max-width: 100%;
        max-height: 300px;
        overflow: auto;
    }
    #files_area .file_path {
        padding: 3px 0;
        border-bottom: 1px solid #ddd;
    }
</style>