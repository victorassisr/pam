<?php
session_start();
if(isset($_SESSION['logado'])){
	echo "Logado!";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form action="logar.php" method="POST">
		<input type="text" name="usuario" placeholder="Usuario">
		<br><br>
		<input type="password" name="senha" placeholder="Senha">
		<br><br>
		<input type="submit" value="Login">
	</form>

	<form action="logout.php" method="GET">
		<input type="submit" value="logout" name="deslogar">
	</form>
</body>
</html>