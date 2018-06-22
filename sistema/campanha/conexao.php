<?php

function conexaoMysql(){
	$conexao;

		$usuario = 'root';
		$pass = 'victoradmin';


	try{
		$conexao = new PDO('mysql:host=localhost;dbname=amparoMaternal;', $usuario, $pass);
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexao;
    }
	catch(PDOException $e)
   	{
    	echo "Connection failed: " . $e->getMessage();
    }
}
?>