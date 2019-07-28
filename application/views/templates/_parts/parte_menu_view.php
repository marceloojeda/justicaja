<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">JUSTIÇA JÁ!</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?=base_url()?>monitor/Welcome">Home</a></li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						Meus Processos <span class="caret"></span>
					</a>
				    <ul class="dropdown-menu">
				      <li>
							<a href="<?=base_url()?>Pedido/Requisicao">Novo Processo</a>
							<a href="<?=base_url()?>Pedido/papsPendentes">Processos Pendentes</a>
							<a href="#">Processos Julgados</a>
				      </li>
				    </ul>
				</li>

				<li><a href="<?=base_url()?>monitor/Processos">Pauta de Julgamentos</a></li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
				<li><a href="../navbar-static-top/">Static top</a></li>
				<li><a href="<?=base_url()?>Account/logout?redirect=monitor">Sair</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</nav>