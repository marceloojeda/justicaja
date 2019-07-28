
<div id="accordion" role="tablist" aria-multiselectable="true">
	<div class="card">
		<div class="card-header-collapse" role="tab" id="headingOne">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Dados pessoais (Autor)
				</a>
			</h5>
		</div>

		<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
			<div class="card-block">
				<div class="col-sm-12 bg-white">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-3">
								<label for="tipoPessoa">Tipo Pessoa</label>
								<select class="form-control" id="tipoPessoa" name="Tipo">
									<?php if($DadosView['Pessoa']['Tipo'] == "Pessoa Física") { ?>
									<option value="Pessoa Física" selected>Pessoa Física</option>
									<option value="Pessoa Jurídica">Pessoa Jurídica</option>
									<?php } else { ?>
									<option value="Pessoa Física">Pessoa Física</option>
									<option value="Pessoa Jurídica" selected>Pessoa Jurídica</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-9">
								<label for="nome">Nome/Razão social</label>
								<input type="text" id="nome" name="Nome" class="form-control" value="<?php echo $DadosView['Pessoa']['Nome']; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="cpf_cnpj">Cpf/Cnpj</label>
								<input type="text" id="cpf_cnpj" name="CpfCnpj" class="form-control cpfOuCnpj" value="<?php echo $DadosView['Pessoa']['CpfCnpj']; ?>">
							</div>
							<div class="col-sm-4">
								<label for="tipoDoc">Tipo Doc.</label>
								<select class="form-control" id="tipoDoc" name="DocumentoTipo">
									<?php if($DadosView['Pessoa']['DocumentoTipo'] == "RG") { ?>
									<option value="RG" selected>RG</option>
									<option value="Cart. Motorista">Cart. Motorista</option>
									<option value="OAB">OAB</option>
									<?php } else if($DadosView['Pessoa']['DocumentoTipo'] == "Cart. Motorista") { ?>
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
								<label for="numDoc">Nº Documento</label>
								<input type="text" id="numDoc" name="DocumentoNumero" class="form-control" value="<?php echo $DadosView['Pessoa']['DocumentoNumero']; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header-collapse" role="tab" id="headingTwo">
			<h5 class="mb-0">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					Dados de contato (Autor)
				</a>
			</h5>
		</div>
		<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
			<div class="card-block">
				<div class="col-sm-12 bg-white">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label for="email">Email</label>
								<input type="text" id="email" name="Email" class="form-control" value="<?php echo $DadosView['Pessoa']['Email']; ?>">
							</div>
							<div class="col-sm-3">
								<label for="telefone">Fone fixo</label>
								<input type="text" id="telefone" name="Telefone" class="form-control" value="<?php echo $DadosView['Pessoa']['FoneFixo']; ?>" onkeypress="mascara(this, '## ####-####')" maxlength="12">
							</div>
							<div class="col-sm-3">
								<label for="celular">Celular</label>
								<input type="text" id="celular" name="Celular" class="form-control" value="<?php echo $DadosView['Pessoa']['Celular']; ?>" onkeypress="mascara(this, '## #####-####')" maxlength="13">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header-collapse" role="tab" id="headingThree">
			<h5 class="mb-0">
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					Dados do endereço (Autor)
				</a>
			</h5>
		</div>
		<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
			<div class="card-block">
				<div class="col-sm-12 bg-white">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label for="endereco">Endereço</label>
								<input type="text" id="endereco" name="Endereco" class="form-control" value="<?php echo $DadosView['Pessoa']['Endereco']; ?>">
							</div>
							<div class="col-sm-2">
								<label for="numero">Casa/Lote</label>
								<input type="text" id="numero" name="Numero" class="form-control" value="<?php echo $DadosView['Pessoa']['Numero']; ?>">
							</div>
							<div class="col-sm-6">
								<label for="complemento">Complemento</label>
								<input type="text" id="complemento" name="ComplementoEndereco" class="form-control" value="<?php echo $DadosView['Pessoa']['ComplementoEndereco']; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label for="bairro">Bairro/Setor</label>
								<input type="text" id="bairro" name="Bairro" class="form-control" value="<?php echo $DadosView['Pessoa']['Bairro']; ?>">
							</div>
							<div class="col-sm-4">
								<label for="cidade">Cidade</label>
								<input type="text" id="cidade" name="Cidade" class="form-control" value="<?php echo $DadosView['Pessoa']['Cidade']; ?>">
							</div>
							<div class="col-sm-2">
								<label for="uf">UF</label>
								<input type="text" id="uf" name="UF" class="form-control" value="<?php echo $DadosView['Pessoa']['UF']; ?>">
							</div>
							<div class="col-sm-2">
								<label for="cep">CEP</label>
								<input type="text" id="cep" name="CEP" class="form-control" value="<?php echo $DadosView['Pessoa']['CEP']; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>