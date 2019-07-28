<div class="w3-row-padding w3-margin">
	<div class="col-lg-12">
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
					<tr data-pedido="<?=$pedido['Id']?>" data-analise="<?=$pedido['AnaliseId']?>">
						<td class="align-middle "><?php echo get_formato_brasil($pedido['Data'],true); ?></td>
						<td class="align-middle"><?php echo $pedido['Autor']; ?></td>
						<td class="align-middle"><?php echo $pedido['Reu']; ?></td>
						<td class="align-middle text-center">
							<?php echo $pedido['Status'] != null 
							? IntToAnalisePedidoStatus($pedido['Status'])
							: IntToAnalisePedidoStatus(0);
							?>
						</td>
						<td class="w3-right-align">
							<a href="#" name="VerAnalise" class="w3-text-blue" onclick="verManifestacao(<?=$pedido['AnaliseId']?>)">ver manifestação</a>
						</td>
					</tr>
				<?php }} ?>
			</tbody>
		</table>
	</div>	
</div>

<!-- The Modal -->
<div id="manifestacao-modal" class="w3-modal">
	<div class="w3-modal-content">
		<header class="w3-container w3-teal"> 
			<span onclick="document.getElementById('manifestacao-modal').style.display='none'" 
			class="w3-button w3-display-topright">&times;</span>
			<h2>Manifestação do réu</h2>
		</header>
		<div class="w3-container">
			<p id="txtManifestacao"></p>
		</div>
		<div class="w3-container w3-light-grey w3-padding">
			<button class="w3-button w3-right w3-white w3-border" 
			onclick="document.getElementById('manifestacao-modal').style.display='none'">Close</button>
		</div>
	</div>
</div>