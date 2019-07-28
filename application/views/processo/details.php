<?php $this->load->view('header') ?>
<section id="details">
	<div class="container">
	<div class="row mt-4">
		<div class='col-lg-12'>
			<div class='row'>
				<div class='col-lg-4 text-center'>
					<h3>abertura</h4>
					<h6 class='mb-2 text-muted'>
						<?php echo $dataPost['results']->DataAbertura ?>
					</h6>
				</div>
				<div class='col-lg-4 text-center'>
					<h4 class='card-title'>prazo propor solução</h4>
					<h6 class='card-subtitle mb-2 text-muted'>
						<?php echo $dataPost['results']->PrazoSolucao ?>
					</h6>
				</div>
				<div class='col-lg-4 text-center'>
					<h4 class='card-title'>prazo votação</h4>
					<h6 class='card-subtitle mb-2 text-muted'>
						<?php echo $dataPost['results']->PrazoVotacao ?>
					</h6>
				</div>
			</div>
			<hr>
			<h3>Síntese do Processo</h3>
			<p><?php echo $dataPost['results']->Sintese ?></p>
			<hr>
			<h3>Peças do Processo</h3>
			<p><a href="<?php echo base_url().'assets/peticaoInicial.pdf';?>">Petição Inicial</a></p>
			<p><a href="<?php echo base_url().'assets/peticaoInicial.pdf';?>">Contestação</a></p>
			<p><a href="<?php echo base_url().'assets/peticaoInicial.pdf';?>">Réplica</a></p>
			<p><a href="<?php echo base_url().'assets/peticaoInicial.pdf';?>">Tréplica</a></p>
	  	</div>
	</div>
	</div>
</section>
<?php $this->load->view('footer') ?>