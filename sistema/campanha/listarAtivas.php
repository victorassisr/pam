<?php

require_once('conexao.php');

$con = conexaoMysql();

date_default_timezone_set("America/Sao_Paulo");

$atual = Date("Y-m-d");



$sql = "SELECT * FROM campanhas WHERE '$atual' BETWEEN dataInicial AND dataFinal";

$listar = $con->prepare($sql);
$listar->execute();

if($listar->rowCount() > 0){
		$dados = $listar->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($dados);

	} else {
		$dados["resposta"] = "Não há campanhas ativas.";
		echo json_encode($dados);
	}
?>