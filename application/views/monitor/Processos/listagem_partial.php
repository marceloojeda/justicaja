<hr>
<div class="w3-row-padding">
	<?php 
	$this->load->helper('enum');
	if($DadosView['Processos'] !== null) { 
		foreach ($DadosView['Processos'] as $key => $processo) { 
			if($DadosView['idPessoaLogado'] == $processo['AutorId'] || 
				$DadosView['idPessoaLogado'] == $processo['ReuId'] ||
				$DadosView['idPessoaLogado'] == $processo['PromotorId']){
				continue;
			}
			$this->load->view('monitor/Processos/card_processo');
		?>
	<?php } } ?>
</div>