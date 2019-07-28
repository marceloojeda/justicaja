<div class="panel panel-default">
	<div class="panel-heading" style="cursor: pointer;" onclick="AccordionToggle('provasPanel')">Provas Anexadas pelo Autor</div>
	<div class="panel-body hide" id="provasPanel">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="col-md-3">Tipo</th>
					<th class="col-md-6">Nome do arquivo</th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($DadosView['Provas'])) { foreach ($DadosView['Provas'] as $key => $doc) { ?>
				<tr>
					<td class="col-md-3"><?php echo $doc['TipoProva']; ?></td>
					<td class="col-md-6"><?php echo $doc['Arquivo']; ?></td>
					<td class="col-md-3 text-right">
						<a href="<?php echo base_url().'assets/uploads/pedidos/'.$doc['Arquivo'] ?>" class="w3-btn w3-ripple w3-block w3-khaki">Download</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>