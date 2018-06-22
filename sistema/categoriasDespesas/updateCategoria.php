<?php

require_once("conexao.php");

$categoria = $_POST['catDesp'];
$id = $_POST['idCategoria'];

$sql = "UPDATE categoriasDespesa SET nome=:categoria WHERE id=:id";

$con = conexaoMysql();


$inserir = $con->prepare($sql);

$inserir->bindValue(":categoria",$categoria);
$inserir->bindValue(":id",$id);

$sqlValidacao = "SELECT nome FROM categoriasDespesa WHERE nome = :categoria";

$validacao = $con->prepare($sqlValidacao);
$validacao->bindValue(":categoria",$categoria);
$validacao->execute();

if($validacao->rowCount() == 0){

	$inserir->execute();

	if($inserir->rowCount() > 0){
		echo "<script>
			alert(\"Categoria atualizada.\");
			location.href = \"index.php\";
		</script>";
	} else {
		echo "<script>
			alert(\"Não foi possível atualizar.\");
			location.href = \"index.php\";
		</script>";
	}
} else {
	echo "<script>
			alert(\"Categoria já existe!\");
			location.href = \"editarCategoria.php?id=$id\";
		</script>";
}
?>