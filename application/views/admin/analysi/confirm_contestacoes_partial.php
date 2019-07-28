<div class="w3-panel w3-light-grey">
	<h5>Razões do autor</h5>
	<div class="w3-panel">
		<?php echo $dataPost["Pedido"]["Razoes"]; ?>
	</div>
</div>

<div class="w3-panel">
	<h5>Contestações do réu</h5>
	
	<table class="w3-table-all" id="tabela-notificacoes">
		<thead class="w3-grey">
			<tr>
				<th>Data</th>
				<th>Tipo Arquivo</th>
				<th>Link</th>
				<th>Observação</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if($dataPost['Contestacoes']) {
					foreach ($dataPost['Contestacoes'] as $key => $value) { 
			?>
			<tr>
				<td><?php echo get_formato_brasil($value['DataCadastro'],false); ?></td>
				<td><?php echo $value["TipoDocumento"]; ?></td>
				<td><?php echo $value["Arquivo"]; ?></td>
				<td><?php echo strip_tags($value["Observacao"]); ?></td>
			</tr>
			<?php } } else { ?>
			<tr>
				<td colspan="4" class="w3-center">nenhuma contestação foi enviada</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
</div>