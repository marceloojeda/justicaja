<div class="w3-panel w3-light-grey">
	<h5>Provas anexadas</h5>

	<table class="w3-table w3-striped w3-margin-top">
		<thead>
			<tr>
				<th class="w3-quarter">Tipo</th>
				<th class="w3-half">Nome do arquivo</th>
				<th class="w3-quarter"></th>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($dataPost['Provas'])) { foreach ($dataPost['Provas'] as $key => $prova) { ?>
			<tr>
				<td class="w3-quarter"><?php echo $prova['TipoProva']; ?></td>
				<td class="w3-half"><?php echo $prova['Arquivo']; ?></td>
				<td class="w3-quarter w3-right-align">
					<a href="<?php echo base_url().'assets/uploads/pedidos/'.$prova['Arquivo'] ?>" class="w3-btn w3-ripple w3-block w3-khaki">Download</a>
				</td>
			</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>