<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Painel administrativo da plataforma Justiça Já">
	<meta name="author" content="">

	<title>Justiça Já</title>

	<link href="<?php echo base_url(); ?>assets/css/w3.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
</head>
<body>
	<div class="w3-container w3-margin">
		<div class="w3-panel w3-center">
			<h2><?php echo $dataView['Title']; ?></h2>
			<p><?php echo $dataView['Subtitle']; ?></p>
		</div>

		<div class="w3-row">
			<div class="w3-half">
				Autor: <?php echo $dataView['Autor']['Nome']; ?>
			</div>
			<div class="w3-half">
				Réu: <?php echo $dataView['Reu']['Nome']; ?>
			</div>
		</div>
	</div>
</body>
</html>