<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/pedidoList.js" type="text/javascript"></script>

<section id="pedidoList">
	<div class="container">
		<div class="w3-card w3-margin">

			<?php 
				$this->load->view('admin/shared/FiltroPedidos_Partial', $dataPost);
				$this->load->view('admin/notification/lista_partial');
			?>
		</div>
	</div>
</section>
<?php $this->load->view('admin/shared/footer') ?>