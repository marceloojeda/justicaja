<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/admin/tramitar.js" type="text/javascript"></script>

<div class="container" id="pedidoList">
	<div class="w3-card w3-margin">
		<form action="<?php echo base_url();?>admin/Dashboard/tramitar" method="post">
			<?php 
				$this->load->view('admin/processo/filtro_partial', $dataPost);
				$this->load->view('admin/processo/listagem_partial');
			?>
			<div class="w3-center">
				<button type="button" id="btnSintese" class="w3-button w3-teal">Ver Síntese</button>
				<button type="button" id="btnSolucoes" class="w3-button w3-teal">Ver Soluções & Votação</button>
				<button type="button" id="btnFase" class="w3-button w3-teal">Mudar de Fase</button>
				<button class="w3-button w3-teal">Julgar Processo</button>
			</div>
		</form>
	</div>
</div>
<?php 
	$this->load->view('admin/processo/sintese_partial');
	$this->load->view('admin/processo/solucoes_partial');
	$this->load->view('admin/processo/fase_partial');
	$this->load->view('admin/shared/footer');
?>