<?php

require_once("conexao.php");

date_default_timezone_set("America/Sao_Paulo");

$ano = date("Y");
$mes = date("m");

$dataIni = $ano . "-" .$mes."-01";
$dataFim = $ano . "-" .$mes."-30";

$con = conexaoMysql();

$sql = "SELECT valorDinheiro, valorCentavos FROM doacao WHERE dataDoacao >= '$dataIni' AND dataDoacao <= '$dataFim'";

$buscaDoacao = $con->prepare($sql);

$buscaDoacao->execute();

$valorDoacao = 0;

if($buscaDoacao->rowCount() > 0){
	$valores = $buscaDoacao->fetchAll(PDO::FETCH_OBJ);
	forEach($valores as $valor){
		$reais = (double)$valor->valorDinheiro . "." . $valor->valorCentavos;
		$valorDoacao += $reais;
	}

	echo $valorDoacao . "<br>";
}

//Busca Despesas

$sql = "SELECT reais, centavos FROM despesas WHERE data >= '$dataIni' AND data <='$dataFim'";

$buscaDespesas = $con->prepare($sql);

$buscaDespesas->execute();

$valorDespesas = 0;

if($buscaDespesas->rowCount() > 0){
	$valores = $buscaDespesas->fetchAll(PDO::FETCH_OBJ);
	forEach($valores as $valor){
		$reais = (double)$valor->reais . "." . $valor->centavos;
		$valorDespesas += $reais;
	}

	echo $valorDespesas;
}