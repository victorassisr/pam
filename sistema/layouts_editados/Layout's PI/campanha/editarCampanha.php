<?php
	if(isset($_GET['id']) && $_GET['id'] != ""){

		$id = $_GET['id'];

		require_once('conexao.php');

		$con = conexaoMysql();

		$sql = "SELECT * FROM campanhas WHERE id_campanha = :id";

		$listar = $con->prepare($sql);

		$listar->bindValue(':id',$id);

		$listar->execute();

		if($listar->rowCount() == 1){

		$campanha = $listar->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html ng-app="editarCampanha">
<head>
	<title>Editar Campanha</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body ng-controller="editarCampanhaCtrl">
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
		<h2>Editar Campanha</h2>
		<form class="form-group" action="updateCampanha.php" method="post" ng-submit="submitForm()">
			<label for="campanha">Nome da Campanha</label>
			<input class="form-control" type="text" name="nomeCampanha" id="nomeCampanha" value="<?php echo $campanha->nomeCampanha; ?>" required>

			<br><br>
			<div class="row">
				<div class="col-md-6">
					<label for="campanha">Data de Inicio</label><br>
					<input type="date" name="dataInicial" id="dataInicial" value="<?php echo $campanha->dataInicial; ?>" >
				</div>
				<div class="col-md-6">
					<label for="campanha">Nome de Término</label><br>
					<input type="date" name="dataFinal" id="dataFinal" value="<?php echo $campanha->dataFinal; ?>" >
				</div>
				<input type="hidden" name="id" value="<?php echo $campanha->id_campanha; ?>">
			</div><br><br>
			<input class="btn" type="submit" value="Editar Campanha" />
		</form>
	</div>
		<footer class="container-fluid">
		<p>AMPARO MATERNAL - EURÍPEDES NOVELINO &copy; - <?php echo date('Y');?></p>
	</footer>


	
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="../geral/js/chart.js"></script> -->
<script type="text/javascript" src="../geral/js/script.js"></script>
<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>

<?php 

		} else{
			echo "Voce deve selecionar um elemento válido para ser editado!";
			echo "<a href=\"lista.php\">Voltar</a>";
		}
	} else {
		echo "Voce deve selecionar um elemento válido para ser editado!";
		echo "<a href=\"lista.php\">Voltar</a>";
	}