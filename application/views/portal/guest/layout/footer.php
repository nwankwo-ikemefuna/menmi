			</div><!--/.login-register-->
        </div><!--/.align-items-center-->
    </div><!--/.login-container-->
</div><!--/.form-container-->

<!-- Vendors -->
<!-- Regular guys -->
<script src="<?php echo base_url(); ?>vendors/portal/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/portal/popper.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/portal/bootstrap/bootstrap.min.js"></script>

<!-- Template scripts -->
<script src="<?php echo base_url(); ?>assets/portal/template/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/template/js/settings.min.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/template/js/charts.js"></script>

<!-- General Custom scripts -->
<script src="<?php echo base_url(); ?>assets/common/js/utils/ajax.js"></script>

<?php
//custom page-specific scripts
load_scripts($this->page_scripts, 'assets/portal/custom/js'); 
?>

<script>
    //pass vars to javascript
    var base_url = "<?php echo base_url(); ?>";
    var c_controller = "<?php echo $this->c_controller; ?>";
</script>

</body>
</html>