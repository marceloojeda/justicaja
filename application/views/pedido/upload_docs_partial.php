<form role="form" action="../uploadDoc" method="post" enctype="multipart/form-data">
	<?php echo form_hidden('PedidoId', $Pedido['Id']); ?>
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Documentos pessoais</h3>
			<h5 class="card-subtitle mb-2 text-muted">suba cópias de seus documentos pessoais ou da empresa</h5>
		</div>
		<div class="card-block">
			<div class="form-group">
				<label>Tipo Documento</label>
				<select name="Tipo" class="form-control">
					<option value="RG">RG</option>
					<option value="CpfCnpj">CPF ou CNPJ</option>
					<option value="Contrato Social">Contrato Social</option>
					<option value="Comprovante Endereço">Comprovante de Endereço</option>
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

<?php if(isset($Documentos)){ if($Documentos !== null) { ?>
<hr>
<ul class="list-group">
	<?php foreach ($Documentos as $key => $doc) { ?>
	<li class="list-group-item small">
		<?php echo $doc['Arquivo']; ?>
		<span class="badge badge-default">
			<?php echo $doc['TipoDocumento']; ?>
		</span>
	</li>
	<?php } ?>
</ul>
<?php } } ?>