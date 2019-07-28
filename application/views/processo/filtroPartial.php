    <div class="row">
    	<div class="col-sm-12">
    		<form action="<?php echo base_url(); ?>Processo" method="post">
    			<input type="hidden" name="PaginaAtual" value="<?php echo $dataPost['paginaAtual']; ?>">
    			<div class="card">
    				<div class="card-header card-info">
    					<h4 class="card-title">Filtrar Processos</h4>
    				</div>
    				<div class="card-block">
    					<div class="row">
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="txtPalavraChave">Palavras chave <small>separados por vírgula</small></label>
    								<input type="text" class="form-control" id="txtPalavraChave" placeholder="ex: direito,tributário,etc" name="PalavraChave">
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="ddFase">Fase processual</label>
    								<div class="dropdown">
    									<button class="btn btn-secondary dropdown-toggle" type="button" id="ddFase" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    										Dropdown button
    									</button>
    									<div class="dropdown-menu" aria-labelledby="ddFase">
    										<a class="dropdown-item" href="#">Action</a>
    										<a class="dropdown-item" href="#">Another action</a>
    										<a class="dropdown-item" href="#">Something else here</a>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="card-footer">
    					<div class="row text-center">
    						<div class="col-sm-12">
    							<button class="btn btn-primary" type="submit">pesquisar</button>
    						</div>
    					</div>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
