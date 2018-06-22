<?php

require_once('conexao.php');

$con = conexaoMysql();

$sql = "SELECT * FROM campanhas";

$listar = $con->prepare($sql);

$listar->execute();

if($listar->rowCount() > 0){
		$dados = $listar->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($dados);

	} else {
		$resposta["resposta"] = "Não há campanhas cadastradas";
		echo json_encode($resposta);
	}
?>