<h3>Processos em Pauta</h3>
<p>Listagem de Processos na Pauta de Julgamento.<br>
<b>Atenção: </b>você poderá propor uma solução ou votar somente nos casos em que <b>não</b> for parte do processo.
</p>
<hr>

<div class="card">
	<form action="<?php echo base_url();?>monitor/Processos" method="post">
		<?php 
			$this->load->view('monitor/Processos/filtro_partial', $DadosView);
			$this->load->view('monitor/Processos/listagem_partial', $DadosView);
		?>
	</form>
</div>