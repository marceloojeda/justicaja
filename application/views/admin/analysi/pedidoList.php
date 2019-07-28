<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/pedidoList.js" type="text/javascript"></script>

<section id="pedidoList">
	<div class="container">
		<div class="w3-card w3-margin">
			<form action="<?php echo base_url();?>admin/dashboard/PedidoList" method="post">
				<?php 
					echo form_hidden('Estado', $dataPost['Filtro']['UF']);
					echo form_hidden('StatusPedido', $dataPost['Filtro']['Status']);
					echo form_hidden('Page', $dataPost['Filtro']['Page']);
					echo form_hidden('Target', $dataPost['Filtro']['Target']);
				?>

				<header class="w3-container w3-khaki">
					<h4 class="w3-card-title">Consulta Pedidos de Abertura de Processo</h4>
				</header>

				<div class="w3-container">
					<div class="w3-row-padding">
						<div class="w3-half w3-margin-top w3-margin-bottom">
							<input type="text" class="w3-input w3-border" name="Autor" placeholder="Nome/Razão Social do Autor" value="<?php echo $dataPost['Filtro']['Autor'];?>">
						</div>
						<div class="w3-half w3-margin-top w3-margin-bottom">
							<input type="text" class="w3-input w3-border" name="Reu" placeholder="Nome/Razão Social do Réu" value="<?php echo $dataPost['Filtro']['Reu'];?>">
						</div>
					</div>
					<div class="w3-row-padding">
						<div class="w3-third w3-margin-top w3-margin-bottom">
							<input type="text" class="w3-input w3-border" name="Cidade" placeholder="Cidade da parte" value="<?php echo $dataPost['Filtro']['Cidade'];?>">
						</div>
						<div class="w3-third w3-margin-top w3-margin-bottom">
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
						<div class="w3-third w3-margin-top w3-margin-bottom">
							<select class="w3-select w3-border" name="Status" id="ddlStatus">
								<option selected value="All">Todos os Status de Pedido</option>
								<option value="0">Não Iniciado</option>
								<option value="1">Em Andamento</option>
								<option value="2">Rejeitado</option>
								<option value="3">Cancelado</option>
								<option value="4">Concluído</option>
								<option value="5">Réu Indeciso</option>
								<option value="6">PAP Aceito Pelo Réu</option>
							</select>
						</div>
					</div>
				</div>

				<footer class="w3-container w3-khaki">
					<div class="w3-third w3-padding">
						<label class="w3-opacity w3-small">
							<?php echo $dataPost['Filtro']['TotalRegistros']." registros encontrados" ?>
						</label>
					</div>
					<div class="w3-third w3-center">
						<button class="w3-btn w3-blue" type="submit">Pesquisar</button>
					</div>
					<div class="w3-third w3-right">
						<?php echo $dataPost['links']; ?>
					</div>
				</footer>
			</form>
		</div>

		<?php $this->load->view('admin/analysi/lista_partial');?>
	</div>
</section>
<?php $this->load->view('admin/shared/footer') ?>