<?php
if(empty($MeusPedidos) || sizeof($MeusPedidos) <= 0){
?>
<div class="alert alert-info text-center" style="margin-top: 15px">
	nenhum resultado pra mostrar
</div>
<?php } else { ?>

<?php for ($i=0; $i < sizeof($MeusPedidos); $i++) { ?>
	<div class="bs-callout bs-callout-info">
		<a href="<?=base_url();?>monitor/Processos/verPedido/<?=$MeusPedidos[$i]['Id'];?>">
			<h4><?=$MeusPedidos[$i]['Autor'];?> <small class="pull-right"><?=$MeusPedidos[$i]['Data'];?></small></h4> 
			<p><?=$MeusPedidos[$i]['Razoes'];?></p> 
		</a>
	</div>
	<?php 
	if($i > 1 && !$this->input->get('all')){
		break;
	}
}
}?>