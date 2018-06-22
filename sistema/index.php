<?php
session_start();

	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	} else {
		header("location:http://localhost/projetoAmparoMaternal/sistema/inicio/");
		exit;
	}

?>