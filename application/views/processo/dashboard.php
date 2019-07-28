<?php $this->load->view('header') ?>

<section>
	<div class="container">
		<?php $this->load->view('processo/filtroPartial');?>

		<div class="row mt-4">
			<table class="table borderless">
				<thead>
					<tr>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$contador = 1; 
					$imageName = '';
					foreach ($dataPost['results'] as $item) { 
						if($contador == 1)
							$imageName = 'notificacao.jpg';
						elseif ($contador == 2) {
							$imageName = 'done_icon.png';
						}else
						$imageName = 'contestacao.jpg';
						?>

						<tr>
							<td class="text-center">
								<img class="card-img-top mt-2" src="<?php echo base_url().'assets/img/'.$imageName;?>" width="50" height="60">
							</td>
							<td class="align-middle">
								<?php echo $item['Sintese'] ?>
							</td>
						</tr>
						<tr class="border-bottom-1">
							<td>
								<a href="<?php echo base_url().'Processo/Details/'.$item['Id'];?>" class="btn btn-info mt-2">
									ver detalhes
								</a>
							</td>
							<td class="text-center align-middle">
								<label>Fase atual: <?php echo $item['FaseAtual'] ?></label>
								<label class="ml-3 countdown">
									Prazo: 
									<span name="clock" data-id="<?php echo $item['Id'];?>">
										<input type="hidden" name="PrazoVotacao" data-id="<?php echo $item['Id'];?>" value="<?php echo $item['Prazo'];?>">
									</span>
								</label>
							</td>
						</tr>

						<?php $contador++; } ?>
					</tbody>
				</table>
			</div>


			<?php echo $dataPost['links']; ?>
		</section>

		<?php $this->load->view('footer') ?>

		<script type="text/javascript" src="<?php echo base_url();?>assets/js/Dashboard.js"></script>