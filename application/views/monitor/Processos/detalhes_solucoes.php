<div id="solucoes" class="w3-container w3-border w3-padding city" style="display:none">
	<?php if($Solucoes) { ?>
		<p>
			<b>Atenção: </b>Recomenda-se que leia e examine todas as propostas enviadas antes de enivar uma nova. <br>
			Propostas de soluções equivalentes estarão sujeitas a remoção pelo Administrador do sistema.
		</p>
		<div class="w3-row-padding w3-margin-bottom">
			<input type="hidden" id="urlVotacao" value="<?= $UrlVotacao ?>">
			<ul class="w3-ul w3-card-4">
				<?php foreach ($Solucoes as $solucao) { ?>
					<li class="w3-display-container">
						<a href="<?php echo base_url().'assets/uploads/processos/'.$solucao['Arquivo'] ?>" class="w3-text-blue">
							Clique aqui para ver a solução
						</a> 
						<?php if($PodeManifestar) { ?>
						<span data-id="<?=$solucao['SolucaoId'];?>" class="w3-button w3-transparent w3-display-right w3-text-green" name="Apoiar">
							<i class="fa fa-check-square-o" aria-hidden="true"></i> Votar
						</span>
						<?php } ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	<?php } else { ?>
		<div class="w3-row-padding w3-margin-bottom">
			<h4>Nenhuma proposta de solução enviada</h4>
			<h4>Quer enviar uma proposta?</h4>
		</div>
	<?php } ?>
	<hr>
	<?php if($PodeManifestar) { ?>
		<div class="w3-row-padding w3-margin-bottom center">
			<div class="w3-third">
				<button type="button" onclick="document.getElementById('addSolucao').style.display='block'" class="w3-btn w3-button w3-block w3-blue">Propor Solução</button>
			</div>
		</div>
	<?php } ?>
</div>

<!-- The Modal -->
<div id="addSolucao" class="w3-modal">
	<div class="w3-modal-content">
		<div class="w3-container w3-padding">
			<span onclick="document.getElementById('addSolucao').style.display='none'" 
			class="w3-button w3-display-topright">&times;</span>
			<form action="<?php echo base_url().'monitor/Processo/addSentenca/'.$Processo->Id; ?>" enctype="multipart/form-data" method="post" onsubmit="">
				<label class="control-label">Solução em PDF</label>
				<input id="arquivoSolucao" type="file" class="file" data-show-preview="false" name="Sentenca" accept="application/pdf" >
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('shared/info-dialog'); ?>