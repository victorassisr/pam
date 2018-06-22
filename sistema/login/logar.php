<?php
session_start();
	require_once("../conexao.php");

	$con = conexaoMysql();

	$usuario = $_POST["usuario"];
	$senha = $_POST["senha"];

	$query = $con->prepare("SELECT * FROM usuarios WHERE nome_usuario=:usuario AND senha=:senha");

	$query->bindValue(':usuario',$usuario);
	$query->bindValue(':senha',$senha);

	$query->execute();

	$retorno = $query->fetch(PDO::FETCH_OBJ);

	if($query->rowCount() == 1){
		echo "Logar!";
		echo "\nBem vindo: " . $retorno->nome_usuario;
		$_SESSION["logado"] = 'logado';
		$_SESSION["nivel"] = $retorno->nivel;
		//header('location:http://google.com');
	} else{
		echo "Não logar!";
	}

?>