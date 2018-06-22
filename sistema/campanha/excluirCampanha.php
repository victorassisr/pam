<?php

	require_once('conexao.php');

	$con = conexaoMysql();

	if(isset($_GET['id']) && $_GET['id'] != ""){

		$id_campanha = $_GET['id'];

		$sql = "SELECT * FROM doacao WHERE id_campanha = :id_campanha";

		$valida = $con->prepare($sql);
		$valida->bindValue(':id_campanha',$id_campanha);
		$valida->execute();

		if($valida->rowCount() == 0){
			$sql = "DELETE FROM campanhas WHERE id_campanha = :id_campanha";
			$deleta = $con->prepare($sql);
			$deleta->bindValue(':id_campanha',$id_campanha);
			$deleta->execute();

			if($deleta->rowCount() == 1){
				echo "Campanha deletada com sucesso!";
			} else {
				echo "Erro ao deletar campanha!";
			}

		} else {
			echo "<h1>ATENÇÂO!</h1>";
			echo "<p>Você tem doacoes cadastradas nessa campanha!</p>";
			echo "<p>Você não poderá apagar essa campanha a menos que não tenha nenhuma doação cadastrada nela.</p>";
		}

	} else {
		echo "Você deve especificar um elemento válido para ser <b>Excluído</b>!";
	}


	$con=null;