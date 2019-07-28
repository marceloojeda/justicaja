<div class="w3-row-padding w3-margin">
	<div class="col-lg-12">
		<table class="w3-table w3-striped">
			<thead>
				<tr>
					<th>Data Pedido</th>
					<th>Autor</th>
					<th>Reu</th>
					<th>Status</th>
					<th>Peças</th>
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
						<td class="align-middle">
							<?php
							$links = '';
							$pedidoId = $pedido['Id'];

							if($pedido['ContestacaoId']){
								$params = $pedidoId.', \'contestacao\'';
								$links .= '<a class="w3-text-blue" href="#" onclick="verPeca('.$params.')">Contestação</a>';
							}
							if($pedido['ReplicaId']){
								$params = $pedidoId.', \'replica\'';
								$links .= ' <a class="w3-text-blue" href="#" onclick="verPeca('.$params.')">Réplica</a>';
							}
							if($pedido['TreplicaId']){
								$params = $pedidoId.', \'treplica\'';
								$links .= ' <a class="w3-text-blue" href="#" onclick="verPeca('.$params.')">Tréplica</a>';
							}
							echo $links;
							?>
						</td>
						<td class="w3-right">
							<?php
							$targetLink = "";
							$textLink = "";

							switch ($pedido['Status']) {
								case 0:
								$targetLink = base_url()."admin/Dashboard/AnalisarPedidoAbertura/".$pedido['Id'];
								$textLink = "Analisar";
								break;
								case 1:
								$targetLink = base_url()."admin/Dashboard/ViewPedido/".$pedido['Id'];
								$textLink = "Acompanhar";
								break;
								case 4:
								$targetLink = base_url()."admin/Dashboard/ViewPedido/".$pedido['Id'];
								$textLink = "Ver Análise";
								break;
								default:
								$targetLink = base_url()."admin/Dashboard/ViewPedido/".$pedido['Id'];
								$textLink = "Acompanhar";
								break;
							}
							?>
							<a href="<?php echo $targetLink;?>" name="BotaoAnalisar" class="w3-text-blue" data-id="<?php echo $pedido['Id']; ?>"><?php echo $textLink;?></a>
						</td>
					</tr>
				<?php }} ?>
			</tbody>
		</table>
	</div>	
</div>

<input type="hidden" id="base_url" value="<?=base_url();?>">

<div id="pecaPedido" class="w3-modal">
	<div class="w3-modal-content">
		<header class="w3-container w3-light-grey"> 
			<span onclick="document.getElementById('pecaPedido').style.display='none'" 
			class="w3-button w3-display-topright">&times;</span>
			<h4 id="tituloPeca">Modal Header</h4>
		</header>
		<div class="w3-container">
			<p id="textoPeca"></p>
			<hr>
			<h6>Arquivos anexados</h6>
			<ul class="w3-ul" id="arquivosPeca">

			</ul>
		</div>
	</div>
</div>
</div>