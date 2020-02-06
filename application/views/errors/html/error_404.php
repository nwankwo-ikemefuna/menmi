<div class="main-container">
	<div class="d-flex justify-content-center h-100vh w-100vw align-items-center">
		<div class="error-container text-center">
			<?php flash_message('error_msg', 'danger'); ?>
	        <h1 class="error-number">404</h1>
	        <h2 class="semi-bold">Page not found!</h2>
	        <p class="p-b-10">Sorry, this page doesn't exist.</p>
	        <div>
	        	<?php 
	        	if (strlen($this->agent->referrer())) {
			        $back = $this->agent->referrer();
			    } else {
			    	$back = $this->session->user_loggedin ? 'user' : '';
			    } ?>
			    <a href="<?php echo base_url($back); ?>" class="btn btn-info btn-rounded btn-lg">Go Back</a>
	        </div>
	    </div>
	</div>
</div>