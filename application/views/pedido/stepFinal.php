<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/pedido_abertura.js" type="text/javascript"></script>

<section id="pedido_abertura_processo">
	<div class="container">
		<div class="row">
			<div class="alert alert-success">
			<h3>Pronto sr(a) <?php echo $dataPost['Autor']['Nome'];?>!</h3>
				<p>Seu pedido de abertura de processo na plataforma Justiça Já foi realizado com sucesso. Entreremos em contado em breve!</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<h2>Dados do pedido</h2>
				<hr>
			</div>
			<div class="col-lg-12">
				<?php $this->load->view('pedido/autor_conf_partial', $dataPost['Autor']); ?>
			</div>

			<div class="col-lg-12">
				<?php $this->load->view('pedido/reu_conf_partial', $dataPost['Reu']); ?>
			</div>

			<div class="col-lg-12">
				<?php $this->load->view('pedido/razoes_conf_partial', $dataPost['Pedido']); ?>
			</div>
		</div>

	</div>
</section>
<?php $this->load->view('footer') ?>