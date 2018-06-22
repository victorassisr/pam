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
		<title>Despesas</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
	</head>
	<body>
	<?php include("menu.php"); ?>
	<div class="container">	
			<table class="table table-hover table-white table-responsive-xm">
			  <thead>
			    <tr>
		    	 	<th scope="col">DESPESAS</th>
		    	 	<th scope="col">Descrição</th>
		    	 	<th scope="col">Vencimento</th>
		    	 	<th scope="col">Valor</th>
		    	 	<th scope="col">Editar</th>
		    	 	<th scope="col">Excluir</th>
		    	</tr>
		 	  </thead>
		  	  <tbody>

<?php
require_once('conexao.php');

$con = conexaoMysql();

$sql = "SELECT * FROM despesas";

$listar = $con->prepare($sql);

$listar->execute();

if($listar->rowCount() > 0){

$despesas = $listar->fetchAll(PDO::FETCH_OBJ);

//Buscar Categorias de despesas:
$sql = "SELECT * FROM categoriasDespesa";
$listar = $con->prepare($sql);
$listar->execute();
$categorias = $listar->fetchAll(PDO::FETCH_OBJ);

foreach ($despesas as $despesa) {
			$categoriaAtual = "";
			foreach ($categorias as $categoria) {
				if($categoria->id == $despesa->idCategoria){
					$categoriaAtual = $categoria->nome;
				}
			}
?>
		    	<tr>
		      		<td><?php echo $categoriaAtual; ?></td>
		      		<th><?php echo $despesa->infoDespesa; ?></th>
		      		<th scope="row"><?php echo $despesa->data; ?></th>
		      		<th scope="row"> <?php echo $despesa->reais . "," . $despesa->centavos; ?></th>
		      		<th scope="row"><a href="editarDespesa.php?id=<?php echo $despesa->idDespesa; ?>"><i class="material-icons">edit</i></a></th>
		      		<th scope="row"> <a href="excluirDespesa.php?id=<?php echo $despesa->idDespesa; ?>"class="icon-excluir" title="Deletar">
		   				<i class="material-icons">delete</i>
		   			</th>
		    	</tr>

		
	<?php
	}
} else {
	?>
	<h1 class="titulo">Nenhuma despesa cadastrada</h1>
	<?php
	} ?>
		</tbody>
		</table>
	</div>
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