<?php
session_start();
	require_once('conexao.php');

	$sql = "SELECT * FROM categoriasDespesa";

	$con = conexaoMysql();

	$busca = $con->prepare($sql);

	$busca->execute();

	$categorias = $busca->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro de despesas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body>
	<?php  include("menu.php") ?>
	<h1 class="titulo container">Cadastro de Despesas</h1>

<form action="cadastrarDespesa.php" method="post" class="form-group container">
	<fieldset>
		<div>
			<select name="idCategoria" class="form-control">
				<option value="default">Categoria da Despesa</option>
				<?php foreach($categorias as $categoria){ ?>
					<option  value="<?php echo $categoria->id; ?>"> 
						<?php echo $categoria->nome; ?>
					</option>
				<?php } ?>
			</select>
		</div>
			<label>Descrição:</label>
			<input type="text" name="infoDespesa" class="form-control">
		<div class="form-row">
			<div class="col">	
					<label>Valor: </label>
					<input type="text" name="reais">,<input type="number" name="centavos" maxlength="2" class="cents">
			</div>	
			<div class="col">
				<label>Data de vencimento: </label>
				<input type="date" name="dataDespesa">
			</div>
		</div>
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