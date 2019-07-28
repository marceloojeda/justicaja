<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/pedido_abertura.js" type="text/javascript"></script>

<section id="pedido_abertura_processo">
	<div class="container">
		<form action="uploadProva" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<div class="row">
				<div class="alert alert-success">
					<h3>3ª etapa concluída!</h3>
					<p>Nessa etapa você deverá anexar as provas que embasam suas razões.</p>
				</div>
			</div>
			
			<input type="hidden" name="PedidoId" value="<?php echo $dataPost['PedidoId'];?>">
			
			<div class="row" style="margin-bottom: 20px;">
				<div class="col-sm-6 form-group">
					<label for="tipoProva">Tipo Prova</label>
					<select name="TipoProva" class="form-control" id="tipoProva">
						<option value="Testemunha">Testemunha</option>
						<option value="Vídeo">Vídeo</option>
						<option value="Foto">Foto</option>
						<option value="Outros">Outros</option>
					</select>
				</div>
				<div class="col-sm-6 form-group">
					<label for="inputProva">Selecione o arquivo</label>
					<input id="inputProva" type="file" class="file" data-show-preview="false" name="Prova">
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-lg-12">
				<?php echo validation_errors(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<h3>Provas anexadas</h3>
				<ul class="list-group">
					<?php if(isset($dataPost['Provas'])) { foreach ($dataPost['Provas'] as $key => $prova) { ?>
					<li class="list-group-item justify-content-between">
					<?php 
						echo 
						"<a href='"
						.base_url()
						."assets/uploads/pedidos/"
						.$prova['Arquivo']
						."' target='_blank'>"
						.$prova['Arquivo']
						."</a>";
					?>
					<span class="badge badge-pill badge-default">
						<?php echo $prova['TipoProva']; ?>
					</span>
					</li>
					<?php } } ?>
				</ul>
			</div>
		</div>

		<hr>
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="stepFinal/<?php echo $dataPost['PedidoId'];?>" class="btn btn-primary">Concluir Pedido</a>
			</div>
		</div>

	</div>
</section>

<?php $this->load->view('footer'); ?>