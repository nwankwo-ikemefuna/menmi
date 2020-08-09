        </div><!-- /#ajax_page_container -->
        <footer class="footer">
            &copy; <?php echo date('Y'); ?>.
            <div class="float-right">
                Powered by<a href="<?php echo $this->site_author_url; ?>" class="company-name text-theme"><?php echo $this->site_author; ?></a>
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

//Image View
//modal row options
modal_header('m_img_view', 'Image View', 'fill-in', 'modal-lg');
modal_footer(false); 

//the guy that handles loading of stuff 
ajax_overlay_loader(); ?>

<!-- Vendors -->
<!-- Regular guys -->
<script src="<?php echo base_url(); ?>vendors/portal/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/portal/popper.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/portal/bootstrap/bootstrap.min.js"></script>
<!-- Selectpicker -->
<script src="<?php echo base_url(); ?>vendors/portal/selectpicker/js/bootstrap-select.min.js"></script>
<!-- Datatables BS 4 -->
<script src="<?php echo base_url(); ?>vendors/portal/datatables_bs4/datatables.min.js"></script>
<!-- jQuery File Upload -->
<!-- <script src="<?php //echo base_url(); ?>vendors/portal/jquery-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php //echo base_url(); ?>vendors/portal/jquery-upload/js/jquery.fileupload.js"></script>
Tags Input
<script src="<?php //echo base_url(); ?>vendors/portal/jquery-tagsinput/src/jquery.tagsinput.js"></script> -->

<!-- Template scripts -->
<script src="<?php echo base_url(); ?>assets/portal/template/js/main.js"></script>
<!-- <script src="<?php //echo base_url(); ?>assets/portal/template/js/settings.min.js"></script>
<script src="<?php //echo base_url(); ?>assets/portal/template/js/charts.js"></script> -->

<!-- Portal Common scripts -->
<script src="<?php echo base_url(); ?>assets/portal/custom/js/common.js"></script>

<!-- General Custom scripts -->
<script src="<?php echo base_url(); ?>assets/common/js/general.js"></script>
<!-- Utils -->
<script src="<?php echo base_url(); ?>assets/common/js/utils/data_table.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/ajax.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/modals.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/utils/num2words.js"></script>

<?php
//custom page-specific scripts
load_scripts($this->page_scripts, 'assets/portal/custom/js'); 
?>

<?php 
//is there a leading slash?
$requested_resource = get_requested_resource_ajax();
?>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>",
        ajax_requested_page = "<?php echo $requested_resource; ?>";
</script>

</body>
</html>