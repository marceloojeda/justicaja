<h3><?=$DadosView['Titulo'];?></h3>

<?php if(empty($DadosView['ContestacoesPendentes'])){ ?>
	<p>Não há registros pra mostrar</p>
<?php } else { 
	foreach ($DadosView['ContestacoesPendentes'] as $contestacao) {
?>
		<div class="list-group">
		  <a href="<?=base_url().'monitor/Pecas/'.$DadosView['Tipo'].'Create/'.$contestacao->PedidoId;?>" class="list-group-item active">
		    <h4 class="list-group-item-heading">
		    	Autor: <?=$contestacao->Autor;?>
		    	<small class="pull-right">
		    		<?=get_formato_brasil($contestacao->Data);?>
	    		</small>
	    	</h4>
		    <p class="list-group-item-text">
		    	<?=$contestacao->Razoes;?>
		    </p>
		  </a>
		</div>
<?php } } ?>