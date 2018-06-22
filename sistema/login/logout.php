<?php

session_start();
	
	if(isset($_GET["deslogar"]) == true){
		if($_GET["deslogar"] == "logout"){
			unset($_SESSION["logado"]);
			unset($_SESSION["nivel"]);
			session_destroy();
		}
		echo "Erro.";
	} else{
		echo "Erro.";
	}
?>