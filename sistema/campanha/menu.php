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
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle ativo" href="#" id="dropdownDoador" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Campanhas<span class="sr-only">(current)</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="cadastro.php">Cadastrar</a>
					<a class="dropdown-item" href="index.php">Ativas</a>
					<a class="dropdown-item" href="lista.php">Listar todas</a>
				</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../cadastroDespesas/">Despesas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../relatorio/">Relatórios</a>
				</li>
				<?php if(isset($_SESSION["logado"])){ ?>
				<li class="nav-item">
					<a class="nav-link" href="../logout.php">Sair</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</nav>