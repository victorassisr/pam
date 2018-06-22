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
	<title>Cadastrar categoria - Despesa</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">  
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body>
	<?php  include("../cadastroDespesas/menu.php") ?>

	<div class="row container">
		<div class="col-md-6  cadastrarCategoria">
			<h2 class="titulo">Cadastrar categoria</h2>
			<form action="cadastraDespesa.php" method="post" class="form-group">
				<input type="text" name="catDesp" placeholder="Nome da Categoria" class="form-control">
				<br><br>
				<input type="submit" value="Cadastrar" class="btn">
			</form>
		</div>
		<div class="col-md-6">
			<?php include("listarCategorias.php");  ?>
		</div>
	</div>

	<?php include("rodape.php"); ?>
</body>
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../geral/js/script.js"></script>
</html>