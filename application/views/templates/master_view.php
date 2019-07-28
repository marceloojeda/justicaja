<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('templates/_parts/master_header_view'); ?>

<div class="content-wrapper">
	<div class="container-fluid">
		
		<?php echo $the_view_content; ?>

	</div>
</div>

<?php $this->load->view('templates/_parts/master_footer_view');?>