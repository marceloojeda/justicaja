<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Painel administrativo da plataforma Justiça Já">
		<meta name="author" content="">

		<title>Justiça Já - Painel administrativo</title>

		<link href="<?php echo base_url(); ?>assets/css/w3.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/summernote.css" rel="stylesheet">
			
		<!-- Custom Fonts -->
    	<link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    	<link href="<?php echo base_url(); ?>assets/css/custom-style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" />
	</head>

	<body>
	
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/base.js"></script>
	<script src="<?=base_url();?>assets/vendor/summernote/summernote.js"></script>

	<script src="<?=base_url();?>assets/vendor/summernote/lang/summernote-pt-BR.js"></script>

		<!-- <div class="w3-bar w3-border w3-light-grey w3-large w3-padding-8">
			<div class="w3-col w3-center" style="width:75px">
				<a href="<?php echo base_url();?>admin" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
			</div>
			
			<div class="w3-dropdown-hover w3-margin-right w3-text-blue">
				<a href="#" class="w3-bar-item w3-button">Pedidos de Abertura
				</a>
				<i class="fa fa-arrow-down" aria-hidden="true"></i>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
					<a href="<?php echo base_url();?>admin/dashboard/pedidolist" class="w3-bar-item w3-button">Consultar</a>
					<a href="#" class="w3-bar-item w3-button">Notificar Reu</a>
					<a href="#" class="w3-bar-item w3-button">Notificar Autor</a>
				</div>
			</div>


			<a href="#" class="w3-bar-item w3-button w3-text-blue w3-margin-right">Analisar Pedidos</a>
			<a href="#" class="w3-bar-item w3-button  w3-text-blue w3-margin-right">Acompanhar Processos</a>
			<a href="<?php echo base_url();?>account/logout" class="w3-bar-item w3-button w3-right w3-margin-right">Sair</a>
		</div> -->
		<div class="w3-bar w3-light-grey w3-padding">
			<a href="<?php echo base_url();?>admin" class="w3-bar-item w3-button">Home</a>

			<div class="w3-dropdown-hover">
				<button class="w3-button">Cadastros das Partes</button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
					<a href="<?php echo base_url();?>admin/dashboard/pedidolist" class="w3-bar-item w3-button">Atualizar Contato</a>
				</div>
			</div>

			<div class="w3-dropdown-hover">
				<button class="w3-button">Pedidos Abertura</button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
					<a href="<?php echo base_url();?>admin/dashboard/pedidolist" class="w3-bar-item w3-button">Consultar Pedidos</a>
					<a href="<?php echo base_url();?>admin/AnalysiPedido/manifestacoesPedidos" class="w3-bar-item w3-button">Manifestações Réus</a>
					<a href="<?php echo base_url();?>admin/Notification" class="w3-bar-item w3-button">Notificar Parte</a>
					<a href="<?php echo base_url();?>admin/AnalysiPedido" class="w3-bar-item w3-button">Converter em Processo</a>
				</div>
			</div>

			<div class="w3-dropdown-hover">
				<button class="w3-button">Processos</button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
					<!--
					<a href="<?php echo base_url();?>admin/dashboard/listarProcessos" class="w3-bar-item w3-button">Consultar Processos</a>
					!-->
					<a href="<?php echo base_url();?>admin/dashboard/tramitar" class="w3-bar-item w3-button">Tramitar Processo</a>
				</div>
			</div>
			
			<a href="<?php echo base_url();?>Account/Logout" class="w3-bar-item w3-button w3-right">Sair</a>
		</div>
	