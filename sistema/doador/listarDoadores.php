<?php
	require_once('conexao.php');

	$con = conexaoMySql();

	$sql = "SELECT id_doador, nome, email, tipoDoador FROM doador";

	$listar = $con->prepare($sql);
	$listar->execute();

	if($listar->rowCount() > 0){

		$doadores = $listar->fetchAll(PDO::FETCH_OBJ);

		foreach($doadores as $doador){

			echo $doador->nome ." | " .$doador->email . " | " .$doador->tipoDoador . "<br><br>";
			?><a href="<?php echo "editarDoador.php?id=".$doador->id_doador; ?>">Editar</a>
			<a href="<?php echo "excluirDoador.php?id=".$doador->id_doador; ?>">Excluir</a>
			<a href="<?php echo "infoDoador.php?id=".$doador->id_doador; ?>">Info</a>
			<a href="<?php echo "../doacao/cadastrarDoacao.php?id=".$doador->id_doador."&pag=doador"; ?>">Cadastrar Doacao</a>
			<a href="<?php echo "../doacao/listarDoacao.php?id=".$doador->id_doador."&pag=doador";?>">Listar Doacoes</a>
			<?php
			echo "<br><br>==============================<br><br>";
		}

	} else {
		echo "Nenhum usuario cadastrado.";
		echo "<br><a href=\"cadastro.php\">Cadastrar</a>";
	}

	$con = null;
?>