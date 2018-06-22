<?php
	session_start();
	if(isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/sistema/inicio/");
		exit;
	} else {
		if(isset($_POST["usuario"]) && $_POST["usuario"] != "" && isset($_POST["senha"]) && $_POST["senha"] != ""){
			require_once("conexao.php");
			$con = conexaoMysql();
			$sql = "SELECT nome_usuario, senha FROM usuarios WHERE nome_usuario = :usuario AND senha = :senha";
			$busca = $con->prepare($sql);
			$busca->bindvalue(':usuario',$_POST["usuario"]);
			$busca->bindvalue(':senha',$_POST["senha"]);
			$busca->execute();

			if($busca->rowCount() > 0){
				$_SESSION["logado"] = true;
				header("location:http://localhost/projetoAmparoMaternal/sistema/inicio/");
				exit;
			} else {
				header("location:http://localhost/projetoAmparoMaternal/site/admin/index.php?erro=1");
				exit;
			}
		}

		if(isset($_POST["usuario"]) && $_POST["usuario"] == ""){
			header("location:http://localhost/projetoAmparoMaternal/site/admin/index.php?erro=2");
			exit;
		}

		if(isset($_POST["senha"]) && $_POST["senha"] == ""){
			header("location:http://localhost/projetoAmparoMaternal/site/admin/index.php?erro=3");
			exit;
		}

	}
?>