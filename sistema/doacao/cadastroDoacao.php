<?php
	require_once('conexao.php');

	$con = conexaoMysql();

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

	$sql = "INSERT INTO doacao(id_tipoDoacao, item_doacao, id_campanha, id_doador, dataDoacao, quantidade, valorDinheiro, valorCentavos, tipoDinheiro) VALUES (:id, :item, :campanha, :doador, :data, :quant, :valorDinheiro, :valorCentavos, :tipoDin)";

	$cadastrar = $con->prepare($sql);
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
		echo "<h1>Cadastrado com sucesso!</h1>";
	} else {
		echo "<h1>Erro, não foi possível cadastrar.</h1>";
	}
?>