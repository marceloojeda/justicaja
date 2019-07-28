<div class="row">
	<div class="col-lg-12">
		<fieldset>
			<legend>Razões do pedido</legend>
			<!-- <div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6 form-group">
							<?php
							$clausula = $ContemClausulaArbitral == 1 ? 'Sim' : 'Não';
							?>
							<label for="clausula">Cláusula Arbitral</label>
							<input type="text" id="clausula" name="Clausula" readonly value="<?php echo $clausula; ?>" class="form-control">
						</div>
						<div class="col-sm-6 form-group">
							<label for="codPlano">Cod. Plano</label>
							<input type="text" id="codPlano" name="CodPlano" readonly value="<?php echo $Id ?>" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-sm-6 form-group">
					<label for="plano">Tab. Preço</label>
					<input type="text" id="plano" name="Plano" readonly value="<?php echo $Descricao ?>" class="form-control">
				</div>
			</div> -->
			
			<div class="row">
				<div class="col-lg-12 form-group">
					<label for="txtRazoes">Razões do processo</label>
					<textarea id="txtRazoes" name="Razoes" readonly rows="7" class="form-control"><?php echo $Razoes ?></textarea>
				</div>

				<div class="col-sm-6 form-group">
					<?php
					$clausula = $ContemClausulaArbitral == 1 ? 'Sim' : 'Não';
					?>
					<label for="clausula">Cláusula Arbitral</label>
					<input type="text" id="clausula" name="Clausula" readonly value="<?php echo $clausula; ?>" class="form-control">
				</div>
				<div class="col-sm-6 form-group">
					<label for="codPlano">Arquivo anexado</label>
					<?php if($RazoesArquivo !== null) { ?>
					<a href="<?php echo base_url().'assets/uploads/pedidos/'.$RazoesArquivo; ?>" class='form-control float-right'><?php echo $RazoesArquivo; ?></a>
					<?php } else { ?>
					<span class="float-right">não possui</span>
					<?php } ?>
				</div>
			</div>
		</fieldset>
	</div>
</div>