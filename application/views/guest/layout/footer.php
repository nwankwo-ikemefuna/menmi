<!-- Vendors -->
<!-- Regular guys -->
<script src="<?php echo base_url(); ?>vendors/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/popper.min.js"></script>
<script src="<?php echo base_url(); ?>vendors/bootstrap/bootstrap.min.js"></script>

<!-- Template scripts -->
<script src="<?php echo base_url(); ?>assets/portal/template/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/template/js/settings.min.js"></script>
<script src="<?php echo base_url(); ?>assets/portal/template/js/charts.js"></script>

<!-- General Custom scripts -->
<script src="<?php echo base_url(); ?>assets/common/js/utils/ajax.js"></script>

<?php
//custom page-specific scripts
if ($this->page_scripts) {
    foreach ($this->page_scripts as $script) { 
        $script_url = base_url().'assets/portal/custom/js/guest/'.$script.'.js'; ?>
        <script src="<?php echo $script_url; ?>"></script>
        <?php echo "\r\n";
    } 
} ?>

<script>
    //pass vars to javascript
    var base_url = "<?php echo base_url(); ?>";
    var c_controller = "<?php echo $this->c_controller; ?>";
</script>

</body>
</html>