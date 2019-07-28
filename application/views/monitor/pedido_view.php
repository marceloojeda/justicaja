<h3>Pedido de Abertura de Processo</h3>
<p>Confira as informações fornecidas pelo autor clicando sobre o título.</p>
<p>Após sua avaliação, você deve ACEITAR ou NEGAR esse pedido. Caso deseje, você também pode tomar essa decisão mais tarde.</p>

<div>
	<?php 
		$this->load->view('shared/summernote_lib');
		$this->load->view('monitor/_parts/dados_autor_partial'); 
	?>
</div>

<div>
	<?php $this->load->view('monitor/_parts/documentos_autor_partial'); ?>
</div>

<div>
	<?php $this->load->view('monitor/_parts/provas_autor_partial'); ?>
</div>

<div>
	<?php $this->load->view('monitor/_parts/razoes_autor_partial'); ?>
</div>

<div>
	<?php $this->load->view('monitor/_parts/dados_reu_partial'); ?>
</div>

<hr>

<?php
if(!empty($DadosView['Analise']['ManifestacaoReu'])){
	echo '<div class="alert alert-info">';
	echo '<h4>Manifestação do Réu</h4>';
	echo $DadosView['Analise']['ManifestacaoReu'];
	echo '</div>';
}
?>

<?php

if($DadosView['Pedido']['ReuId'] == $this->session->userdata('PessoaId') &&
	($DadosView['Analise']['Status'] == ANALISEPEDIDO_ANDAMENTO || $DadosView['Analise']['Status'] == ANALISEPEDIDO_REU_INDECISO)){
?>

<div class="col-md-4">
	<button type="button" class="btn btn-danger btn-lg btn-block" id="btnRejeitaPedido">Não Aceito Esse Processo</button>
</div>

<div class="col-md-4">
	<button type="button" class="btn btn-primary btn-lg btn-block" id="btnAceitarPedido">Aceito o Processo</button>
</div>

<div class="col-md-4">
	<button type="button" class="btn btn-secundary btn-lg btn-block" id="btnProrrogarDecisao">Vou Decidir Mais Tarde</button>
</div>

<?php } ?>

<?php
	$this->load->view('monitor/_parts/razoes_desistencia_partial');
	$this->load->view('monitor/_parts/razoes_aceito_partial');
	$this->load->view('monitor/_parts/razoes_prorrogacao_partial');
?>