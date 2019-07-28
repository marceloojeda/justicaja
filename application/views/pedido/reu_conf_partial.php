<div class="row">
	<div class="col-lg-12">
		<fieldset>
			<legend>Réu</legend>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="nome">Nome completo</label>
						<input type="text" id="nome" name="Nome" readonly value="<?php echo $Nome ?>" class="form-control">
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="tipoPessoa">Tipo Pessoa</label>
									<input type="text" name="Tipo" class="form-control" readonly value="<?php echo $Tipo ?>">
								</div>
							</div>
							<div class="col-sm-6">
								<label for="cpf_cnpj">Cpf/Cnpj</label>
								<input type="text" id="cpf_cnpj" name="CpfCnpj" readonly value="<?php echo $CpfCnpj ?>" class="form-control">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="tipoDoc">Tipo Doc.</label>
									<input type="" name="DocumentoTipo" class="form-control" readonly value="<?php echo $DocumentoTipo ?>">
								</div>
							</div>
							<div class="col-sm-6">
								<label for="numDoc">Nº Documento</label>
								<input type="text" id="numDoc" name="DocumentoNumero" readonly value="<?php echo $DocumentoNumero ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="celular">Celular</label>
									<input type="text" id="celular" name="Celular" readonly value="<?php echo $Celular ?>" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<label for="telefone">Fone fixo</label>
								<input type="text" id="telefone" name="Telefone" readonly value="<?php echo $FoneFixo ?>" class="form-control">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<label for="email">Email</label>
						<input type="text" id="email" name="Email" readonly value="<?php echo $Email ?>" class="form-control">
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>