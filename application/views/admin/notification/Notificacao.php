<?php 
	$this->load->view('admin/shared/header');
	$this->load->view('shared/summernote_lib');
?>

<script src="<?php echo base_url();?>assets/js/notificacao.js" type="text/javascript"></script>

<form action="<?php echo base_url();?>admin/notification/EnviarNotificacao" method="post">
	<?php 
		echo form_hidden("PedidoId", $dataView["Pedido"]["Id"]);
		echo form_hidden("ReuId", $dataView["Pedido"]["ReuId"]);
		echo form_hidden("AutorId", $dataView["Pedido"]["PessoaId"]);
		echo form_hidden("PromotorId", $dataView["Pedido"]["PromotorId"]);
	?>

	<section id="section_notificacao">
		<div class="w3-container">
			<div class="w3-panel w3-center">
				<h3 class="w3-card-title"><?php echo $dataView["Title"]; ?></h3>
			</div>
			<div class="w3-row-padding w3-light-grey">
				<div class="w3-margin-top w3-twothird">
					<label>Nome/Razão Social do Autor</label>
					<input type="text" value="<?php echo $dataView['Autor']['Nome']; ?>" class="w3-input w3-border" disabled>
				</div>
				<div class="w3-margin-top w3-third">
					<label>CPF/CNPJ Autor</label>
					<input type="text" value="<?php echo $dataView['Autor']['CpfCnpj']; ?>" disabled class="w3-input w3-border">
				</div>

				<div class="w3-margin-top w3-twothird">
					<label>Nome/Razão Social do Réu</label>
					<input type="text" value="<?php echo $dataView['Reu']['Nome']; ?>" class="w3-input w3-border" disabled>
				</div>
				<div class="w3-margin-top w3-third">
					<label>CPF/CNPJ Réu</label>
					<input type="text" value="<?php echo $dataView['Reu']['CpfCnpj']; ?>" disabled class="w3-input w3-border">
				</div>

				<div class="w3-margin-top w3-margin-bottom w3-third">
					<label>E-mail Réu</label>
					<input type="text" value="<?php echo $dataView['Reu']['Email']; ?>" disabled class="w3-input w3-border" id="txtEmailReu">
				</div>
				<div class="w3-margin-top w3-margin-bottom w3-third">
					<label>Telefone Réu</label>
					<input type="text" value="<?php echo $dataView['Reu']['FoneFixo']; ?>" disabled class="w3-input w3-border">
				</div>
				<div class="w3-margin-top w3-margin-bottom w3-third">
					<label>Celular Réu</label>
					<input type="text" value="<?php echo $dataView['Reu']['Celular']; ?>" disabled class="w3-input w3-border">
				</div>
			</div>

			<div class="w3-row-padding w3-margin-top">
				<div class="w3-third">
					<label class="w3-block w3-opacity">Quem</label>
					<select class="w3-select w3-border" id="ddlMParte" name="Parte">
						<option value="Autor">Autor</option>
						<option value="Reu">Reu</option>
						<option value="Promotor">Promotor</option>
					</select>
				</div>

				<div class="w3-third">
					<label class="w3-block w3-opacity">Meio Comunicação</label>
					<select class="w3-select w3-border" id="ddlMeioComunicacao" name="MeioComunicacao">
						<option value="Telefone">Por telefone</option>
						<option value="Carta">Carta Simples</option>
						<option value="AR">Carta Registrada</option>
						<option value="Email">Por e-mail</option>
					</select>
				</div>

				<div class="w3-third w3-hide" id="EmailDestino">
					<label class="w3-block w3-opacity">E-mail Destino</label>
					<input type="text" name="Destinatario" class="w3-input w3-border">
				</div>
			</div>

			<div class="w3-panel">
				<textarea class="summernote" name="Observacao" required>
				<?php if(!$dataView['Notificacoes']) { ?>
					Link para ver o Pedido de Abertura de Processo - PAP
					<br>
					<a href="<?=base_url().'Welcome/order?hashTag='.$dataView['Pedido']['CodigoAceite'];?>">
						<?=base_url().'Welcome/order?hashTag='.$dataView['Pedido']['CodigoAceite'];?>
					</a>
				<?php } ?>
				</textarea>
			</div>

			<div class="w3-panel w3-center">
				<button class="w3-btn w3-blue" type="submit">
					Salvar Notificação
				</button>
			</div>
		</div>
	</section>
</form>
<input type="hidden" id="hiddenNotificacoes" value="<?php echo $dataView['Notificacoes'] ? 'Sim' : 'Não';?>">
<?php $this->load->view('admin/shared/footer') ?>