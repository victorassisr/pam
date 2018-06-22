<?php 
	require_once('conexao.php');
	$con = conexaoMysql();

	if(isset($_GET["acao"]) && $_GET["acao"] != "" && $_GET["acao"] == "excluir" && isset($_GET['id']) && $_GET['id'] != ""){
				$id_campanha = $_GET['id'];

		$sql = "SELECT * FROM doacao WHERE id_campanha = :id_campanha";

		$valida = $con->prepare($sql);
		$valida->bindValue(':id_campanha',$id_campanha);
		$valida->execute();

		$sqlCampanha = "SELECT * FROM campanhas WHERE id_campanha = :id_campanha";
		$verificaCampanha = $con->prepare($sqlCampanha);
		$verificaCampanha->bindValue(':id_campanha',$id_campanha);
		$verificaCampanha->execute();


		if($verificaCampanha->rowCount() > 0){
			$campanhaPadrao = $verificaCampanha->fetch(PDO::FETCH_OBJ);
			
			if($campanhaPadrao->nomeCampanha != "Nenhuma"){
				if($valida->rowCount() == 0){
					$sql = "DELETE FROM campanhas WHERE id_campanha = :id_campanha";
					$deleta = $con->prepare($sql);
					$deleta->bindValue(':id_campanha',$id_campanha);
					$deleta->execute();
					if($deleta->rowCount() > 0){
						$resposta["resultado"] = "Campanha deletada";
						echo json_encode($resposta);
						exit();
					}else{
						$resposta["resultado"] = "Campanha NÃO pode ser deletada";
						echo json_encode($resposta);
						exit();
					}
				} else {
					$resposta["resultado"] = "Campanha NÃO pode ser deletada. Existem doacoes cadastradas nela.";
					echo json_encode($resposta);
					exit();
				}
			} else {
				$resposta["resultado"] = "Campanha NÃO pode ser deletada. É uma campanha padrão!";
				echo json_encode($resposta);
				exit();
			}

		} else {
			$resposta["resultado"] = "Campanha NÃO é válida!";
			echo json_encode($resposta);
			exit();
		}
	} else {
		$resposta["resultado"] = "Campanha NÃO é válida!";
		echo json_encode($resposta);
		exit();
	}
	$con=null;
?>