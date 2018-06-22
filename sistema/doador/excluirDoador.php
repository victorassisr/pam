<?php
	require_once('conexao.php');

	$con = conexaoMysql();
	

	if(isset($_GET['id']) && $_GET['id'] != ""){

		$id = $_GET['id'];
	} else {
		$id = 0;
	}

	$sql = "SELECT * FROM doador WHERE id_doador = :id";

	$busca = $con->prepare($sql);
	$busca->bindValue(':id',$id);
	$busca->execute();

	if($busca->rowCount() < 1){
		echo "Usuario inexistente!";
		echo "<a href=\"listarDoadores.php\">Voltar</a>";
	} else {
		$sql = "DELETE FROM doador WHERE id_doador = :id";
		$excluir = $con->prepare($sql);
		$excluir->bindValue(':id',$id);
		$excluir->execute();

		if($excluir->rowCount() < 1){
			echo "Erro ao excluir.";
			echo "<a href=\"listarDoadores.php\">Voltar</a>";
		} else {
			echo "Excluido com sucesso!";
			echo "<a href=\"listarDoadores.php\">Voltar</a>";
		}
	}
?>