<?php $this->load->view('header') ?>
<section id="details">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<?php if($dataPost['propostas'] !== null) { ?>
				<a href="<?php echo base_url().'Processo/Solucoes/'.$this->uri->segment(3);?>" class="btn btn-primary">Ver Soluções Propostas</a>
				<?php } else { ?>
				Não há propostas de sentenças para esse caso ainda. Quer propor uma? <a href="<?php echo base_url().'processo/addSentenca/'.$this->uri->segment(3);?>">clique aqui!</a>
				<?php } ?>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<div class="list-group  table-striped">
					<?php foreach ($dataPost['results'] as $key => $value) { 
						if($value['FaseAtual'] == 1){
							echo "<a href='".base_url()."assets/uploads/proc1_pecas.rar' class='list-group-item' style='background-color:aliceblue'>";

							echo "<i class='fa fa-check list-item-icon' aria-hidden='true'></i>";

							echo "<span><strong>Inicio: ".get_formato_brasil($value['DataEntrada'],false);

							$prazo = date('Y-m-d', strtotime($value['DataEntrada']. ' + '. $value['Prazo']. ' days'));

							echo " - Prazo: ".get_formato_brasil($prazo,false);

							echo "</strong><br>".$value['Fase'];



							echo "</span></a>";
						}
						else{
							echo "<a href='".base_url()."assets/uploads/proc1_pecas.rar' class='list-group-item list-group-item-action'>";

							echo "<i class='fa fa-calendar list-item-icon' aria-hidden='true'></i>";

							echo "<span><strong>Inicio: ".get_formato_brasil($value['DataEntrada'],false)." - Termino: ".get_formato_brasil($value['DataSaida'],false)."</strong><br>".$value['Fase']."</span>";

							echo "</a>";
						}
						?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('footer') ?>