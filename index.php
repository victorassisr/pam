<?php
	if(isset($_GET['erro']) && $_GET['erro'] == "nojs"){
		$erro = "<h1>O seu browser não tem suporte a JavaScript ou ele está desabilitado!</h1><p>Para segurança e integridade dos dados, o sistema será desabilitado. Após reativar o JavaScript ou trocar de navegador que tenha o JavaScript habilitado, o sistema voltará ao seu funcionamento normal. Obrigado, Admins do sistema.</p><p>Se você reativar o JavaScript o sistema voltará ao normal.. Reativou o JavaScript?</p><p>Já reativei o JavaScript <a href=\"index.php\" title=\"Tentar Novamente\">vamos tentar novamente</a>..</p>";
	}

	if(isset($erro) == false){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema AM</title>
</head>
<body>
	<noscript>
		<p>Não obtivemos exito ao reativar o JavaScript. =(</p>
		<p>Você pode tentar reinicar seu navegador.</p>
	</noscript>
	<ul>
		<li><a href="doador/cadastro.php">Cadastro de doadores</a></li>
		<li><a href="doador/listarDoadores.php">Listar Doadores</a></li>
		
		<li><br></li>
		
		<li><a href="tipoDoacao/cadastrar.php">Cadastrar tipo de Doacoes</a></li>
		<li><a href="tipoDoacao/listar.php">listar tipo de Doacoes</a></li>

		<li><br></li>

		<li><a href="campanha/">Cadastrar Campanhas</a></li>
		<li><a href="campanha/listarCampanhas.php">Listar Campanhas</a></li>

		<li><br></li>
		
		<li><a href="login/">Login</a></li>
	</ul>
</body>
</html>
<?php } else { ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Erro - Sem JavaScript</title>
	</head>
	<body>
<?php echo $erro; ?>
	</body>
	</html>
<?php
}
?>