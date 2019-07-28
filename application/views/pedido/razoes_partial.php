<p class="text-center mt-2">
	digite as razões do seu processo
</p>

<div class="col-lg-12 form-group">
	<textarea id="txtRazoes" name="Razoes" rows="7" class="form-control"><?php echo $DadosView['RazoesInfo']['Razoes']; ?></textarea>
</div>

<p class="text-center mt-2">
	ou anexe um PDF
</p>

<div class="col-lg-12 form-group mt-2">
	<input id="inputRazoes" type="file" class="file" data-show-preview="false" name="RazoesFile">
</div>

<div class="col-lg-12 mt-2">
	<div class="col-sm-6 input-group">
		<span class="input-group-addon">
			<input type="checkbox" aria-label="Checkbox for cláusula arbitral" name="ClausulaArbitral">
		</span>
		<input type="text" class="form-control" aria-label="Text input with checkbox" value="O contrato possuí Cláusula Arbitral" readonly>
	</div>
</div>
