<hr>
<div class="w3-row-padding w3-margin">
	<table class="w3-table w3-striped">
		<thead>
			<tr>
				<th>Data Pedido</th>
				<th>Autor</th>
				<th>Reu</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tfoot></tfoot>
		<tbody>
			<?php 
			$this->load->helper('enum');
			if($dataPost['Pedidos'] !== null) { foreach ($dataPost['Pedidos'] as $key => $pedido) { 
			?>
			<tr>
				<td class="align-middle "><?php echo get_formato_brasil($pedido['Data'],true); ?></td>
				<td class="align-middle"><?php echo $pedido['Autor']; ?></td>
				<td class="align-middle"><?php echo $pedido['Reu']; ?></td>
				<td class="align-middle text-center">
					<?php echo $pedido['Status'] != null 
					? IntToAnalisePedidoStatus($pedido['Status'])
					: IntToAnalisePedidoStatus(0);
					?>
				</td>
				<td class="w3-right">
					<?php
						$targetLink = base_url()."admin/AnalysiPedido/ConfirmaPedido/".$pedido['Id'];
						$textLink = "Converter";
					?>
					<a href="<?php echo $targetLink;?>" name="BotaoAnalisar" class="w3-text-blue" data-id="<?php echo $pedido['Id']; ?>"><?php echo $textLink;?></a>
				</td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>
</div>