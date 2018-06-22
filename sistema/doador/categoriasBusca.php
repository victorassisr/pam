<?php

	require_once('conexao.php'); //Inclui o arquivo de conexão aqui nessa página. Se não existir da erro e para a execução do restante do script.

	$con = conexaoMysql(); //Do arquivo de conexão tem uma funcção q retorna a conexão com o banco de dados.
	//Nesse caso estamos atribuindo a conexão a variável $con.

	$sql = "SELECT * FROM tiposBusca"; //Consulta SQL Selecionar tudo da tabela tiposBusca.

	$busca = $con->prepare($sql); //Prepara a query.. PDO, pra evitar injeções SQL.

	$busca->execute(); //Executa a consulta.
	if($busca->rowCount() > 0){
		$tiposBusca = $busca->fetchAll(PDO::FETCH_OBJ); //Retorna todos os tipos de busca em um OBJETO.
		echo json_encode($tiposBusca);
	}

?>