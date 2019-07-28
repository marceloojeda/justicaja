<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="mb-2">Olá <?=$DadosView['Reu']['Nome']?>!</h3>
			<p>
				Recebemos um pedido de abertura de processo em que você consta como réu. Analise os dados abaixo, e faça sua constestação.
			</p>
		</div>
		<div class="col-lg-12">
			<?php $this->load->view('monitor/dados_processo', $DadosView); ?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12">
			<p>Você pode digitar sua própria contestação e/ou anexar arquivos que a representam.</p>
			<form action="../ContestacaoConfirm" method="post" accept-charset="utf-8" enctype="multipart/form-data" novalidate>

				<input type="hidden" name="PedidoId" value="<?php echo $DadosView['Pedido']['Id'];?>">
				<input type="hidden" name="ReuId" value="<?php echo $DadosView['Reu']['Id'];?>">

				<?php
				if(!is_null($DadosView['Contestacao']))
					echo form_hidden('ContestacaoId', $DadosView['Contestacao'][0]['Id']);
				?>

				<div class="row margin-bottom">
					<div class="col-sm-12">
						<textarea class="summernote" name="ContestacaoDigitada" required>
							<?php
							if(!empty($DadosView['Contestacao'][0]['Texto']))
								echo $DadosView['Contestacao'][0]['Texto'];
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
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<h3>Arquivos anexados</h3>
			<ul class="list-group">
				<?php if(isset($DadosView['Contestacao'])) { foreach ($DadosView['Contestacao'] as $key => $value) { ?>
					<li class="list-group-item justify-content-between">
						<?php 
						$descricao = empty($value['Observacao']) ? $value['Arquivo'] : $value['Observacao'];
						echo 
						"<a href='"
						.base_url()
						."assets/uploads/processos/"
						.$value['Arquivo']
						."' target='_blank' download>"
						.$descricao
						."</a>";
						?>
						<span class="badge badge-pill badge-default">
							<?php echo $value['TipoDocumento']; ?>
						</span>
					</li>
				<?php } } ?>
			</ul>
		</div>
	</div>
</div>