<?php
if(empty($PedidosSouReu) || sizeof($PedidosSouReu) <= 0){
?>
<div class="alert alert-info text-center" style="margin-top: 15px">
	nenhum resultado pra mostrar
</div>
<?php } else { ?>

<?php for ($i=0; $i < sizeof($PedidosSouReu); $i++) { ?>
	<div class="bs-callout bs-callout-info">
		<a href="<?=base_url();?>monitor/Processos/verPedido/<?=$PedidosSouReu[$i]['Id'];?>">
			<h4><?=$PedidosSouReu[$i]['Autor'];?> <small class="pull-right"><?=$PedidosSouReu[$i]['Data'];?></small></h4> 
			<p><?=$PedidosSouReu[$i]['Razoes'];?></p> 
		</a>
	</div>
	<?php 
	if($i > 1 && !$this->input->get('all')){
		break;
	}
}
}
?>