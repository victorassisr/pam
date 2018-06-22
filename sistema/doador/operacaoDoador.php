<?php

$sucesso = false;

if(isset($_GET["acao"]) && $_GET["acao"] != "" && $_GET["acao"] == "top10"){

	require_once("conexao.php");

	$con = conexaoMysql();

	$sql = "SELECT nome FROM doador ORDER BY id_doador DESC LIMIT 0,10";

	$busca = $con->prepare($sql);

	$busca->execute();

	if($busca->rowCount() > 0){
		$dados = $busca->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($dados);
	} else {
		$resposta["resposta"] = "Não foi encontrado ninguém cadastrado ainda.";
		echo json_encode($resposta);
	}
	$sucesso = true;
	
}

if(isset($_GET["acao"]) && $_GET["acao"] != "" && $_GET["acao"] == "listar"){

	require_once("conexao.php");

	$con = conexaoMysql();

	$sql = "SELECT id_doador, nome FROM doador ORDER BY id_doador DESC LIMIT 0,20";

	$busca = $con->prepare($sql);

	$busca->execute();

	if($busca->rowCount() > 0){
		$dados = $busca->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($dados);
	} else {
		$resposta["resposta"] = "Não foi encontrado ninguém cadastrado ainda.";
		echo json_encode($resposta);
	}
	
	$sucesso = true;
}

if(isset($_GET["acao"]) && $_GET["acao"] != "" && $_GET["acao"] == "buscar" && isset($_GET["id"]) && $_GET["id"] != ""){

	require_once("conexao.php");

	$con = conexaoMysql();

	$sqlBusca = "SELECT * FROM doador WHERE id_doador = :id";

	$busca = $con->prepare($sqlBusca);

	$busca->bindValue(':id',$_GET["id"]);

	$busca->execute();

	if($busca->rowCount() > 0){
		$doador = $busca->fetch(PDO::FETCH_OBJ);
		echo json_encode($doador);
	} else {
		$resposta["resposta"] = "Não foi encontrado nenhum doador com os parametros especificados.";
		echo json_encode($resposta);
	}
	
	$sucesso = true;
}

if(isset($_GET["acao"]) && $_GET["acao"] != "" && $_GET["acao"] == "excluir" && isset($_GET['id']) && $_GET['id'] != ""){

	require_once("conexao.php");

	$con = conexaoMysql();

	$sqlEsclusao = "DELETE FROM doador WHERE id_doador = :id";

	$busca = $con->prepare($sqlEsclusao);

	$busca->bindValue(':id',$_GET["id"]);

	$busca->execute();

	if($busca->rowCount() > 0){
		$resposta["sucesso"] = "Doador excluido com sucesso!";
		echo json_encode($resposta);
	} else {
		$resposta["resposta"] = "Não foi encontrado nenhum doador com os parametros especificados.";
		echo json_encode($resposta);
	}
	
	$sucesso = true;
}

if(isset($_GET["acao"]) && $_GET["acao"] != "" && $_GET["acao"] == "busca"){

	require_once("conexao.php");

	$con = conexaoMysql();

	$sqlBusca = "SELECT * FROM doador WHERE id_doador = :id";

	$busca = $con->prepare($sqlBusca);

	$busca->bindValue(':id',$_GET["id"]);

	$busca->execute();

	if($busca->rowCount() > 0){
		$doador = $busca->fetch(PDO::FETCH_OBJ);
		echo json_encode($doador);
	} else {
		$resposta["resposta"] = "Não foi encontrado nenhum doador com os parametros especificados.";
		echo json_encode($resposta);
	}
	
	$sucesso = true;
}

if(!$sucesso){
	echo "ExceptionErro : Nada a mostrar por aqui.";
}

?>