<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/pedido_abertura.js" type="text/javascript"></script>

<section id="pedido_abertura_processo">
	<div class="container">
		<form action="ConfirmSetp2" method="post" accept-charset="utf-8">

			<?php 
				echo form_hidden('Role', $dataPost['Role']); 
			?>

			<div class="row">
				<div class="alert alert-success">
					<h3>1ª etapa concluída!</h3>
					<p>Nessa etapa você deverá indicar a tabela de preço que seu caso se enquadra e as razões do processo.</p>
				</div>
			</div>
			
			<?php 
				$data = array(
				        'Nome'  => $dataPost["Pessoa"]["Nome"],
				        'PessoaId' => $dataPost["Pessoa"]["Id"]
				);

				echo form_hidden($data);

				$this->load->view('pedido/tabela_preco', $dataPost);
			?>

			<div class="row">
				<div class="col-lg-12 form-group">
					<label for="txtRazoes">Razões do processo</label>
					<textarea id="txtRazoes" name="Razoes" rows="7" class="form-control"></textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 form-group">
					<div class="col-sm-6 input-group">
						<span class="input-group-addon">
							<input type="checkbox" aria-label="Checkbox for cláusula arbitral" name="ClausulaArbitral">
						</span>
						<input type="text" class="form-control" aria-label="Text input with checkbox" value="O contrato possuí Cláusula Arbitral?" readonly>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 text-center">
					<button type="submit" class="btn btn-primary">Avançar</button>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-lg-12">
				<?php echo validation_errors(); ?>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('footer') ?>