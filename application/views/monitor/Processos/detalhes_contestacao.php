<div id="contestacao" class="w3-container w3-border w3-padding city" style="display:none">
	<?php if(!$Contestacao) { ?>
		<div class="w3-row-padding w3-margin-bottom">
			<p class='w3-center w3-margin-top'>não informado pela parte</p>
		</div>
	<?php } else { ?>
		<div class="w3-row-padding w3-margin-bottom">
			<b>Contestação Escrita</b>
			<p><?=$Contestacao['Texto']?></p>
		</div>

		<?php if($ContestacaoDocs) { ?>
			<div class="w3-row-padding w3-margin-bottom">
				<b>Arquivos Anexados</b>
				<ul class="w3-ul w3-hoverable">
					<?php foreach ($ContestacaoDocs as $prova) { ?>
						<li>
							<a href="<?php echo base_url().'assets/uploads/pedidos/'.$prova->Arquivo ?>" download>
								<?=$prova->Arquivo?>
							</a>
							<span class="w3-right w3-text-blue"><?=$prova->TipoDocumento?></span>
							<?php if($prova->Observacao) { ?>
								<p><?= $prova->Observacao ?></p>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	<?php } ?>
</div>