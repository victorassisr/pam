<?php
	session_start();
	if(isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/sistema/");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark">
		<a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

		<span id="nome">Amparo Maternal Euripedes Novelino</span>
	</nav>
	<div class="container">
		<div class="row">
	<form action="login.php" class="col-md-6 m-auto formLogin" method="POST">
			<div class="form-group">
				<label>Usuario:</label>
				<input type="text" class="form-control" name="usuario" required>
			</div>
			<div class="form-group">
				<label>Senha:</label>
				<input type="password" class="form-control" name="senha" required>
			</div>
			<?php if(isset($_GET["erro"]) && $_GET["erro"] == 1){ ?>
				<div class="form-group erro">
					<span>Usuário inexistente.</span>
				</div>
			<?php } ?>
			<?php if(isset($_GET["erro"]) && $_GET["erro"] == 2){ ?>
				<div class="form-group erro">
					<span>Nome de usuário não pode ficar em branco!</span>
				</div>
			<?php } ?>
			<?php if(isset($_GET["erro"]) && $_GET["erro"] == 3){ ?>
				<div class="form-group erro">
					<span>Senha não pode ficar em branco!</span>
				</div>
			<?php } ?>
			<div class="form-group erro">
				<button class="btn btn-primary">Login</button>
			</div>
			<div>
				<a href="../" title="Voltar ao site" alt="Voltar ao site">Voltar ao Site</a>
			</div>
	</form>
	</div>
</div>
<?php include("rodape.php"); ?>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>