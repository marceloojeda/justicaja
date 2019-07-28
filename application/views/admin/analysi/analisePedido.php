<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/pedido_abertura.js" type="text/javascript"></script>

<section id="pedido_abertura_processo">
	<div class="w3-container">
		<div class="w3-row-padding">
			<div class="w3-container w3-center w3-margin">
				<h3>Dados do Pedido</h3>
			</div>
			
			<?php $this->load->view('admin/analysi/dados_pedido_conf_partial', $dataPost); ?>
		</div>


		<div class="w3-row">
			<div class="w3-panel w3-center">
				<h3>Observação</h3>
			</div>
			<div class="w3-margin-top">
				<div class="w3-margin">
					<form action="<?php echo base_url();?>admin/dashboard/SalvarAnalise" method="post">
						<input type="hidden" name="PedidoId" value="<?php echo $dataPost['Pedido']['Id']; ?>">

						<textarea name="Analise" rows="5" class="w3-input w3-border w3-margin-bottom" required></textarea>

						<div class="w3-twothird w3-margin-bottom">
							<div class="w3-row w3-section">
								<div class="w3-col w3-padding" style="width:165px">
									<label>Status do Pedido</label>
								</div>
								<div class="w3-rest">
									<select name="Status" class="w3-select w3-border">
										<option value="0">Não Iniciado</option>
										<option value="1">Em Andamento</option>
										<option value="2">Rejeitado</option>
										<option value="3">Cancelado</option>
										<option value="4">Aceito</option>
										<option value="5">Réu Indeciso</option>
										<option value="6">PAP Aceito Pelo Réu</option>
									</select>
								</div>
							</div>
						</div>

						<div class="w3-third w3-right-align w3-margin-bottom">
							<label class="w3-text-white"><b>Status do Pedido</b></label>
							<br>
							<button class="w3-btn w3-light-grey" id="btnBack" type="button">Voltar</button>
							<button class="w3-btn w3-blue" id="btnSalvar">Salvar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('admin/shared/footer') ?>