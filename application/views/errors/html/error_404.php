<?php flash_message('error_msg', 'danger'); ?>
<div class="text-center">
	<h2 class="text-bold">Page not found!</h2>
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