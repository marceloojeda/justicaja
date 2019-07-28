<?php
	echo form_hidden("TipoPessoa_Reu", $dataPost["Reu"]["Tipo"]);
	echo form_hidden("TipoDocumento_Reu", $dataPost["Reu"]["DocumentoTipo"]);
	echo form_hidden("Reu[Id]", $dataPost["Reu"]["Id"]);
	echo form_hidden("Reu[DataCadastro]", $dataPost["Reu"]["DataCadastro"]);
?>

<div class="w3-panel w3-light-grey">
	<h5>Dados pessoais</h5>

	<div class="w3-row-padding" style="margin:0 -16px;">
		<div class="w3-half w3-margin-bottom">
			<label for="tipoPessoa">Tipo Pessoa</label>
			<select class="w3-select w3-border" id="tipoPessoa_Reu" name="Reu[Tipo]">
				<option value="Pessoa Física">Pessoa Física</option>
				<option value="Pessoa Jurídica">Pessoa Jurídica</option>
			</select>
		</div>
		<div class="w3-half">
			<label>Nome/Razão Social</label>
			<input type="text" name="Reu[Nome]" value="<?php echo $dataPost['Reu']['Nome']; ?>" class="w3-input w3-border">
		</div>
	</div>

	<div class="w3-row-padding" style="margin:0 -16px;">
		<div class="w3-half w3-margin-bottom">
			<label for="tipoPessoa">CPF/CNPJ</label>
			<input type="text" name="Reu[CpfCnpj]" value="<?php echo $dataPost['Reu']['CpfCnpj']; ?>" class="w3-input w3-border">
		</div>
		<div class="w3-half">
			<div class="w3-half">
				<label for="tipoDoc" class="w3-block w3-padding-top">Tipo Doc.</label>
				<select class="w3-select w3-border" id="tipoDoc_Reu" name="Reu[DocumentoTipo]">
					<option value="RG" selected>RG</option>
					<option value="Cart. Motorista">Cart. Motorista</option>
					<option value="OAB">OAB</option>
				</select>
			</div>
			<div class="w3-half">
				<label for="numDoc">Nº Documento</label>
				<input type="text" id="numDoc" name="Reu[DocumentoNumero]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['DocumentoNumero']; ?>">
			</div>
		</div>
	</div>
</div>

<div class="w3-panel w3-light-grey">
	<h5>Dados de contato</h5>
	<div class="w3-row-padding" style="margin:0 -16px;">
		<div class="w3-half w3-margin-bottom">
			<label for="email">Email</label>
			<input type="text" id="email" name="Reu[Email]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['Email']; ?>">
		</div>
		<div class="w3-half">
			<div class="w3-half">
				<label for="telefone">Fone fixo</label>
				<input type="text" id="telefone" name="Reu[FoneFixo]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['FoneFixo']; ?>">
			</div>
			<div class="w3-half">
				<label for="celular">Celular</label>
				<input type="text" id="celular" name="Reu[Celular]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['Celular']; ?>">
			</div>
		</div>
	</div>
</div>

<div class="w3-panel w3-light-grey">
	<h5>Dados do endereço</h5>
	<div class="w3-row-padding" style="margin:0 -16px;">
		<div class="w3-half w3-margin-bottom">
			<div class="w3-third">
				<label for="cep">CEP</label>
				<input type="text" id="cep" name="Reu[CEP]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['CEP']; ?>">
			</div>
			<div class="w3-twothird">
				<label for="endereco">Endereço</label>
				<input type="text" id="endereco" name="Reu[Endereco]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['Endereco']; ?>">
			</div>
		</div>
		<div class="w3-half">
			<div class="w3-half">
				<label for="numero">Casa/Lote</label>
				<input type="text" id="numero" name="Reu[Numero]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['Numero']; ?>">
			</div>
			<div class="w3-half">
				<label for="complemento">Complemento</label>
				<input type="text" id="complemento" name="Reu[ComplementoEndereco]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['ComplementoEndereco']; ?>">
			</div>
		</div>
	</div>

	<div class="w3-row-padding" style="margin:0 -16px;">
		<div class="w3-half w3-margin-bottom">
			<label for="bairro">Bairro/Setor</label>
			<input type="text" id="bairro" name="Reu[Bairro]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['Bairro']; ?>">
		</div>
		<div class="w3-half">
			<div class="w3-twothird">
				<label for="cidade">Cidade</label>
				<input type="text" id="cidade" name="Reu[Cidade]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['Cidade']; ?>">
			</div>
			<div class="w3-third">
				<label for="uf">UF</label>
				<input type="text" id="uf" name="Reu[UF]" class="w3-input w3-border" value="<?php echo $dataPost['Reu']['UF']; ?>">
			</div>
		</div>
	</div>
</div>