<?php $this->load->view('header') ?>

<section id="pedido_abertura_processo">

	<div class="container">
		<div class="alert alert-success">
			<h3><?php echo $Autor['Nome']; ?>, estamos quase lá!</h3>
			<p>Nessa etapa você deverá anexar seus documentos pessoais e também as provas que julgar necessárias.</p>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<?php $this->load->view('pedido/upload_docs_partial', $Pedido); ?>
			</div>
			<div class="col-sm-6">
				<?php $this->load->view('pedido/upload_provas_partial', $Pedido); ?>
			</div>
		</div>

		<hr>
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="../stepFinal/<?php echo $Pedido['Id'];?>" class="btn btn-primary">Concluir Pedido</a>
			</div>
		</div>

	</div>

</section>
<?php $this->load->view('footer') ?>