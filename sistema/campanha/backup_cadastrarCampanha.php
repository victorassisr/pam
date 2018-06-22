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
	<?php  include("menu.html");
	
	require_once('conexao.php');

$con = conexaoMysql();

	if($_POST['nomeCampanha'] != ""){
		$nome = $_POST['nomeCampanha'];

		if($_POST['dataInicial'] == ""){
			$dataInicial = "00-00-0000";
		} else {
			$dataInicial = $_POST['dataInicial'];
		}

		if($_POST['dataFinal'] == ""){
			$dataFinal = "00-00-0000";
		} else {
			$dataFinal = $_POST['dataFinal'];
		}

		$sql = "SELECT nomeCampanha FROM campanhas WHERE nomeCampanha = :nome";
		$valida = $con->prepare($sql);
		$valida->bindValue(':nome',$nome);
		$valida->execute();

		if($valida->rowCount() == 0){
			$sql = "INSERT INTO campanhas (nomeCampanha,dataInicial,dataFinal) VALUES (:nome,:dataInicial,:dataFinal)";
			$cadastra = $con->prepare($sql);
			$cadastra->bindValue(':nome',$nome);
			$cadastra->bindValue(':dataInicial',$dataInicial);
			$cadastra->bindValue(':dataFinal',$dataFinal);

			$cadastra->execute();

			if($cadastra->rowCount() == 1){
				
				echo "<div  class=\"container\"><h1>Campanha cadastrada com sucesso!</h1>";
				echo "<br><br><a href=\"index.php\">Voltar</a></div>";
			} else {
				echo "<div  class=\"container\"><h2>Houve um erro ao cadastrar!</h2>";
				echo "<br><br><a href=\"index.php\">Voltar</a></div>";
			}
		} else {
			echo "<div class=\"container\"><h2>O nome já existe cadastrado!</h2>";
			echo "<br><br><a href=\"index.php\">Voltar</a></div>";
		}

	} else {
		echo "<div  class=\"container\">A campanha deve ter pelo menos um nome.";
		echo "<br><br><a href=\"index.php\">Voltar</a></div>";
	}

	include("footer.html");
	?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="../geral/js/chart.js"></script> -->
<script type="text/javascript" src="../geral/js/script.js"></script>
<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>

<?php

require_once('conexao.php');

$con = conexaoMysql();

	if($_POST['nomeCampanha'] != ""){
		$nome = $_POST['nomeCampanha'];

		if($_POST['dataInicial'] == ""){
			$dataInicial = "00-00-0000";
		} else {
			$dataInicial = $_POST['dataInicial'];
		}

		if($_POST['dataFinal'] == ""){
			$dataFinal = "00-00-0000";
		} else {
			$dataFinal = $_POST['dataFinal'];
		}

		$sql = "SELECT nomeCampanha FROM campanhas WHERE nomeCampanha = :nome";
		$valida = $con->prepare($sql);
		$valida->bindValue(':nome',$nome);
		$valida->execute();

		if($valida->rowCount() == 0){
			$sql = "INSERT INTO campanhas (nomeCampanha,dataInicial,dataFinal) VALUES (:nome,:dataInicial,:dataFinal)";
			$cadastra = $con->prepare($sql);
			$cadastra->bindValue(':nome',$nome);
			$cadastra->bindValue(':dataInicial',$dataInicial);
			$cadastra->bindValue(':dataFinal',$dataFinal);

			$cadastra->execute();

			if($cadastra->rowCount() == 1){
				
				echo "<div  class=\"container\"><h1>Campanha cadastrada com sucesso!</h1>";
				echo "<br><br><a href=\"index.php\">Voltar</a></div>";
			} else {
				echo "<div  class=\"container\"><h2>Houve um erro ao cadastrar!</h2>";
				echo "<br><br><a href=\"index.php\">Voltar</a></div>";
			}
		} else {
			echo "<div class=\"container\"><h2>O nome já existe cadastrado!</h2>";
			echo "<br><br><a href=\"index.php\">Voltar</a></div>";
		}

	} else {
		echo "<div  class=\"container\">A campanha deve ter pelo menos um nome.";
		echo "<br><br><a href=\"index.php\">Voltar</a></div>";
	}

?>