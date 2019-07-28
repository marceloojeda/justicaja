<div class="col-md-9 personal-info">
	
	<?php $this->load->view('account/validation_message');?>
	
	<h3>Meus Dados</h3>

	<form class="form-horizontal" role="form" action="SavePersonalInfo" method="post">
		<?php echo form_hidden('Id', $dataPost['result']['Id']); ?>
		<div class="form-group">
			<label class="col-lg-3 control-label">Nome completo:</label>
			<div class="col-lg-8">
				<input class="form-control" name="Nome" required type="text" value="<?php echo $dataPost['result']['Nome']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">E-mail:</label>
			<div class="col-lg-8">
				<input class="form-control" type="text" value="<?php echo $dataPost['result']['Email']; ?>" name="Email" required>
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Celular:</label>
			<div class="col-lg-8">
				<input class="form-control" name="Celular" required type="text" value="<?php echo $dataPost['result']['Celular']; ?>" onkeypress="mascara(this, '## #####-####')" maxlength="13">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Fone Fixo:</label>
			<div class="col-lg-8">
				<input class="form-control" name="Telefone" type="text" value="<?php echo $dataPost['result']['FoneFixo']; ?>" onkeypress="mascara(this, '## ####-####')" maxlength="12">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Tipo Pessoa:</label>
			<div class="col-lg-8">
				<select class="form-control" id="tipoPessoa" name="Tipo">
					<option value="Pessoa Física">Pessoa Física</option>
					<option value="Pessoa Jurídica">Pessoa Jurídica</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">CPF/CNPJ:</label>
			<div class="col-lg-8">
				<input class="form-control cpfOuCnpj" name="CpfCnpj" required type="text" value="<?php echo $dataPost['result']['CpfCnpj'];?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Tipo Documento:</label>
			<div class="col-lg-8">
				<select class="form-control" id="tipoDoc" name="DocumentoTipo">
					<option value="RG">RG</option>
					<option value="Cart. Motorista">Cart. Motorista</option>
					<option value="OAB">OAB</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-lg-3 control-label">Numero Documento:</label>
			<div class="col-lg-8">
				<input class="form-control" name="DocumentoNumero" type="text" value="<?php echo $dataPost['result']['DocumentoNumero']; ?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-8">
				<button type="submit" class="btn btn-primary">Save Changes</button>
				<span></span>
			</div>
		</div>
	</form>
</div>