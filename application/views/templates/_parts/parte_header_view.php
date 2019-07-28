<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $page_title;?></title>

	<link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/vendor/bootstrap/css/docs.css" rel="stylesheet">

	<link href="<?=base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<link href="<?=base_url();?>assets/vendor/toastr/toastr.min.css" rel="stylesheet">

	<link href="<?=base_url();?>assets/css/parte-style.css" rel="stylesheet">

	<link href="<?=base_url();?>assets/css/summernote.css" rel="stylesheet">

	<!-- Bootstrap File Input -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileinput/css/fileinput-rtl.min.css" rel="stylesheet">
	
	<!-- Bootstrap Core JavaScript -->
	<script src="<?=base_url();?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?=base_url();?>assets/vendor/jquery/jquery-ui-1.8.24.min.js"></script>

	<script src="<?=base_url();?>assets/vendor/bootstrap/js/utils.js"></script>

	<script src="<?=base_url();?>assets/vendor/bootstrap/js/tether.min.js"></script>

	<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?=base_url();?>assets/vendor/toastr/toastr.min.js"></script>
	
	<?php echo $before_head;?>
</head>
<body>
	<script src="<?=base_url();?>assets/js/base.js"></script>

	<script src="<?=base_url();?>assets/vendor/summernote/summernote.js"></script>

	<script src="<?=base_url();?>assets/vendor/summernote/lang/summernote-pt-BR.js"></script>

	<!-- Bootstrap File Input -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-fileinput/js/fileinput.min.js"></script>
	
	<div class="container-fluid" id="wrap">
		<?php $this->load->view('templates/_parts/parte_menu_view'); ?>