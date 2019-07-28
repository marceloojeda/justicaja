<div class="card">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item active">
			<a href="#pedidosReu" role="tab" data-toggle="tab">Sou Réu</a>
		</li>
		<li class="nav-item">
			<a href="#pedidosAutor" role="tab" data-toggle="tab">Sou Autor</a>
		</li>
		<li class="nav-item">
			<a href="#pedidosPromotor" role="tab" data-toggle="tab">Sou Promotor</a>
		</li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="pedidosReu">
			<?php $this->load->view('monitor/_parts/lista_pedidos_reu_partial', $DadosView); ?>
			<p class="margin-top clearfix">
				<a href="<?=base_url()?>monitor/Processos?all=true" class="pull-right">ver todos</a>
			</p>
		</div>

		<div role="tabpanel" class="tab-pane" id="pedidosAutor">
			<?php $this->load->view('monitor/_parts/lista_pedidos_autor_partial', $DadosView); ?>
			<p class="margin-top clearfix">
				<a href="<?=base_url()?>monitor/Processos?all=true" class="pull-right">ver todos</a>
			</p>
		</div>

		<div role="tabpanel" class="tab-pane" id="pedidosPromotor">
			<?php $this->load->view('monitor/_parts/lista_pedidos_promotor_partial', $DadosView); ?>
			<p class="margin-top clearfix">
				<a href="<?=base_url()?>monitor/Processos?all=true" class="pull-right">ver todos</a>
			</p>
		</div>
	</div>
</div>