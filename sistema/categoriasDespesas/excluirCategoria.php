<?php

require_once("conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM categoriasDespesa WHERE id=:id";

$con = conexaoMysql();

$sqlValidacao = "SELECT idCategoria FROM despesas WHERE idCategoria = :id";

$validacao = $con->prepare($sqlValidacao);
$validacao->bindValue(":id",$id);
$validacao->execute();

if($validacao->rowCount() == 0){
	$excluir = $con->prepare($sql);

	$excluir->bindValue(":id",$id);
	$excluir->execute();

	if($excluir->rowCount() > 0){
		echo "<script>
				alert(\"Categoria excluida.\");
				location.href = \"index.php\";
			</script>";
	} else {
		echo "<script>
				alert(\" Não foi possível excluir a categoria.\");
				location.href = \"index.php\";
			</script>";
	}
} else {
	echo "Voce não pode excluir essa categoria.\n\n<br>";
	echo "Pois existem despesas associadas à ela.";
}
?>