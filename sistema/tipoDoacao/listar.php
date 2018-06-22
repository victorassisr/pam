<?php
	require_once('conexao.php');
	$con = conexaoMysql();

	$query = $con->prepare("SELECT * FROM tipoDoacao");
	$query->execute();

	$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

$con = null;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listar Categorias</title>
</head>
<body>

	<ul>
		<?php
		if($query->rowCount() == 0){
			echo "<h1>Nada cadastrado ainda!</h1>";
		} else{
		forEach($resultado as $i){
			if($i['nome'] == "Nenhuma"){
?>
<li><?php echo $i["nome"]; ?></li>
<?php
			} else {
		?>
		<li><?php echo $i["nome"]; ?>--<a href="excluir.php?id=<?php echo $i['id_tipoDoacao']?>">Excluir</a>--<a href="alterar.php?id=<?php echo $i['id_tipoDoacao']?>">Alterar</a></li>
		<?php
				}
			}
		}
		?>
	</ul>

	<a href="../" title="Voltar">Voltar</a>

</body>
</html>