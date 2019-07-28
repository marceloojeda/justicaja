<hr>
<div class="w3-row-padding">
	<table class="w3-table w3-striped w3-margin-bottom" id="lista-processos">
		<thead>
			<tr>
				<th>Abertura</th>
				<th>Autor</th>
				<th>Reu</th>
				<th>Fase</th>
				<th class="w3-center">Votos</th>
				<th>Prazo</th>
			</tr>
		</thead>
		<tfoot></tfoot>
		<tbody>
			<?php 
			$this->load->helper('enum');
			if($dataPost['Processos'] !== null) { foreach ($dataPost['Processos'] as $key => $processo) { 
			?>
			<tr data-id="<?=$processo['Id']; ?>" class="" style="cursor: pointer;">
				<td class="align-middle "><?php echo get_formato_brasil($processo['DataAbertura'],true); ?></td>
				<td class="align-middle"><?php echo $processo['Autor']; ?></td>
				<td class="align-middle"><?php echo $processo['Reu']; ?></td>
				<td class="align-middle text-center"><?=$processo['FaseAtual'];?></td>
				<td class="w3-center"><?=$processo['NumeroVotos'];?></td>
				<td>
					<select class="w3-select" id="statusLoad" onchange="setStatusLoad(this)">
						<option value="<?=PRAZO_PARADO?>" <?=$processo['StatusLoad'] == PRAZO_PARADO ?'selected':''?> >Parado</option>
						<option value="<?=PRAZO_CONTANDO?>" <?=$processo['StatusLoad'] == PRAZO_CONTANDO ?'selected':''?> >Contando</option>
						<option value="<?=PRAZO_SUSPENSO?>" <?=$processo['StatusLoad'] == PRAZO_SUSPENSO ?'selected':''?> >Suspenso</option>
					</select>
				</td>
			</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>