<div class="row">
	<div class="col-lg-12">
	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th>Codigo</th>
				<th>Descrição</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dataPost["TabelaPreco"] as $key => $value) { ?>
			<tr>
				<td>
					<input type="checkbox" name="PlanoId" value="<?php echo $value['Id'];?>">
				</td>
				<td><?php echo $value['Codigo'];?></td>
				<td><?php echo $value['Descricao'];?></td>
				<td><?php echo $value['Valor'];?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
</div>