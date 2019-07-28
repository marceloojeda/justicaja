<div class="container">

	<div class="row">
		<div class="col-lg-12">
			<h3 class="mb-2">Olá <?=$DadosView['Reu']['Nome']?>!</h3>
			<p>
				O réu dessa ação já entrou com a <a href="#">contestação</a>. Se vc quiser, poderá incluir uma Réplica.
			</p>
		</div>
		<div class="col-lg-12">
			<?php $this->load->view('monitor/dados_processo', $DadosView); ?>
		</div>
	</div>
	<hr>

	<div class="row">
		<div class="col-lg-12">
			<p>Você pode digitar sua réplica e/ou anexar arquivos que a representam.</p>
			<form action="../ReplicaConfirm" method="post" accept-charset="utf-8" enctype="multipart/form-data">

				<input type="hidden" name="PedidoId" value="<?php echo $DadosView['Pedido']['Id'];?>">
				<input type="hidden" name="AutorId" value="<?php echo $DadosView['Autor']['Id'];?>">

				<?php
				if(!is_null($DadosView['Replica']))
					echo form_hidden('ReplicaId', $DadosView['Replica'][0]['Id']);
				?>

				<div class="row margin-botton">
					<div class="col-sm-12">
						<textarea class="summernote" name="ReplicaDigitada" required>
							<?php
							if(!is_null($DadosView['Replica']) && !empty($DadosView['Replica'][0]['Texto']))
								echo $DadosView['Replica'][0]['Texto'];
							?>
						</textarea>
					</div>
					<div class="col-sm-4 form-group">
						<label for="txtTipoDoc">Tipo arquivo</label>
						<select class="form-control" name="TipoDocumento" id="txtTipoDoc">
							<option value="Arquivo PDF">Arquivo PDF</option>
							<option value="Vídeo">Vídeo</option>
							<option value="Foto">Foto/Imagem</option>
							<option value="Outros">Outros</option>
						</select>
					</div>
					<div class="col-sm-4 form-group">
						<label for="descricaoProva">Descrição da prova</label>
						<input id="descricaoProva" type="text" class="form-control" name="Descricao">
					</div>
					<div class="col-sm-4 form-group">
						<label for="inputProva">Selecione o arquivo</label>
						<input id="inputProva" type="file" class="file" data-show-preview="false" name="Contestacao">
					</div>
				</div>

				<div class="row margin-bottom text-center">
					<button class="btn btn-primary btn-lg" type="submit">Salvar</button>
				</div>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<?php echo validation_errors(); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<h3>Arquivos anexados</h3>
			<ul class="list-group">
				<?php 
				if(!is_null($DadosView['Replica'])) { 
					for($i = 0; $i < sizeof($DadosView['Replica']); $i++) { 
						?>
						<li class="list-group-item justify-content-between">
							<?php
							$descricao = empty($DadosView['Replica'][$i]['Observacao']) ? $DadosView['Replica'][$i]['Arquivo'] : $DadosView['Replica'][$i]['Observacao'];
							echo 
							'<a href="'
							.base_url()
							.'assets/uploads/processos/'
							.$DadosView['Replica'][$i]['Arquivo']
							.'" target="_blank" download>'
							.$descricao
							.'</a>';
							?>
							<span class="badge badge-pill badge-default">
								<?php echo $DadosView['Replica'][$i]['TipoDocumento']; ?>
							</span>
						</li>
					<?php } 
				} ?>
			</ul>
		</div>
	</div>
</div>