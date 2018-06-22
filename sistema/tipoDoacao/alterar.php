<?php

if(isset($_GET["id"]) == true && $_GET["id"] != ""){
	require_once("conexao.php");

	$id = $_GET["id"];

	$con = conexaoMysql();

	$validar = $con->prepare("SELECT * FROM tipoDoacao WHERE id_tipoDoacao=:id");
	$validar->bindValue(':id',$id);
	$validar->execute();


	if($validar->rowCount() > 0){
		$tipoDoacao = $validar->fetch(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Alterar tipo de Doacão</title>
</head>
<body>
	<form action="updateTipoDoacao.php" method="POST">
		<input type="text" name="tipoDoacao" value="<?php echo $tipoDoacao->nome; ?>" placeholder="Categoria da Doacao">
		<input type="hidden" name="id" value="<?php echo $tipoDoacao->id_tipoDoacao; ?>">
		<input type="submit" name="Enviar" value="Enviar">
	</form>
</body>
</html>

<?php

	} else{
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>Alterar tipo de Doacão</title>
		</head>
		<body>
			<h1>Tipo de doação inexistente!</h1>
			<h4>Selecione uma válida e tente novamente!</h4>
			<a href="../">Voltar</a>
		</body>
		</html>
<?php
	}

}

?>