<?php 
session_start();
	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}
	
	require_once("conexao.php");

	$con = conexaoMysql();

	$sql = "SELECT * FROM opcoesRelatorio";

	$busca = $con->prepare($sql);

	$busca->execute();
	
	if($busca->rowCount() > 0){
		$opcoes = $busca->fetchAll(PDO::FETCH_OBJ);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Relatórios</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>

</head>
<body>
	<?php include ("menu.php"); ?>
	<div class="container">
		<h2 class="titulo"> Relatórios</h2>
		<form action="pesquisa.php" method="post" class="form-group">
			<div>
				<select name="opcao" class="form-control">
					<?php
						foreach ($opcoes as $opcao)
						{ ?>
						 	<option value="<?php echo $opcao->nome; ?>" required>
						 		<?php
						 			echo $opcao->nome;
						 		?>
						 	</option>
						<?php } 
					?>
				</select>
				<div class="row">
					<div class="col-md-6">
						<label><b>Data Inicial:</b></label><br/>
						<input type="date" name="dataInicial" required>
					</div>
					<div class="col-md-6">
						<label>Data Final: </label><br/>
						<input type="date" name="dataFinal" required>
					</div>
				</div>
			</div>
			<div>
				<button type="submit" class="btn mt-40">Pesquisar</button>
			</div>
		</form>
		</div>
	<?php include ("rodape.php"); ?>
</body>
</html>