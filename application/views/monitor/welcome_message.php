<h3>Olá <?=$DadosView['Visitante']?>!</h3>
<p>
	Seja bem vindo ao painel do Justiça Já!.
</p>
<p>
Abaixo segue os Pedidos de Abertura de Processo - PAP em que você está envolvido.
</p>

<?php
$this->load->view('monitor/lista_processos', $DadosView);
?>