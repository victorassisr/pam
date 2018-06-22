<?php

require("conexao.php");
$con = conexaoMysql();

$sqlTotal = "SELECT COUNT(id_doador) FROM doador";
$busca = $con->prepare($sqlTotal);
$busca->execute();

$a = $busca->fetch(PDO::FETCH_ASSOC);
$total = $a["COUNT(id_doador)"];


?>