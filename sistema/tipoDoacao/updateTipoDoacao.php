<?php

require_once('conexao.php');

$con = conexaoMysql();
if(isset($_POST['tipoDoacao']) && $_POST['tipoDoacao'] != "" && isset($_POST['id']) && $_POST['id'] != ""){

	$nome = $_POST['tipoDoacao'];
	$id = $_POST['id'];

	$sql = "SELECT nome FROM tipoDoacao WHERE nome = :nome";

	$validar = $con->prepare($sql);
	$validar->bindValue(':nome',$nome);
	$validar->execute();

	if($validar->rowCount() > 0){
		echo "Nome já existe cadastrado!";
		echo "<br><br><a href=\"../\">Voltar</a>";
	} else {
		$sql = "SELECT id_tipoDoacao FROM doacao WHERE id_tipoDoacao = :id";
		$validar = $con->prepare($sql);
		$validar->bindValue(':id',$id);
		$validar->execute();

		if($validar->rowCount() > 0){
			echo "<h1>Erro!</h1>";
			echo "<p>Você não pode alterar esse tipo de doação, pois existem doações cadastradas nela.</p>";
			echo "<br><br><a href=\"../\">Voltar</a>";
		} else {
			$sql = "UPDATE tipoDoacao SET nome=:nome WHERE id_tipoDoacao = :id";
			$atualizar = $con->prepare($sql);
			$atualizar->bindValue(':nome',$nome);
			$atualizar->bindValue(':id',$id);
			$atualizar->execute();

			if($atualizar->rowCount() > 0){
				echo "Alterado com sucesso!";
				echo "<br><br><a href=\"../\">Voltar</a>";
			} else {
				echo "O registro não foi atualizado!";
				echo "<br><br><a href=\"../\">Voltar</a>";
			}
		}
	}
} else {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Atualização - Erro!</title>
</head>
<body>
<h1>Atenção!</h1>
<h4>Você deve selecionar um registro válido para ser editado!</h4>
<a href="../">Voltar</a>
</body>
</html>
<?php
	}

?>