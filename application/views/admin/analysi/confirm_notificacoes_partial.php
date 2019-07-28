<div class="w3-panel w3-light-grey">
	<h5>Observações</h5>
	<div class="w3-panel">
		<?php echo $dataPost["Analise"]["Observacao"]; ?>
	</div>
</div>

<div class="w3-panel">
	<h5>Notificações</h5>
	
	<table class="w3-table-all" id="tabela-notificacoes">
		<thead class="w3-grey">
			<tr>
				<th>Data</th>
				<th>Parte</th>
				<th>Meio</th>
				<th>Mensagem</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if($dataPost['Notificacoes']) {
					foreach ($dataPost['Notificacoes'] as $key => $value) { 
			?>
			<tr>
				<td><?php echo get_formato_brasil($value['Data'],false); ?></td>
				<td><?php echo $value["ParteTipo"]; ?></td>
				<td><?php echo $value["Meio"]; ?></td>
				<td><?php echo strip_tags($value["Observacao"]); ?></td>
			</tr>
			<?php } } else { ?>
			<tr>
				<td colspan="4" class="w3-center">nenhuma notificação foi enviada</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
</div>