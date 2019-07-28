<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('templates/_parts/public_header_view'); ?>

<div class="top-content">
	<div class="inner-bg">
		<div class="container">			
			<?php echo $the_view_content; ?>
		</div>
	</div>
</div>

<?php $this->load->view('templates/_parts/public_footer_view');?>