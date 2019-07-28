<div class="row">
	<div class="col-sm-3 form-group">
		<label>Data Pedido</label>
		<?php 
		$data = array(
			'name'          => 'DataPedido',
			'id'            => 'txtData',
			'value'         => get_formato_brasil($DadosView['Pedido']['Data'], true),
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($data);
		?>
	</div>

	<div class="col-sm-6 form-group">
		<label>Autor</label>
		<?php 
		$data = array(
			'name'          => 'Autor',
			'id'            => 'txtAutor',
			'value'         => $DadosView['Autor']['Nome'],
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($data);
		?>
	</div>

	<div class="col-sm-3 form-group">
		<label>Cpf/Cnpj Autor</label>
		<?php 
		$data = array(
			'name'          => 'CpfCnpj',
			'id'            => 'txtCpf',
			'value'         => $DadosView['Autor']['CpfCnpj'],
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($data);
		?>
	</div>

<!--
	<div class="col-sm-2 form-group">
		<label>Tab. Preço</label>
		<?php 
		$field = array(
			'name'          => 'TabPreco',
			'id'            => 'txtTabPreco',
			'value'         => $DadosView['Pedido']['Codigo'],
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($field);
		?>
	</div>

	<div class="col-sm-2 form-group">
		<label>Data Pedido</label>
		<?php 
		$data = array(
			'name'          => 'DataPedido',
			'id'            => 'txtDataPedido',
			'value'         => get_formato_brasil($DadosView['Pedido']['Data'],true),
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($data);
		?>
	</div>

	<div class="col-sm-5 form-group">
		<label>Réu</label>
		<?php 
		$data = array(
			'name'          => 'Reu',
			'id'            => 'txtReu',
			'value'         => $DadosView['Reu']['Nome'],
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($data);
		?>
	</div>

	<div class="col-sm-3 form-group">
		<label>Cpf/Cnpj Réu</label>
		<?php 
		$data = array(
			'name'          => 'CpfCnpjReu',
			'id'            => 'txtCpfReu',
			'value'         => $DadosView['Reu']['CpfCnpj'],
			'readonly'		=> 'true',
			'class'			=> 'form-control'
			);

		echo form_input($data);
		?>
	</div>
!-->

	<div class="col-sm-12 form-group">
		<label>Razões do Pedido</label>
		<?php 
		$data = array(
			'name'          => 'Sintese',
			'id'            => 'txtSintese',
			'value'         => $DadosView['Pedido']['Razoes'],
			'readonly'		=> 'true',
			'class'			=> 'form-control',
			'rows'			=> '7'
			);

		echo form_textarea($data);
		?>
	</div>
</div>