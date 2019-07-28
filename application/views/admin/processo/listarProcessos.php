<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/admin/analysi/converter_pedido.js" type="text/javascript"></script>

<section id="pedidoList">
	<div class="container">
		<div class="w3-card w3-margin">
			<form action="<?php echo base_url();?>admin/Dashboard/listarProcessos" method="post">
				<?php 
					$this->load->view('admin/processo/filtro_partial', $dataPost);
					$this->load->view('admin/processo/listagem_partial');
				?>
			</form>
		</div>
	</div>
</section>
<?php $this->load->view('admin/shared/footer') ?>