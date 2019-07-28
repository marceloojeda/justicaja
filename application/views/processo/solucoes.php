<?php $this->load->view('header') ?>

<section id="solucoes">
	<div class="container">
		<div class="form-group row">
			<div class="col-sm-4">
				<label for="numProcesso" class="col-form-label">Num. Processo</label>
				<input type="text" class="form-control" readonly name="NumProcesso" id="numProcesso" value="<?php echo $results[0]['ProcessoId'];?>">
			</div>

			<div class="col-sm-4">
				<label for="fase" class="col-form-label">Fase Atual</label>
				<input type="text" class="form-control" readonly name="Fase" id="fase" value="<?php echo $results[0]['FaseAtual'];?>">
			</div>

			<div class="col-sm-4">
				<label for="prazo" class="col-form-label">Prazo</label>
				<input type="text" class="form-control" readonly name="Prazo" id="prazo" value="<?php echo get_formato_brasil($results[0]['Prazo'],false);?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<?php if($results == null) { ?>
				<div class="text-center">
					<h5>Não existe propostas de solução para este processo.</h5>
					<a href="<?php echo base_url();?>Processo">voltar</a>
				</div>
				<?php }else { ?>
				<h4>Soluções propostas</h4>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Cod. Proposta</th>
							<th>Data Cad.</th>
							<th>Link Proposta</th>
							<th class="text-center">Ações</th>
						</tr>
					</thead>
					<tfoot>
						<tr class="table-footer">
							<td colspan="4" class="text-center">
								<a href="<?php echo base_url().'processo/addSentenca/'.$this->uri->segment(3); ?>">Quero submeter uma sentença</a>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php foreach ($results as $key => $value) { ?>
						<tr>
							<td class="align-middle"><?php echo $value['SolucaoId']; ?></td>
							<td class="align-middle"><?php echo get_formato_brasil($value['DataCadastro'],true); ?></td>
							<td class="align-middle">
								<a href="<?php echo base_url().'assets/uploads/solucoes/'.$value['Arquivo'];?>" target="_blank"><?php echo $value['Arquivo']; ?></a>
							</td>
							<td class="text-center align-middle">
								<!-- arbitro já votou -->
								<?php if($voto !== null && $voto['SolucaoId'] == $value['SolucaoId']) { ?>
								<button type="button" class="btn btn-info" disabled name="Votado" data-id="<?php echo $value['SolucaoId'];?>" style="cursor: pointer;">
									<i class="fa fa-star-o" aria-hidden="true"></i>
									proposta apoiada
								</button>

								<!-- arbitro não votou -->
								<?php } else if($voto == null) { ?>
								<button type="button" class="btn btn-default" name="Apoiar" data-id="5" style="cursor: pointer;">
									<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
									apoio essa proposta
								</button>

								<!-- já votou em outra proposta -->
								<?php } else { ?>
								<button type="button" class="btn btn-default" disabled name="Apoiar" data-id="5" style="cursor: pointer;">
									<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
									apoio essa proposta
								</button>
								<?php } ?>

							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('processo/confirmaVoto');?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/solucoesList.js"></script>

<?php $this->load->view('footer') ?>