<!DOCTYPE html>
<html>
<head>
	<title>Justiça Já</title>
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Bootstrap File Input -->
	<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileinput/css/fileinput-rtl.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet" type="text/css">    

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-ui-1.8.24.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.mask.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mascara.js"></script>
</head>
<body>
	<div class="container">
		<div class="form-signin">
			<h3><?=$dataView['Title'];?></h3>
			<p><?=$dataView['Descricao'];?></p>
		</div>
	</div>
</body>
</html>