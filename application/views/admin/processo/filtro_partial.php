
<?php 
echo form_hidden('Estado', $Filtro['UF']);
echo form_hidden('StatusPedido', $Filtro['Status']);
echo form_hidden('Page', $Filtro['Start']);
echo form_hidden('Target', $Filtro['Target']);
?>

<header class="w3-container w3-khaki">
	<h4 class="w3-card-title">Consulta Pedidos de Abertura de Processo</h4>
</header>

<div class="w3-container">
	<div class="w3-row-padding">
		<div class="w3-half w3-margin-top w3-margin-bottom">
			<input type="text" class="w3-input w3-border" name="Autor" placeholder="Nome/Razão Social do Autor" value="<?php echo $Filtro['Autor'];?>">
		</div>
		<div class="w3-half w3-margin-top w3-margin-bottom">
			<input type="text" class="w3-input w3-border" name="Reu" placeholder="Nome/Razão Social do Réu" value="<?php echo $Filtro['Reu'];?>">
		</div>
	</div>
	<div class="w3-row-padding">
		<div class="w3-half w3-margin-top w3-margin-bottom">
			<select class="w3-select w3-border" name="UF" id="ddlUF">
				<option selected value="All">Qualquer UF do Brasil</option>
				<option value="AC">Acre</option>
				<option value="AL">Alogoas</option>
				<option value="AP">Amapá</option>
				<option value="AM">Amazonas</option>
				<option value="BA">Bahia</option>
				<option value="CE">Ceará</option>
				<option value="DF">Distrito Federal</option>
				<option value="ES">Espírito Santo</option>
				<option value="GO">Goiás</option>
				<option value="MA">Maranhão</option>
				<option value="MT">Mato Grosso</option>
				<option value="MS">Mato Grosso do Sul</option>
				<option value="MG">Minas Gerais</option>
				<option value="PA">Pará</option>
				<option value="PR">Paraíba</option>
				<option value="PN">Paraná</option>
				<option value="PE">Pernambuco</option>
				<option value="PI">Piauí</option>
				<option value="RJ">Rio de Janeiro</option>
				<option value="RN">Rio Grande do Norte</option>
				<option value="RS">Rio Grande do Sul</option>
				<option value="RO">Rondônia</option>
				<option value="RR">Roraima</option>
				<option value="SC">Santa Catarina</option>
				<option value="SP">São Paulo</option>
				<option value="SE">Sergipe</option>
				<option value="TO">Tocantins</option>
			</select>
		</div>
		<div class="w3-half w3-margin-top w3-margin-bottom">
			<input type="text" class="w3-input w3-border" name="Cidade" placeholder="Cidade da parte" value="<?php echo $Filtro['Cidade'];?>">
		</div>
	</div>
	<!--
	<div class="w3-row-padding">
		<div class="w3-col w3-margin-top w3-margin-bottom">
			<input type="text" class="w3-input w3-border" name="PalavraChave" placeholder="Palavra(s) Chave" value="<?php echo $Filtro['PalavraChave'];?>">
		</div>
	</div>
	!-->
</div>

<footer class="w3-container w3-khaki">
	<div class="w3-third w3-padding">
		<label class="w3-opacity w3-small">
			<?php echo $Filtro['TotalRegistros']." registros encontrados" ?>
		</label>
	</div>
	<div class="w3-third w3-center">
		<button class="w3-btn w3-blue" type="submit">Pesquisar</button>
	</div>
	<div class="w3-third w3-right">
		<?php echo $links; ?>
	</div>
</footer>
