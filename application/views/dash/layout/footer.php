                    </div><!-- /.bg-white padding-25 h-100 -->
                </div><!-- /.col-12 -->
            </div><!-- /.row -->

        </div>
        <!-- /page content -->
            
        <footer class="footer">
            <div class="float-right">
                Developed by <a href="<?php echo $this->author_linkedin; ?>" class="company-name text-theme"><?php echo $this->site_author; ?></a>
            </div>
            <div class="clearfix"></div>
        </footer>

    </div>
</div>

<?php
//General modals

//modal confirm action
modal_header('m_confirm_action'); ?>
<div class="msg"></div>
<div class="confirm_status m-t-10"></div>
<?php modal_footer(true, true); 

//confirm bulk action
modal_header('m_confirm_ba'); ?>
<div class="ba_msg"></div>
<div class="confirm_status m-t-10"></div>
<?php modal_footer(true, true, 'ba_confirm_btn'); 

//modal row options
modal_header('m_row_options', 'More Options', '', 'modal-form');
modal_footer(false); 
?>

<!-- Vendors -->
<!-- Regular guys -->
<script src="<?php echo base_url(); ?>vendors/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/popper.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/bootstrap/bootstrap.min.js"></script>
<!-- Selectpicker -->
<script src="<?php echo base_url(); ?>vendors/selectpicker/js/bootstrap-select.min.js"></script>
<!-- Datatables BS 4 -->
<script src="<?php echo base_url(); ?>vendors/datatables_bs4/datatables.min.js"></script>

<!-- Template scripts -->
<script src="<?php echo base_url(); ?>assets/portal/template/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/template/js/settings.min.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/template/js/charts.js"></script>

<!-- General Custom scripts -->
<script src="<?php echo base_url(); ?>assets/common/js/general.js"></script>
<!-- Utils -->
<script src="<?php echo base_url(); ?>assets/common/js/utils/data_table.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/ajax.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/modals.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/num2words.js"></script>

<?php
//custom page-specific scripts
if ($this->page_scripts) {
    foreach ($this->page_scripts as $script) { 
        $script_url = base_url().'assets/portal/custom/js/dash/'.$script.'.js'; ?>
        <script src="<?php echo $script_url; ?>"></script>
        <?php echo "\r\n";
    } 
} ?>

<script>
    //pass vars to javascript
    var base_url = "<?php echo base_url(); ?>";
    var c_controller = "<?php echo $this->c_controller; ?>";
    var user_currency_name = "<?php echo $this->session->user_currency_name; ?>";
    var user_currency = "<?php echo $this->session->user_currency; ?>";
    //trash status
    var trashed = "<?php echo $this->trashed; ?>";
    
</script>

</body>
</html>