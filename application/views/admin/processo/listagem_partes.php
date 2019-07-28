<div class="w3-row-padding w3-margin">
	<table class="w3-table w3-striped">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Cpf/Cnpj</th>
				<th>E-mail</th>
				<th>Telefone(s)</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($DadosView['Pessoas']){
				foreach ($DadosView['Pessoas'] as $pessoa) { 
			?>
			<tr>
				<td><?=$pessoa['Nome'];?></td>
				<td><?=$pessoa['CpfCnpj'];?></td>
				<td><?=$pessoa['Email'];?></td>
				<td>
					<?php
					$fone = $pessoa['FoneFixo'];
					if(strlen($fone) <= 0){
						$fone = $pessoa['Celular'];
					} else{
						$fone .= ' / '.$pessoa['Celular'];
					}
					echo $fone;
					?>
				</td>
				<td class="text-right"><a href="#">atualizar dados</a></td>
			</tr>
			<?php 
				}
			} else{
				echo '<tr><td colspam="5" class="text-center">nenhum resultado para mostrar</td></tr>';
			} 
			?>
		</tbody>
	</table>
</div>