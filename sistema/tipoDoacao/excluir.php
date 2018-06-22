<?php

	require_once("conexao.php");

	if(isset($_GET["id"]) == true){

	$id = $_GET["id"];

	$con = conexaoMysql();

	$validar = $con->prepare("SELECT id_tipoDoacao FROM tipoDoacao WHERE id_tipoDoacao = '$id'");

	$validar->execute();

	if($validar->rowCount() < 1){
		echo "Registro inexistente";
	} else{

		$sql = "SELECT id_tipoDoacao FROM doacao WHERE id_tipoDoacao = :id";
		$validar = $con->prepare($sql);
		$validar->bindValue(':id',$id);
		$validar->execute();

		if($validar->rowCount() > 0){
			echo "<h1>Tipo de doação cadastrada em doação(ões)!</h1>\n<p>Você não pode excluir essa categoria!</p>";
			echo "<a href=\"../\">Voltar</a>";
		} else {
			$query = $con->prepare("DELETE FROM tipoDoacao WHERE id_tipoDoacao=:id");
			$query->bindValue(':id',$id);
			$query->execute();

			if($query->rowCount() > 0){
				echo "Deletado com sucesso!";
				echo "<a href=\"../\">Voltar</a>";
			} else{
				echo "Não foi possivel deletar.";
				echo "<a href=\"../\">Voltar</a>";
			}
		}

	}
} else{
	echo "Ops, algo de errado não está correto! =/";
	echo "<a href=\"../\">Voltar</a>";
}

echo "<a href=\"../\">Voltar</a>";
$con = null;
?>