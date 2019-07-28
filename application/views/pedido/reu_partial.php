
<div id="accordionReu" role="tablist" aria-multiselectable="true">
	<div class="card">
		<div class="card-header-collapse" role="tab" id="headingOneReu">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordionReu" href="#collapseOneReu" aria-expanded="true" aria-controls="collapseOneReu">
					Dados pessoais (Réu)
				</a>
			</h5>
		</div>

		<div id="collapseOneReu" class="collapse show" role="tabpanel" aria-labelledby="headingOneReu">
			<div class="card-block">
				<div class="col-sm-12 bg-white">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="tipoPessoa">Tipo Pessoa</label>
								<select class="form-control" id="tipoPessoa" name="TipoReu">
									<?php if($DadosView['Reu']['Tipo'] == "Pessoa Física") { ?>
									<option value="Pessoa Física" selected>Pessoa Física</option>
									<option value="Pessoa Jurídica">Pessoa Jurídica</option>
									<?php } else { ?>
									<option value="Pessoa Física">Pessoa Física</option>
									<option value="Pessoa Jurídica" selected>Pessoa Jurídica</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-9">
								<label for="nomeReu">Nome/Razão social</label>
								<input type="text" id="nomeReu" name="NomeReu" class="form-control" value="<?php echo $DadosView['Reu']['Nome']; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="cpf_cnpjReu">Cpf/Cnpj</label>
								<input type="text" id="cpf_cnpjReu" name="CpfCnpjReu" class="form-control cpfOuCnpj" value="<?php echo $DadosView['Reu']['CpfCnpj']; ?>">
							</div>
							<div class="col-sm-4">
								<label for="tipoDocReu">Tipo Doc.</label>
								<select class="form-control" id="tipoDocReu" name="DocumentoTipoReu">
									<?php if($DadosView['Reu']['DocumentoTipo'] == "RG") { ?>
									<option value="RG" selected>RG</option>
									<option value="Cart. Motorista">Cart. Motorista</option>
									<option value="OAB">OAB</option>
									<?php } else if($DadosView['Reu']['DocumentoTipo'] == "Cart. Motorista") { ?>
									<option value="RG">RG</option>
									<option value="Cart. Motorista" selected>Cart. Motorista</option>
									<option value="OAB">OAB</option>
									<?php } else { ?>
									<option value="RG">RG</option>
									<option value="Cart. Motorista">Cart. Motorista</option>
									<option value="OAB" selected>OAB</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-4">
								<label for="numDocReu">Nº Documento</label>
								<input type="text" id="numDocReu" name="DocumentoNumeroReu" class="form-control" value="<?php echo $DadosView['Reu']['DocumentoNumero']; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header-collapse" role="tab" id="headingTwoReu">
			<h5 class="mb-0">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordionReu" href="#collapseTwoReu" aria-expanded="false" aria-controls="collapseTwoReu">
					Dados de contato (Réu)
				</a>
			</h5>
		</div>
		<div id="collapseTwoReu" class="collapse" role="tabpanel" aria-labelledby="headingTwoReu">
			<div class="card-block">
				<div class="col-sm-12 bg-white">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="emailReu">Email</label>
								<input type="text" id="emailReu" name="EmailReu" class="form-control" value="<?php echo $DadosView['Reu']['Email']; ?>">
							</div>
							<div class="col-sm-3">
								<label for="telefoneReu">Fone fixo</label>
								<input type="text" id="telefoneReu" name="TelefoneReu" class="form-control" value="<?php echo $DadosView['Reu']['FoneFixo']; ?>" onkeypress="mascara(this, '## ####-####')" maxlength="12">
							</div>
							<div class="col-sm-3">
								<label for="celularReu">Celular</label>
								<input type="text" id="celularReu" name="CelularReu" class="form-control" value="<?php echo $DadosView['Reu']['Celular']; ?>" onkeypress="mascara(this, '## #####-####')" maxlength="13">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header-collapse" role="tab" id="headingThreeReu">
			<h5 class="mb-0">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordionReu" href="#collapseThreeReu" aria-expanded="false" aria-controls="collapseThreeReu">
					Dados do endereço (Réu)
				</a>
			</h5>
		</div>
		<div id="collapseThreeReu" class="collapse" role="tabpanel" aria-labelledby="headingThreeReu">
			<div class="card-block">
				<div class="col-sm-12 bg-white">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="enderecoReu">Endereço</label>
								<input type="text" id="enderecoReu" name="EnderecoReu" class="form-control" value="<?php echo $DadosView['Reu']['Endereco']; ?>">
							</div>
							<div class="col-sm-2">
								<label for="numeroReu">Casa/Lote</label>
								<input type="text" id="numeroReu" name="NumeroReu" class="form-control" value="<?php echo $DadosView['Reu']['Numero']; ?>">
							</div>
							<div class="col-sm-6">
								<label for="complementoReu">Complemento</label>
								<input type="text" id="complementoReu" name="ComplementoEnderecoReu" class="form-control" value="<?php echo $DadosView['Reu']['ComplementoEndereco']; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label for="bairroReu">Bairro/Setor</label>
								<input type="text" id="bairroReu" name="BairroReu" class="form-control" value="<?php echo $DadosView['Reu']['Bairro']; ?>">
							</div>
							<div class="col-sm-4">
								<label for="cidadeReu">Cidade</label>
								<input type="text" id="cidadeReu" name="CidadeReu" class="form-control" value="<?php echo $DadosView['Reu']['Cidade']; ?>">
							</div>
							<div class="col-sm-2">
								<label for="ufReu">UF</label>
								<input type="text" id="ufReu" name="UFReu" class="form-control" value="<?php echo $DadosView['Reu']['UF']; ?>">
							</div>
							<div class="col-sm-2">
								<label for="cepReu">CEP</label>
								<input type="text" id="cepReu" name="CEPReu" class="form-control" value="<?php echo $DadosView['Reu']['CEP']; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>