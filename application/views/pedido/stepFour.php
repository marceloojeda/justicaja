<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/pedido_abertura.js" type="text/javascript"></script>

<section id="pedido_abertura_processo">
	<div class="container">
		<form action="ConfirmSetp3" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="alert alert-success">
					<h3>2ª etapa concluída!</h3>
					<p>Nessa etapa você deverá anexar seus documentos pessoais e da parte do contrato que possui a Cláusula Arbitral, se for o caso.</p>
				</div>
			</div>
			
			<input type="hidden" name="PedidoId" value="<?php echo $dataPost['Pedido']['Id'];?>">
			<?php $this->load->view('pedido/documentos_pessoais');?>
			
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