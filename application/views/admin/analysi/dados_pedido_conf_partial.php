
<div class="w3-row w3-margin-botton">

	<button onclick="AccordionToggle('autorPanel')" class="w3-btn w3-block w3-grey">Autor do Processo</button>

	<div class="w3-container w3-hide w3-light-grey" id="autorPanel">
		<div class="w3-row">
			<div class="w3-margin-top w3-twothird">
				<label>Nome</label>
				<input type="text" name="Nome" value="<?php echo $dataPost['Autor']['Nome']; ?>" class="w3-input w3-border" readonly>
			</div>
			<div class="w3-margin-top w3-third">
				<label>CPF/CNPJ</label>
				<input type="text" name="CpfCnpj" value="<?php echo $dataPost['Autor']['CpfCnpj']; ?>" readonly class="w3-input w3-border">
			</div>
		</div>

		<div class="w3-row">
			<div class="w3-margin-top w3-third">
				<label>Num. Doc</label>
				<input type="text" value="<?php echo $dataPost['Autor']['DocumentoNumero'].' ('.$dataPost['Autor']['DocumentoTipo'].')'; ?>" class="w3-input w3-border" readonly>
			</div>
			<div class="w3-margin-top w3-third">
				<label>Telefone(s)</label>
				<input type="text" value="<?php echo $dataPost['Autor']['FoneFixo'].' / '.$dataPost['Autor']['Celular']; ?>" class="w3-input w3-border" readonly>
			</div>
			<div class="w3-margin-top w3-third">
				<label>E-mail</label>
				<input type="text" value="<?php echo $dataPost['Autor']['Email']; ?>" class="w3-input w3-border" readonly>
			</div>

			<div class="w3-margin-top w3-third">
				<label>Endereço</label>
				<input type="text" value="<?php echo $dataPost['Autor']['Endereco'].', '.$dataPost['Autor']['Numero']; ?>" class="w3-input w3-border" readonly>
			</div>

			<div class="w3-margin-top w3-third">
				<label>Bairro (complemento)</label>
				<input type="text" value="<?php echo $dataPost['Autor']['Bairro'].' ('.$dataPost['Autor']['ComplementoEndereco'].')'; ?>" class="w3-input w3-border" readonly>
			</div>

			<div class="w3-margin-top w3-third">
				<label>Cidade/UF</label>
				<input type="text" value="<?php echo $dataPost['Autor']['Cidade'].'/'.$dataPost['Autor']['UF'].' - CEP: '.$dataPost['Autor']['CEP']; ?>" class="w3-input w3-border" readonly>
			</div>
		</div>
	</div>
</div>

<!-- FIM DOS DADOS DO AUTOR -->

<hr>

<!-- INICIO DOS DADOS DO REU -->
<div class="w3-row w3-margin-botton">

	<button onclick="AccordionToggle('reuPanel')" class="w3-btn w3-block w3-grey">Réu do Processo</button>

	<div class="w3-container w3-hide w3-light-grey" id="reuPanel">
		<div class="w3-row">
			<div class="w3-margin-top w3-twothird">
				<label>Nome</label>
				<input type="text" name="Nome" value="<?php echo $dataPost['Reu']['Nome']; ?>" class="w3-input w3-border" readonly>
			</div>
			<div class="w3-margin-top w3-third">
				<label>CPF/CNPJ</label>
				<input type="text" name="CpfCnpj" value="<?php echo $dataPost['Reu']['CpfCnpj']; ?>" readonly class="w3-input w3-border">
			</div>
		</div>

		<div class="w3-row">
			<div class="w3-margin-top w3-third">
				<label>Num. Doc</label>
				
				<input type="text" value="<?php echo $dataPost['Reu']['DocumentoNumero'].' ('.$dataPost['Reu']['DocumentoTipo'].')'; ?>" class="w3-input w3-border" readonly>
			</div>
			<div class="w3-margin-top w3-third">
				<label>Telefone(s)</label>
				<input type="text" value="<?php echo $dataPost['Reu']['FoneFixo'].' / '.$dataPost['Reu']['Celular']; ?>" class="w3-input w3-border" readonly>
			</div>
			<div class="w3-margin-top w3-third">
				<label>E-mail</label>
				<input type="text" value="<?php echo $dataPost['Reu']['Email']; ?>" class="w3-input w3-border">
			</div>

			<div class="w3-margin-top w3-third">
				<label>Endereço</label>
				<input type="text" value="<?php echo $dataPost['Reu']['Endereco'].', '.$dataPost['Reu']['Numero']; ?>" class="w3-input w3-border" readonly>
			</div>

			<div class="w3-margin-top w3-third">
				<label>Bairro (complemento)</label>
				<input type="textReu" value="<?php echo $dataPost['Reu']['Bairro'].' ('.$dataPost['Reu']['ComplementoEndereco'].')'; ?>" class="w3-input w3-border" readonly>
			</div>

			<div class="w3-margin-top w3-third">
				<label>Cidade/UF</label>
				<input type="text" value="<?php echo $dataPost['Reu']['Cidade'].'/'.$dataPost['Reu']['UF'].' - CEP: '.$dataPost['Reu']['CEP']; ?>" class="w3-input w3-border" readonly>
			</div>
		</div>
	</div>
</div>

<!-- FIM DOS DADOS DO REU -->

<hr>

<!-- RAZÕES DO PEDIDO !-->
<div class="w3-row w3-margin-botton">

	<button onclick="AccordionToggle('razoesPanel')" class="w3-btn w3-block w3-grey">Razões do Pedido</button>

	<div class="w3-container w3-hide w3-light-grey" id="razoesPanel">
		<div class="w3-panel w3-leftbar w3-light-grey">
		  <p class="w3-xlarge w3-serif">
		  	<i><?=$Pedido['Razoes']; ?></i>
		  </p>
		  <?php if(!empty($Pedido['RazoesArquivo'])) { ?>
		  	<div class="w3-right-align">
		  		<a href="<?php printf('%sassets/uploads/pedidos/%s', base_url(), $Pedido['RazoesArquivo']); ?>" target="_black" download>	Anexo das razões
		  		</a>
		  	</div>
	  	  <?php } ?>
		</div>
	</div>
</div>
<hr>
<!-- FIM DAS RAZÕES DO PEDIDO !-->


<div class="w3-row w3-margin-botton">

	<button onclick="AccordionToggle('documentosPanel')" class="w3-btn w3-block w3-grey">Documentos Anexados</button>

	<div class="w3-container w3-hide w3-light-grey" id="documentosPanel">

		<table class="w3-table w3-striped w3-margin-top">
			<thead>
				<tr>
					<th class="w3-quarter">Tipo</th>
					<th class="w3-half">Descrição</th>
					<th class="w3-quarter"></th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($dataPost['Documentos'])) { foreach ($dataPost['Documentos'] as $key => $doc) { ?>
				<tr>
					<td class="w3-quarter"><?php echo $doc['TipoDocumento']; ?></td>
					<td class="w3-half"><?php echo empty($doc['Observacao']) ? $doc['Arquivo'] : $doc['Observacao']; ?></td>
					<td class="w3-quarter w3-right-align">
						<a href="#" class="w3-btn w3-ripple w3-red" onclick="excluirAnexo(<?php printf("%d,'%s','%s'", $doc['Id'], 'documento', base_url()); ?>)">Excluir</a>
						<a href="<?php echo base_url().'assets/uploads/pedidos/'.$doc['Arquivo'] ?>" class="w3-btn w3-khaki">Download</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>

<hr>

<div class="w3-row w3-margin-botton">
	<button onclick="AccordionToggle('provasPanel')" class="w3-btn w3-block w3-grey">Provas Anexadas</button>

	<div class="w3-container w3-hide w3-light-grey" id="provasPanel">
		<table class="w3-table w3-striped w3-margin-top">
			<thead>
				<tr>
					<th class="w3-quarter">Tipo</th>
					<th class="w3-half">Nome do arquivo</th>
					<th class="w3-quarter"></th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($dataPost['Provas'])) { foreach ($dataPost['Provas'] as $key => $prova) { ?>
				<tr>
					<td class="w3-quarter"><?php echo $prova['TipoProva']; ?></td>
					<td class="w3-half"><?php echo $prova['Arquivo']; ?></td>
					<td class="w3-quarter w3-right-align">
						<a href="#" class="w3-btn w3-ripple w3-red" onclick="excluirAnexo(<?php printf("%d,'%s','%s'", $prova['Id'], 'prova', base_url()); ?>)">Excluir</a>
						<a href="<?php echo base_url().'assets/uploads/pedidos/'.$prova['Arquivo'] ?>" class="w3-btn w3-ripple w3-khaki">Download</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>

<?php if(!empty($dataPost['Analise']['ManifestacaoReu'])) { ?>
<hr>

<div class="w3-row w3-margin-botton">
	<button onclick="AccordionToggle('manifestacaoPanel')" class="w3-btn w3-block w3-grey">Manifestação do Réu
	</button>
	<div class="w3-container w3-hide w3-light-grey" id="manifestacaoPanel">
		<?=$dataPost['Analise']['ManifestacaoReu'];?>
	</div>
</div>

<?php } ?>