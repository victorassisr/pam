<nav class="navbar navbar-expand-lg navbar-dark">
		<a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

		<span id="nome">Amparo Maternal Euripedes Novelino</span>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../inicio/">Início</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../doador">Doador</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../campanha/">Campanhas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../cadastroDespesas/">Despesas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link ativo" href="../relatorio/">Relatórios</a>
				</li>
				<?php if(isset($_SESSION["logado"])){ ?>
				<li class="nav-item">
					<a class="nav-link" href="../logout.php">Sair</a>
				</li>
		  <?php } ?>
			</ul>
		</div>
	</nav>