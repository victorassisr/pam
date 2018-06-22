<?php

if(isset($_GET['id']) == false && $_GET['id'] != ""){
	echo "<h1>Selecione uma despesa válida para ser editada!</h1>";
} else {
	require_once('conexao.php');
	$con = conexaoMysql();

$id = $_GET['id'];

$sql = "SELECT * FROM despesas WHERE idDespesa = :id";

$listar = $con->prepare($sql);
$listar->bindValue(':id',$id);
$listar->execute();

if($listar->rowCount() > 0){

$despesa = $listar->fetch(PDO::FETCH_OBJ);

$sql = "SELECT * FROM categoriasDespesa";
$busca = $con->prepare($sql);
$busca->execute();

$categorias = $busca->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar despesa</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body>
<?php  include("menu.html") ?>
<h1 class="titulo container">Edição de despesas</h1>

<form action="updateDespesa.php" method="post" class="form-group container">
	<fieldset>
		<div>
			<select name="categoriaDespesa" class="form-control">
				<option value="default">Categoria da Despesa</option>
				<?php foreach($categorias as $categoria){
					if($categoria->id == $despesa->idCategoria){ ?>
					<option value="<?php echo $categoria->id; ?>" selected><?php echo $categoria->nome; ?></option>
					<?php } else {?>
					<option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nome; ?></option>
					<?php }} ?>
			</select>
		</div>
		<div>
			<label>Despesa:</label>
			<input class="form-control" type="text" name="infoDespesa" value="<?php echo $despesa->infoDespesa; ?>">
		</div>
		<div class="row">
			<div class="col">
				<label>Valor: </label>
				<input type="text" name="reais" value="<?php echo $despesa->reais; ?>">,
				<input type="number" name="centavos" maxlength="2" class="cents" value="<?php echo $despesa->centavos; ?>">
			</div>
			<div class="col">
				<label>Data da vencimento: </label>
				<input type="date" name="dataDespesa" value="<?php echo $despesa->data; ?>">
			</div>
		</div>

		<input type="hidden" name="idDespesa" value="<?php echo $despesa->idDespesa;?>">

		<input type="submit" value="Cadastrar" class="btn">
	</fieldset>
</form>

<?php 
	include("rodape.php");
?>
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../geral/js/script.js"></script>
<script type="text/javascript" src="js/despesas.js"></script>
</body>
</html>

<?php
	}
?>