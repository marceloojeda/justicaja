<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/addSentenca.js" type="text/javascript"></script>

<section id="addSentenca">
	<div class="container">
		<?php if(empty($dataPost['Sentenca'])) { ?>
		<div class="form-group row">
			<div class="col-sm-4">
				<label for="numProcesso" class="col-form-label">Num. Processo</label>
				<input type="text" class="form-control" readonly name="NumProcesso" id="numProcesso" value="<?php echo $dataPost['processo']->Id;?>">
			</div>

			<div class="col-sm-4">
				<label for="fase" class="col-form-label">Fase Atual</label>
				<input type="text" class="form-control" readonly name="Fase" id="fase" value="<?php echo $dataPost['faseAtual']['Nome'];?>">
			</div>

			<div class="col-sm-4">
				<label for="prazo" class="col-form-label">Prazo</label>
				<input type="text" class="form-control" readonly name="Prazo" id="prazo" value="<?php echo get_formato_brasil(date('Y-m-d', strtotime($dataPost['faseAtual']['DataEntrada']. ' + '. $dataPost['faseAtual']['Prazo']. ' days')),false);?>">
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<form action="<?php echo base_url().'processo/addSentenca/'.$this->uri->segment(3); ?>" enctype="multipart/form-data" method="post">
					<label class="control-label">Select File</label>
					<input id="input-1" type="file" class="file" data-show-preview="false" name="Sentenca">
				</form>
			</div>
		</div>
		<?php } else { ?>
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3>Proposta enviada!</h3>
			</div>
		</div>
		<?php } ?>
	</div>
</section>
<?php $this->load->view('footer') ?>