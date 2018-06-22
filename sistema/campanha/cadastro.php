<?php
session_start();

	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}

?>
<!DOCTYPE html>
<html ng-app="cadastroCampanha">
<head>
	<title>Cadastrar Campanha</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body ng-controller="cadastroCampanhaCtrl">
	<?php  include("menu.php") ?>
	<div class="container">
		<h3 class="titulo">Cadastrar Campanhas</h3>
		<form class="form-group" ng-submit="cadastroCamp()">
			<label for="campanha">Nome da Campanha</label><br/>
				<input class="form-control" type="text" name="nomeCampanha" id="nomeCampanha" ng-model="campanha.nome" required>
			<br>
			<label for="campanha">Data de início:</label><br/>
				<input type="date" name="dataInicial" id="dataInicial" ng-model="dataInicial" required><br>
			<br>
			<label for="campanha">Data de término:</label><br/>
				<input type="date" name="dataFinal" id="dataFinal" ng-model="dataFinal" required>
			<br><br>
			<input type="submit" value="Cadastrar" class="btn"/>
		</form>
	</div>

<?php  include("rodape.php") ?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="../geral/js/chart.js"></script> -->
<script type="text/javascript" src="../geral/js/script.js"></script>
<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>