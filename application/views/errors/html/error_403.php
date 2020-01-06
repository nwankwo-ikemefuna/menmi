<div class="main-container">
	<div class="d-flex justify-content-center h-100vh w-100vw align-items-center">
	    <div class="error-container text-center">
	    	<?php flash_message('error_msg', 'danger'); ?>
	        <h1 class="error-number">403</h1>
	        <h2 class="semi-bold">Forbidden!</h2>
	        <p class="p-b-10"></p>
	        <div><a href="<?php echo base_url(); ?>" class="btn btn-info btn-rounded btn-lg">Go Back</a></div>
	    </div>
	</div>
</div>