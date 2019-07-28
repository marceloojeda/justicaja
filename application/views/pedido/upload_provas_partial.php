<form role="form" action="../uploadProva" method="post" enctype="multipart/form-data">
	<?php echo form_hidden('PedidoId', $Pedido['Id']); ?>
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Provas do pedido</h3>
			<h5 class="card-subtitle mb-2 text-muted">suba arquivos, fotos e videos que embasam suas razões</h5>
		</div>
		<div class="card-block">
			<div class="form-group">
				<label>Tipo Arquivo</label>
				<select name="Tipo" class="form-control" id="tipoProva">
					<option value="Testemunho">Testemunho</option>
					<option value="Vídeo">Vídeo</option>
					<option value="Foto">Foto</option>
					<option value="Outros">Outros</option>
				</select>
			</div>
			<div class="form-group">
				<label>Observações</label>
				<textarea id="txtObs" name="Observacao" rows="5" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label>Arquivo</label>
				<input id="inputDoc" type="file" class="file" data-show-preview="false" name="FileDoc">
			</div>
		</div>
	</div>
</form>

<?php if(isset($Provas)){ if($Provas !== null) { ?>
<hr>
<ul class="list-group">
	<?php foreach ($Provas as $key => $doc) { ?>
	<li class="list-group-item small">
		<?php echo $doc['Arquivo']; ?>
		<span class="badge badge-default">
			<?php echo $doc['TipoProva']; ?>
		</span>
	</li>
	<?php } ?>
</ul>
<?php } } ?>