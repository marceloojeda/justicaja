<div id="razoes" class="w3-container w3-border w3-padding city" style="display:none">
	<div class="w3-row-padding w3-margin-bottom">
		<b>Razões do Processo</b>
		<p><?=$Razoes['Razoes']?></p>
	</div>

	<div class="w3-row-padding w3-margin-bottom">
		<b>Provas Anexadas</b>
		<ul class="w3-ul w3-hoverable">
			<?php
			foreach ($RazoesProvas as $prova) {
			?>
			<li>
				<a href="<?php echo base_url().'assets/uploads/pedidos/'.$prova['Arquivo'] ?>" download>
					<?=$prova['Arquivo']?>
				</a>
				<span class="w3-right w3-text-blue"><?=$prova['TipoProva']?></span>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>