<div class="modal" tabindex="-1" role="dialog" id="contestacaoView">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?=$Titulo?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="bold">Documentos anexados</p>
				<ul class="list-group">
					<?php for ($i=0; $i < sizeof($ContestacaoDocs); $i++) { ?>
						<li class="list-group-item justify-content-between">
							<?php 
							echo 
							"<a href='"
							.base_url()
							."assets/uploads/processos/"
							.$ContestacaoDocs[$i]['Arquivo']
							."' target='_blank'>"
							.$ContestacaoDocs[$i]['Arquivo']
							."</a>";
							?>
							<span class="badge badge-pill badge-default">
								<?php echo $ContestacaoDocs[$i]['TipoDocumento']; ?>
							</span>
						</li>
					<?php } ?>
				</ul>
				<hr>
				<p class="bold">Observações</p>
				<blockquote class="blockquote">
					<p>
						<?=$Contestacao['Texto'];?>
					</p>
				</blockquote>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>