<?php
if(empty($PedidosSouPromotor) || sizeof($PedidosSouPromotor) <= 0){
?>
<div class="alert alert-info text-center" style="margin-top: 15px">
	nenhum resultado pra mostrar
</div>
<?php } else { ?>

<?php for ($i=0; $i < sizeof($PedidosSouPromotor); $i++) { ?>
	<div class="bs-callout bs-callout-info">
		<a href="<?=base_url();?>monitor/Processos/verPedido/<?=$PedidosSouPromotor[$i]['Id'];?>">
			<h4><?=$PedidosSouPromotor[$i]['Promotor'];?> <small class="pull-right"><?=$PedidosSouPromotor[$i]['Data'];?></small></h4> 
			<p><?=$PedidosSouPromotor[$i]['Razoes'];?></p> 
		</a>
	</div>
	<?php 
	if($i > 1 && !$this->input->get('all')){
		break;
	}
}
}
?>