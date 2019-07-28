<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/admin/analysi/converter_pedido.js" type="text/javascript"></script>

<section id="pedidoList">
	<div class="container">
		<div class="w3-card w3-margin">
			<form action="<?php echo base_url();?>admin/AnalysiPedido" method="post">
				<?php 
					$this->load->view('admin/shared/FiltroPedidos_Partial', $dataPost);
					$this->load->view('admin/analysi/listagem_confirmacao_partial');
				?>
			</form>
		</div>
	</div>
</section>
<?php $this->load->view('admin/shared/footer') ?>