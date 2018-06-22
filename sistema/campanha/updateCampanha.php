<?php

require_once('conexao.php');

$con = conexaoMysql();

	if($_POST['nomeCampanha'] != "" && $_POST['id'] != ""){
		
		$nome = $_POST['nomeCampanha'];

		if($_POST['dataInicial'] == ""){
			$dataInicial = "00-00-0000";
		} else {
			$dataInicial = $_POST['dataInicial'];
		}

		if($_POST['dataFinal'] == ""){
			$dataFinal = "00-00-0000";
		} else {
			$dataFinal = $_POST['dataFinal'];
		}

		$id = $_POST['id'];

		$sql = "SELECT * FROM campanhas WHERE id_campanha = :id";
		$valida = $con->prepare($sql);
		$valida->bindValue(':id',$id);
		$valida->execute();

		if($valida->rowCount() == 1){
			$retorno = $valida->fetch(PDO::FETCH_OBJ);

			if($retorno->nomeCampanha == $nome){
				$sql = "UPDATE campanhas SET nomeCampanha = :nome, dataInicial = :dataInicial, dataFinal = :dataFinal WHERE id_campanha=:id";
				$edita = $con->prepare($sql);
				$edita->bindValue(':id',$id);
				$edita->bindValue(':nome',$nome);
				$edita->bindValue(':dataInicial',$dataInicial);
				$edita->bindValue(':dataFinal',$dataFinal);

				$edita->execute();

				if($edita->rowCount() == 1){
					alert("Alterado com sucesso!");
				} else {
					echo "Erro: Nada a alterar!";
					echo "<br><br><a href=\"http://10.0.0.50/\">Voltar</a>";
				}
			} else {
				$sql = "SELECT * FROM campanhas WHERE nomeCampanha = :nome";
				$valida = $con->prepare($sql);
				$valida->bindValue(':nome',$nome);
				$valida->execute();

				if($valida->rowCount() == 0){
					$sql = "UPDATE campanhas SET nomeCampanha = :nome, dataInicial = :dataInicial, dataFinal = :dataFinal WHERE id_campanha=:id";
					$edita = $con->prepare($sql);
					$edita->bindValue(':id',$id);
					$edita->bindValue(':nome',$nome);
					$edita->bindValue(':dataInicial',$dataInicial);
					$edita->bindValue(':dataFinal',$dataFinal);

					$edita->execute();

					if($edita->rowCount() == 1){
						echo "Cadastrado com sucesso!";
						echo "<br><br><a href=\"http://10.0.0.50/\">Voltar</a>";
					} else {
						echo "Erro ao cadastrar!";
						echo "<br><br><a href=\"http://10.0.0.50/\">Voltar</a>";
					}
				} else {
					echo "O nome já existe cadastrado!";
					echo "<br><br><a href=\"http://10.0.0.50/\">Voltar</a>";
				}
			}
		}

	} else {
		echo "Você deve especificar um elemento válido para ser alterado!";
	}

	$con = null;

	?>