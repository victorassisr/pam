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
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/busca.css">
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
					<a class="dropdown-item" href="listar.php">Listar</a>
					<a class="dropdown-item dropdown-ativo-bt" href="buscar.php">Buscar</a>
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

	<div ng-app="buscaDoador" ng-controller="buscaDoadorCtrl" class="container">
		<h2 class="text-center p-20">O que deseja buscar?</h2>
		<form ng-submit="buscarDoador()">
			<div class="form-group">
				<input type="text" name="parametro" placeholder="Nome, endereço, etc..." id="parametro" ng-model="parametros.pesquisa" class="form-control">
			</div>
			<div class="form-group">
				<label id="labelData">Ou pesquise por data: </label>
				<input type="date" name="data" id="data" ng-model="data" class="form-control">
			</div>
			<select name="tipo" class="form-control" id="filtro" ng-value="parametros.tipoDeBusca" ng-model="parametros.tipoDeBusca">
					<option ng-model="parametros.tipoDeBusca" ng-repeat="busca in buscas track by $index">{{busca.tipoBusca}}</option>
			</select>
			<button class="btn btn-default m-auto" type="submit">Procurar</button>
		</form>
		<hr>
		<div class="found">
			<h3 class="text-center" ng-show="not_found">{{notFound}}</h3>
			<div class="listFound" ng-repeat="doador in doadores">
				{{doador.nome}}
			</div>
		</div>
	</div>

	<?php include("rodape_doador.php"); ?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/buscar.js"></script>
</body>
</html>