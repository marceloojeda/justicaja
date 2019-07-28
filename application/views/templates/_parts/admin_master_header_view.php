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
      
    <!-- Custom Fonts -->
      <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url(); ?>assets/css/custom-style.css" rel="stylesheet" type="text/css">

      <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
  </head>
  <body>
    <div class="w3-bar w3-light-grey w3-padding">
      <a href="<?php echo base_url();?>admin" class="w3-bar-item w3-button">Home</a>

      <div class="w3-dropdown-hover">
        <button class="w3-button">Cadastros das Partes</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="<?=base_url();?>admin/ProcessoPartes/listarPartes" class="w3-bar-item w3-button">Atualizar Contato</a>
        </div>
      </div>

      <div class="w3-dropdown-hover">
        <button class="w3-button">Pedidos Abertura</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="<?php echo base_url();?>admin/dashboard/pedidolist" class="w3-bar-item w3-button">Consultar Pedidos</a>

          <a href="<?php echo base_url();?>admin/dashboard/manifestacoesPedidos" class="w3-bar-item w3-button">Manifestações Réus</a>

          <a href="<?php echo base_url();?>admin/Notification" class="w3-bar-item w3-button">Notificar Parte</a>
          <a href="<?php echo base_url();?>admin/AnalysiPedido" class="w3-bar-item w3-button">Converter em Processo</a>
        </div>
      </div>

      <div class="w3-dropdown-hover">
        <button class="w3-button">Processos</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="<?php echo base_url();?>admin/dashboard/listarProcessos" class="w3-bar-item w3-button">Consultar Processos</a>
        </div>
      </div>
      
      <a href="<?php echo base_url();?>Account/Logout" class="w3-bar-item w3-button w3-right">Sair</a>
    </div>