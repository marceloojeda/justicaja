

<?php
if(isset($dataPost["Sintetico"])){
	if(!$dataPost["Sintetico"]) { 
?>

<div class="row">
	<div class="col-lg-12">
		<fieldset>
			<legend>Endereço</legend>
			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="endereco">Endereço</label>
					<input type="text" id="endereco" name="Endereco" readonly value="<?php echo $Endereco ?>" class="form-control">
				</div>
				<div class="col-sm-6 form-group">
					<label for="numero">Numero/Lote</label>
					<input type="text" id="numero" name="Numero" readonly value="<?php echo $Numero ?>" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="complemento">Complemento do endereco</label>
					<input type="text" id="complemento" name="ComplementoEndereco" readonly value="<?php echo $ComplementoEndereco ?>" class="form-control">
				</div>
				<div class="col-sm-6 form-group">
					<label for="bairro">Bairro/Setor</label>
					<input type="text" id="bairro" name="Bairro" readonly value="<?php echo $Bairro ?>" class="form-control">
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="cidade">Cidade</label>
					<input type="text" id="cidade" name="Cidade" readonly value="<?php echo $Cidade ?>" class="form-control">
				</div>
				<div class="col-sm-6 form-group">
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="uf">UF</label>
							<input type="text" id="uf" name="UF" readonly value="<?php echo $UF ?>" class="form-control">
						</div>
						<div class="col-sm-6 form-group">
							<label for="cep">CEP</label>
							<input type="text" id="cep" name="CEP" readonly value="<?php echo $CEP ?>" class="form-control">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<?php }} ?>



<div class="row">
	<div class="col-lg-12">
		<fieldset>
			<legend>Documentos anexados</legend>
			<ul class="list-group">
			<?php if(isset($dataPost['Documentos'])) { foreach ($dataPost['Documentos'] as $key => $doc) { ?>
				<li class="list-group-item justify-content-between">
					<?php 
					echo 
					"<a href='"
					.base_url()
					."assets/uploads/pedidos/"
					.$doc['Arquivo']
					."' target='_blank'>"
					.$doc['Arquivo']
					."</a>";
					?>
					<span class="badge badge-pill badge-default">
						<?php echo $doc['TipoDocumento']; ?>
					</span>
				</li>
				<?php } } ?>
			</ul>
		</fieldset>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<fieldset>
			<legend>Provas anexadas</legend>
			<ul class="list-group">
			<?php if(isset($dataPost['Provas'])) { foreach ($dataPost['Provas'] as $key => $prova) { ?>
				<li class="list-group-item justify-content-between">
					<?php 
					echo 
					"<a href='"
					.base_url()
					."assets/uploads/pedidos/"
					.$prova['Arquivo']
					."' target='_blank'>"
					.$prova['Arquivo']
					."</a>";
					?>
					<span class="badge badge-pill badge-default">
						<?php echo $prova['TipoProva']; ?>
					</span>
				</li>
				<?php } } ?>
			</ul>
		</fieldset>
	</div>
</div>