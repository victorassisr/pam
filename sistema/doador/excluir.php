<?php
session_start();

	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}

?>
<?php
	if(isset($_GET['id']) && $_GET['id'] != ""){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gerência de Doadores</title>
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<body>
	<?php
		include("menu.php");
	?>

	<!-- Conteudo -->

	<?php
		include("menu_doador.php");
	?>
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>

<?php
} else {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Excluir Doador - Erro</title>
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<body>
	<?php
		include("menu.php");
	?>

	<!-- Conteudo -->
	<h3 class="text-center">Especifique um doador válido!</h3>

	<?php
		include("menu_doador.php");
	?>
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>

<?php
}	//Fim do else
?>