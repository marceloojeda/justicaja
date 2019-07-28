<div class="panel panel-default">
	<div class="panel-heading" style="cursor: pointer;" onclick="AccordionToggle('autorPanel')">Dados do Autor</div>
	<div class="panel-body hide" id="autorPanel">
		<fieldset disabled="">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Nome</label>
					<input type="text" class="form-control" value="<?=$DadosView['Autor']['Nome']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>CPF/CNPJ</label>
					<input type="text" class="form-control" value="<?=$DadosView['Autor']['CpfCnpj']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label><?=$DadosView['Autor']['DocumentoTipo']?></label>
					<input type="text" class="form-control" value="<?=$DadosView['Autor']['DocumentoNumero']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Telefone(s)</label>
					<?php
					$fones = $DadosView['Autor']['FoneFixo'];
					if(!$fones)
						$fones = $DadosView['Autor']['Celular'];
					else
						$fones .= ' / '.$DadosView['Autor']['Celular'];
					?>
					<input type="text" class="form-control" value="<?=$fones?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>E-mail</label>
					<input type="text" class="form-control" value="<?=$DadosView['Autor']['Email']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Endereço</label>
					<?php
					$endereco = $DadosView['Autor']['Endereco'];
					if(!$DadosView['Autor']['Numero'])
						$endereco .= ', '.$DadosView['Autor']['Numero'];
					if(!$DadosView['Autor']['ComplementoEndereco'])
						$endereco .= '. '.$DadosView['Autor']['ComplementoEndereco'];
					?>
					<input type="text" class="form-control" value="<?=$endereco?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Bairro</label>
					<input type="text" class="form-control" value="<?=$DadosView['Autor']['Bairro'].'. CEP: '.$DadosView['Autor']['CEP']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Cidade/UF</label>
					<input type="text" class="form-control" value="<?=$DadosView['Autor']['Cidade'].'/'.$DadosView['Autor']['UF']?>">
				</div>
			</div>
		</fieldset>
	</div>
</div>