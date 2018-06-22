<?php
session_start();

	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Gerência de Doadores</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/listar.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-dark">
		<a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

		<span id="nome">Amparo Maternal Euripedes Novelino</span>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../inicio/index.php">Início</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle ativo" href="#" id="dropdownDoador" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Doador<span class="sr-only">(current)</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="cadastrar.php">Cadastrar</a>
					<a class="dropdown-item dropdown-ativo-bt-bb" href="listar.php">Listar</a>
					<a class="dropdown-item" href="buscar.php">Buscar</a>
				</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../campanha/">Campanhas</a>
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

	<!-- Conteudo -->
	<section ng-app="listarDoadores" ng-controller="controladorListarDoadores">
		<h2 class="titulo text-center">Doadores</h2>
		<div class="text-center"><span class="erro">{{erro}}</span></div>
		<ul class="list-group">
			<li class="list-group-item d-flex justify-content-between align-items-center" ng-repeat="doador in doadores track by $index">
				<div class="nome">
					{{doador.nome}}
				</div>
				<div class="acoesDoador">
					<a class="badge badge-pill botaoAcao" href="editar.php?id={{doador.id_doador}}" title="Editar o doador {{doador.nome}}">
						<i class="material-icons">edit</i>
					</a>
					<a class="badge badge-pill botaoAcao" ng-click="excluir(doador.id_doador, doador.nome)" title="Excluir o doador {{doador.nome}}">
						<i class="material-icons">delete</i>
					</a>
					<a class="badge badge-pill botaoAcao" href="recibo.php?id={{doador.id_doador}}" title="Gerar recibo para doador {{doador.nome}}">
						<i class="material-icons">receipt</i>
					</a>
					<a class="badge badge-pill botaoAcao" href="info.php?id={{doador.id_doador}}" title="Informações do doador {{doador.nome}}">
						<i class="material-icons">info</i>
					</a>
				</div>
			</li>
		</ul>
	</section>


	<?php
		include("rodape_doador.php");
	?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/listar.js"></script>
</body>
</html>