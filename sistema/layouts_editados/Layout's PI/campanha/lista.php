<!DOCTYPE html>
<html ng-app="campanhas">
<head>
	<title>Campanhas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body ng-controller="campanhasCtrl">
	<nav class="navbar navbar-expand-lg navbar-dark">
		<a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

		<span id="nome">Amparo Maternal Euripedes Novelino</span>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../inicio/index2.php">Início</a>
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
					<a class="nav-link" href="#">Despesas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Relatórios</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">	
		<table class="table table-hover table-dark table-responsive-xm">
		  <thead>
		    <tr>
		      <th scope="col">CAMPANHAS</th>
		      <th scope="col">Início</th>
		      <th scope="col">Término</th>
		      <th scope="col">Editar</th>
		      <th scope="col">Excluir</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr ng-repeat="campanha in campanhas">
		      <td>{{campanha.nomeCampanha}}</td>
		      	<th scope="row">{{campanha.dataInicial | date:'dd/MM/yyyy'}}</th>
		      	<th scope="row">{{campanha.dataFinal | date:'dd/MM/yyyy'}}</th>
		      	<th scope="row"><a href="editarCampanha.php?id={{campanha.id_campanha}}"><i class="material-icons">edit</i></a></th>
		      	<th scope="row" ng-click="excluir(campanha.id_campanha, campanha.nomeCampanha)" class="icon-excluir" title="Deletar campanha - {{campanha.nomeCampanha}}">
		   			<i class="material-icons">delete</i>
		   		</th>
		    </tr>
		  </tbody>
		</table>
			</div>
		</div>
	</div>
<?php  include("rodape.php") ?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../geral/js/script.js"></script>
<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>