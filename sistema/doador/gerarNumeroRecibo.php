<?php
	require("conexao.php");

	$con = conexaoMysql();

	$sql = "SELECT id, numero FROM numeroRecibo";

	$busca = $con->prepare($sql);

	$busca->execute();

	if($busca->rowCount() > 0){
		
		$num = $busca->fetch(PDO::FETCH_OBJ);
		$numero = (int)$num->numero;
		$numero = $numero+1;

		$sqlIncrement = "UPDATE numeroRecibo SET numero = :numero WHERE id = :id";
		$inserir = $con->prepare($sqlIncrement);
		$inserir->bindValue(":id", $num->id);
		$inserir->bindValue(":numero", $numero);
		$inserir->execute();

		if($inserir->rowCount() > 0){
			$a["numero"] = $numero;
			echo json_encode($a);
			exit();
		} else {
			$a["erro"] = "Houve um erro ao gerar o numero do recibo";
			echo json_encode($a);
			exit();
		}

	}

	if($busca->rowCount() == 0){
		$sqlInicial = "INSERT INTO numeroRecibo(numero) VALUES (:numero)";
		$inserir = $con->prepare($sqlInicial);
		$inserir->bindValue(":numero", 1);
		$inserir->execute();

		if($inserir->rowCount() > 0){
			$a["numero"] = "1";
			echo json_encode($a);
			exit();
		} else {
			$a["erro"] = "Houve um erro ao gerar o numero do recibo";
			echo json_encode($a);
			exit();
		}

	}
?>