<?php

require_once('conexao.php');

$con = conexaoMysql();

date_default_timezone_set("America/Sao_Paulo");

$sql = "SELECT * FROM despesas WHERE Date(data) = Date(NOW())";

$listar = $con->prepare($sql);
$listar->execute();

if($listar->rowCount() > 0){
		$dados = $listar->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($dados);

	}
?>