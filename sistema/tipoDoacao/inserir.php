<?php
if(isset($_POST["tipoDoacao"]) == true && $_POST['tipoDoacao'] != ""){
	require_once("conexao.php"); //Inclui o arquivo de conexão com o BD;

	$con = conexaoMysql();

	$validar = $con->prepare("SELECT * FROM tipoDoacao WHERE nome=:nome");
	$validar->bindValue(':nome',$_POST["tipoDoacao"]);
	$validar->execute();
	
if($validar->rowCount() < 1){

		$nome = $_POST["tipoDoacao"]; //Valor do input vindo do Form;

		$query = $con->prepare("INSERT INTO tipoDoacao(nome) VALUES (:nome)");
		$query->bindValue(':nome',$nome);
		$query->execute();

		if($query->rowCount() > 0){
			echo "Inserido com sucesso!";
			echo "<a href=\"../\">Voltar</a>";
		} else{
			echo "Valores vazios. Corrija.";
			echo "<a href=\"../\">Voltar</a>";
		}
	} else{
		echo "Categoria já cadastrada..";
		echo "<a href=\"../\">Voltar</a>";
	}
}

echo "<a href=\"../\">Voltar</a>";
$con = null;
?>