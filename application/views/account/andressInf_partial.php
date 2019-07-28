<div class="col-md-9 personal-info">
	
	<?php $this->load->view('account/validation_message');?>
	
	<h3>Andress Info</h3>

	<form class="form-horizontal" role="form" action="SaveAndressInfo" method="post">
		<?php echo form_hidden('Id', $dataPost['result']['Id']); ?>
		<div class="form-group">
			<label class="col-lg-3 control-label">CEP:</label>
			<div class="col-lg-8">
				<input class="form-control" id="cep" name="CEP" type="text" value="<?php echo $dataPost['result']['CEP']; ?>" onkeypress="mascara(this, '#####-###')" maxlength="9">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Endereço:</label>
			<div class="col-lg-8">
				<input class="form-control" id="rua" name="Endereco" type="text" value="<?php echo $dataPost['result']['Endereco']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Numero/Lote:</label>
			<div class="col-lg-8">
				<input class="form-control" name="Numero" type="text" value="<?php echo $dataPost['result']['Numero']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Complemento endereço:</label>
			<div class="col-lg-8">
				<input class="form-control" name="ComplementoEndereco" type="text" value="<?php echo $dataPost['result']['ComplementoEndereco']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Bairro/Setor:</label>
			<div class="col-lg-8">
				<input class="form-control" id="bairro" name="Bairro" type="text" value="<?php echo $dataPost['result']['Bairro']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Cidade:</label>
			<div class="col-lg-8">
				<input class="form-control" id="cidade" name="Cidade" type="text" value="<?php echo $dataPost['result']['Cidade']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">UF:</label>
			<div class="col-lg-8">
				<input class="form-control" id="uf" name="UF" type="text" value="<?php echo $dataPost['result']['UF']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-8">
				<button type="submit" class="btn btn-primary">Save Changes</button>
				<span></span>
			</div>
		</div>
	</form>
</div>