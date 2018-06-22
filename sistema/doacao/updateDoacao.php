<?php
	require_once('conexao.php');

	$con = conexaoMysql();

	$id_doacao = $_POST['id_doacao'];
	$itensDoados = $_POST['itemDoacao'];
	$campanha = $_POST['campanha'];
	$idDoador = $_POST['id_doador'];
	$dataDoacao = $_POST['dataDoacao'];
	$quantidade = $_POST['quantidade'];
	$valorInteiro = $_POST['valorDinheiro'];
	$valorCentavos = $_POST['valorCentavos'];
	$tipoDoacaoDinheiro = $_POST['tipoDinheiro'];
	$categoriaDoacao = $_POST['tipoDoacao'];

	if($itensDoados == "default"){
		$itensDoados = "Dinheiro";
	}

	if($campanha == "default"){
		$sqlCampanha = "SELECT * FROM campanhas WHERE nomeCampanha = :nome";
		$buscaCampanha = $con->prepare($sqlCampanha);
		$buscaCampanha->bindValue(':nome','Nenhuma');
		$buscaCampanha->execute();
		$dados = $buscaCampanha->fetch(PDO::FETCH_OBJ);
		$campanha = $dados->id_campanha;
	}

	if($quantidade == ""){
		$quantidade = 0;
	}

	if($valorInteiro == "default" && $valorCentavos == "default"){
		$valorInteiro = 0;
		$valorCentavos = 0;
	}

	if($tipoDoacaoDinheiro == "default"){
		$tipoDoacaoDinheiro = 5;
	}

	$sql = "UPDATE doacao SET id_tipoDoacao = :id, item_doacao = :item, id_campanha = :campanha, id_doador = :doador, dataDoacao = :data, quantidade = :quant, valorDinheiro = :valorDinheiro, valorCentavos = :valorCentavos, tipoDinheiro = :tipoDin WHERE id_doacao = :id_doacao";

	$cadastrar = $con->prepare($sql);
	$cadastrar->bindValue(':id_doacao',$id_doacao);
	$cadastrar->bindValue(':id',$categoriaDoacao);
	$cadastrar->bindValue(':item',$itensDoados);
	$cadastrar->bindValue(':campanha',$campanha);
	$cadastrar->bindValue(':doador',$idDoador);
	$cadastrar->bindValue(':data',$dataDoacao);
	$cadastrar->bindValue(':quant',$quantidade);
	$cadastrar->bindValue(':valorDinheiro',$valorInteiro);
	$cadastrar->bindValue(':valorCentavos',$valorCentavos);
	$cadastrar->bindValue(':tipoDin',$tipoDoacaoDinheiro);

	$cadastrar->execute();

	if($cadastrar->rowCount() > 0){
		echo "<h1>Atualizado com sucesso!</h1>";
		echo "<a href=\"../\">Voltar</a>";
	} else {
		echo "<h1>Erro, não foi possível atualizar.</h1>";
	}
?>