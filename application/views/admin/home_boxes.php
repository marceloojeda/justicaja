<div class="w3-row-padding w3-margin-bottom">
	<div class="w3-quarter">
		<div class="w3-container w3-red w3-padding-16 box-home">
			<div class="w3-left"><i class="fa fa-credit-card w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>3</h3>
			</div>
			<div class="w3-clear"></div>
			<h4 class="w3-margin-top">Não Analisados</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-blue w3-padding-16 box-home">
			<div class="w3-left"><i class="fa fa-pencil w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>16</h3>
			</div>
			<div class="w3-clear"></div>
			<h4 class="w3-margin-top">Aguardando Aceite</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-teal w3-padding-16 box-home">
			<div class="w3-left"><i class="fa fa-star-o w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>130</h3>
			</div>
			<div class="w3-clear"></div>
			<h4 class="w3-margin-top">Em Negociação</h4>
		</div>
	</div>
	<div class="w3-quarter">
		<div class="w3-container w3-orange w3-text-white w3-padding-16 box-home">
			<div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
			<div class="w3-right">
				<h3>200</h3>
			</div>
			<div class="w3-clear"></div>
			<h4 class="w3-margin-top">Fechados</h4>
		</div>
	</div>
</div>

<div class="w3-row-padding w3-margin-bottom">
	<div class="w3-half">
		<div class="w3-card-4">
			<header class="w3-container w3-light-grey">
				<h3>Principais Causas</h3>
			</header>
			<div class="w3-container">
				<ul class="w3-ul w3-margin-top w3-margin-bottom">
					<li>1º) Indenização por ofensa, descrédito ou calúnia</li>
					<li>2º) Indenização por insulto a livre-arbítrio pessoal </li>
					<li>3º) Negativação indevida do nome</li>
					<li>4º) Negativação indevida do nome</li>
					<li>5º) Negativação indevida do nome</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="w3-half">
		<div class="w3-card-4">
			<header class="w3-container w3-light-grey">
				<h3>Ticket médio por estado</h3>
			</header>

			<div class="w3-container">
				<canvas id="chart-area"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	var randomScalingFactor = function() {
		return Math.round(Math.random() * 10000);
	};

	var config = {
		type: 'pie',
		data: {
			datasets: [{
				data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				],
				backgroundColor: [
				window.chartColors.red,
				window.chartColors.orange,
				window.chartColors.yellow,
				window.chartColors.green,
				window.chartColors.blue,
				],
				label: 'Dataset 1'
			}],
			labels: [
			"RS",
			"SP",
			"GO",
			"TO",
			"AC"
			]
		},
		options: {
			responsive: true
		}
	};

	window.onload = function() {
		var canvas = document.getElementById("chart-area");
		var ctx = canvas.getContext("2d");
		window.myPie = new Chart(ctx, config);
	};
</script>