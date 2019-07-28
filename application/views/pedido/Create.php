<h3>Pedidos de Abertura de Processo - PAP</h3>
<p>
	Preencha as informações para que possamos analisar seu PAP
</p>

<div class="card" id="pedido_abertura_processo">
	<form action="ConfirmCreate" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<!-- Campos Hidden -->
		<?php echo form_hidden('PromotorId', $DadosView['PromotorId']); ?>
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item active">
				<a href="#autor" role="tab" data-toggle="tab">Dados do Autor</a>
			</li>
			<li class="nav-item">
				<a href="#reu" role="tab" data-toggle="tab">Dados do Réu</a>
			</li>
			<li class="nav-item">
				<a href="#razoes" role="tab" data-toggle="tab">Razões do Processo</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="autor" role="tabpanel">
				<?php $this->load->view('pedido/autor_partial'); ?>
			</div>
			<div class="tab-pane" id="reu" role="tabpanel">
				<?php $this->load->view('pedido/reu_partial'); ?>
			</div>
			<div class="tab-pane" id="razoes" role="tabpanel">
				<?php $this->load->view('pedido/razoes_partial'); ?>
			</div>
		</div>
		<div class="row mt-2 text-center">
			<button class="btn btn-primary bt-lg" type="submit">Enviar PAP</button>
		</div>
	</form>
	<div class="col-lg-12 mt-2">
		<?php echo validation_errors(); ?>
	</div>
</div>