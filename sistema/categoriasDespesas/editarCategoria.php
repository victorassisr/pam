<?php

require_once("conexao.php");

$con = conexaoMysql();

$sql = "SELECT nome FROM categoriasDespesa WHERE id = :id";

$id = $_GET['id'];

$busca = $con->prepare($sql);

$busca->bindValue(":id",$id);
$busca->execute();

$categoria = $busca->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar categoria despesa</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body>
	<?php include ("../cadastroDespesas/menu.html"); ?>
	<div class="attCat container">
		<h2 class="titulo">Atualizar Categoria</h2>
		<form action="updateCategoria.php" method="post" class="form-group">
			<input type="text" name="catDesp" class="form-control" placeholder="Nome da Categoria" value="<?php echo $categoria->nome; ?>">
			<input type="hidden" name="idCategoria" value="<?php echo $id; ?>">
			<br><br>
			<input type="submit" value="Atualizar" class="btn">
		</form>
	</div>
	<?php include("rodape.php"); ?>
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../geral/js/script.js"></script>
</body>
</html>