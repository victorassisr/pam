<?php
	require_once('conexao.php');
	$con = conexaoMysql();

	$json = file_get_contents('php://input');

	$campanha = json_decode($json);

	if($campanha->nome == ""){
		$resposta["resultado"] = "O nome não pode ficar vazio!";
		echo json_encode($resposta);
		exit();
	}

	if($campanha->dataInicial == ""){
		$resposta["resultado"] = "A data inicial não pode ficar vazia!";
		echo json_encode($resposta);
		exit();
	}

	if($campanha->dataFinal == ""){
		$resposta["resultado"] = "A data final não pode ficar vazia!";
		echo json_encode($resposta);
		exit();
	}

	if($campanha->dataFinal < $campanha->dataInicial){
		$resposta["resultado"] = "A data final não pode ser menor que a data inicial!";
		echo json_encode($resposta);
		exit();
	}

	if($campanha->nome != "" && $campanha->dataInicial != "" && $campanha->dataFinal != ""){

		$sql = "SELECT nomeCampanha FROM campanhas WHERE nomeCampanha = :nome";
		$valida = $con->prepare($sql);
		$valida->bindValue(':nome',$campanha->nome);
		$valida->execute();

		if($valida->rowCount() == 0){
			$sql = "INSERT INTO campanhas (nomeCampanha,dataInicial,dataFinal) VALUES (:nome,:dataInicial,:dataFinal)";
			$cadastra = $con->prepare($sql);
			$cadastra->bindValue(':nome',$campanha->nome);
			$cadastra->bindValue(':dataInicial',$campanha->dataInicial);
			$cadastra->bindValue(':dataFinal',$campanha->dataFinal);

			$cadastra->execute();

			if($cadastra->rowCount() == 1){
				
				$resposta["resultado"] = "Campanha cadastrada com sucesso!";				
				echo json_encode($resposta);
				exit();
			} else {
				$resposta["resultado"] = "Erro ao cadastrar!";
				echo json_encode($resposta);
				exit();
			}
		} else {
			$resposta["resultado"] = "O nome dessa campanha já está cadastrado!";
			echo json_encode($resposta);
			exit();
		}
	} else {
		$resposta["resultado"] = "Especifique todos os dados corretamente!";
		echo json_encode($resposta);
		exit();
	}
?>