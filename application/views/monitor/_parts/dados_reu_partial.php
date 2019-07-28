<div class="panel panel-default">
	<div class="panel-heading" style="cursor: pointer;" onclick="AccordionToggle('reuPanel')">Dados do Réu</div>
	<div class="panel-body hide" id="reuPanel">
		<fieldset disabled="">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Nome</label>
					<input type="text" class="form-control" value="<?=$DadosView['Reu']['Nome']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>CPF/CNPJ</label>
					<input type="text" class="form-control" value="<?=$DadosView['Reu']['CpfCnpj']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label><?=$DadosView['Reu']['DocumentoTipo']?></label>
					<input type="text" class="form-control" value="<?=$DadosView['Reu']['DocumentoNumero']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Telefone(s)</label>
					<?php
					$fones = $DadosView['Reu']['FoneFixo'];
					if(!$fones)
						$fones = $DadosView['Reu']['Celular'];
					else
						$fones .= ' / '.$DadosView['Reu']['Celular'];
					?>
					<input type="text" class="form-control" value="<?=$fones?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>E-mail</label>
					<input type="text" class="form-control" value="<?=$DadosView['Reu']['Email']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Endereço</label>
					<?php
					$endereco = $DadosView['Reu']['Endereco'];
					if(!$DadosView['Reu']['Numero'])
						$endereco .= ', '.$DadosView['Reu']['Numero'];
					if(!$DadosView['Reu']['ComplementoEndereco'])
						$endereco .= '. '.$DadosView['Reu']['ComplementoEndereco'];
					?>
					<input type="text" class="form-control" value="<?=$endereco?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Bairro</label>
					<input type="text" class="form-control" value="<?=$DadosView['Reu']['Bairro'].'. CEP: '.$DadosView['Reu']['CEP']?>">
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="form-group">
					<label>Cidade/UF</label>
					<input type="text" class="form-control" value="<?=$DadosView['Reu']['Cidade'].'/'.$DadosView['Reu']['UF']?>">
				</div>
			</div>
		</fieldset>
	</div>
</div>