<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/addSentenca.js" type="text/javascript"></script>

<section id="pedido_abertura_processo">
	<div class="container">
		<?php 
		echo form_hidden('Role', $dataPost['Role']); 
		?>

		<div class="row">
			<div class="alert alert-success">
				<h3>1ª etapa concluída!</h3>
				<p>Nessa etapa você deverá informar os dados do réu.</p>
			</div>
		</div>

		<form action="ConfirmDadosReu" method="post" accept-charset="utf-8" id="form-step2" class="hide">

			<?php $this->load->view('pedido/dados_pessoais');?>

			<div class="row">
				<div class="col-lg-12 text-center">
					<button type="submit" class="btn btn-primary">Avançar</button>
				</div>
			</div>
		</form>
		<div class="row">
		<div class="col-lg-12">
			<?php echo validation_errors(); ?>
		</div>
		</div>
	</div>
</section>

<?php $this->load->view('footer') ?>