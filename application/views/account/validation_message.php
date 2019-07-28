<?php if (isset($dataPost['FormValidation'])) { 
	if($dataPost['FormValidation'] == FALSE) {
?>

<div class="alert alert-warning alert-dismissable">
	<a class="panel-close close" data-dismiss="alert">×</a> 
	<i class="fa fa-exclamation-triangle"></i>
	<?php echo validation_errors(); ?>
</div>

<?php } else { ?>

<div class="alert alert-success alert-dismissable">
	<a class="panel-close close" data-dismiss="alert">×</a> 
	<i class="fa fa-smile"></i>
	
	<?php if($dataPost['stage'] == "andressInfo") { ?>
	<h3>Dados pessoais ok!</h3>
	<p>Nessa etapa você deve informar os dados do seu endereço.</p>
	<?php } ?>

	<?php if($dataPost['stage'] == "loginInfo") { ?>
	<h3>Endereço ok!</h3>
	<p>Nessa etapa você deve informar os dados de login.</p>
	<?php } ?>

	<?php if($dataPost['stage'] == "finally") { ?>
	<h3>Pronto!</h3>
	<p>
		Seu cadastro foi concluído com sucesso. Deseja acessar nossa plataforma? <a href="#">clique aqui</a></p>
	<?php } ?>
</div>

<?php } } ?>