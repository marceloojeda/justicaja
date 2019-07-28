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
	<script language="javascript">
		function mostrarFormulario(){
			$('#verifica-cadastro').addClass('hide');
			$('#formulario-cadastro').removeClass('hide');
		}
	</script>
	<div class="container">
		<h2 class="form-signin-heading"><?=$dataView['Title'];?></h2>
		<p class="text-muted"><?=$dataView['Subtitle'];?></p>
		<div class="row row-justified" id="verifica-cadastro">
			<div class="col-sm-6">
				<div class="btn-group btn-group-justified" role="group">
					<div class="btn-group" role="group">
						<a href="<?php echo sprintf('%smonitor?hashTag=%s', base_url(), $this->input->get('hashTag')); ?>" class="btn btn-info">Já Tenho Cadastro</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="btn-group btn-group-justified" role="group">
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default" onclick="mostrarFormulario()">Ainda Não Tenho Cadastro</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row hide" id="formulario-cadastro">
			<form class="form-signin" action="<?=base_url()?>Welcome/salvarDadosReu" method="post">
				

				<?php if($dataView['Erro']) { ?>
				<div class="alert alert-danger" id="cadastro-alert">
					<?=$dataView['Erro']?>
				</div>
				<?php } ?>

				<label for="inputEmail" class="sr-only">E-mail</label>
				<input type="email" id="inputEmail" name="email" class="form-control" placeholder="E-mail" required="" autofocus="">

				<label for="inputNome" class="sr-only">Nome completo</label>
				<input type="text" id="inputNome" name="nome" class="form-control" placeholder="Nome completo" required="">

				<label for="inputFone" class="sr-only">Telefone</label>
				<input type="tel" id="inputFone" name="telefone" class="form-control telefone" placeholder="Telefone">

				<label for="inputPassword" class="sr-only">Senha</label>
				<input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required="">

				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Lí e concordo com os <a href="#"> Termos de Uso</a> da Plataforma Justiça Já
					</label>
				</div>

				<input type="hidden" name="reuId" value="<?=$dataView['Pedido']['ReuId']?>">
				<input type="hidden" name="hashTag" value="<?=$this->input->get('hashTag');?>">

				<div class="text-center">
					<button class="btn btn-lg btn-primary" type="submit">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
		    $(".telefone").mask(SPMaskBehavior, spOptions);
		});
	</script>
</body>
</html>