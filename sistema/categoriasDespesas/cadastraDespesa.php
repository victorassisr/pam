<?php

require_once("conexao.php");

$categoria = $_POST['catDesp'];

$sql = "INSERT 	INTO categoriasDespesa(nome) VALUES (:categoria)";

$con = conexaoMysql();


$inserir = $con->prepare($sql);

$inserir->bindValue(":categoria",$categoria);

$sqlValidacao = "SELECT nome FROM categoriasDespesa WHERE nome = :categoria";

$validacao = $con->prepare($sqlValidacao);
$validacao->bindValue(":categoria",$categoria);
$validacao->execute();

if($validacao->rowCount() == 0){

	$inserir->execute();

	if($inserir->rowCount() > 0){
		echo "<script>
				alert(\"Categoria cadastrada.\");
				location.href = \"index.php\";
			</script>";
	} else {
		echo "<script>
				alert(\"Categoria cadastrada.\");
			</script>";
	}
} else {
	echo "Categoria já existe!";
}
?>