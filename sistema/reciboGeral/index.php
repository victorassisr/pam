<?php
	session_start();

	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}
	
	require_once("conexao.php");
	$con = conexaoMysql();

	$controle = false;

	date_default_timezone_set("America/Sao_Paulo");
	$diaAtual = date("d");

	$diaAtual = (int)$diaAtual;

	$sql = "SELECT * FROM doador WHERE doaDia = :dia";

	$busca = $con->prepare($sql);
	$busca->bindValue(':dia', $diaAtual);
	$busca->execute();

	if($busca->rowCount() > 0){
		$doadores = $busca->fetchAll(PDO::FETCH_OBJ);
		$controle = true;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Recibos de Doadores</title>
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/recibo.css">
</head>
<body>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark no-print">
		<a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

		<span id="nome">Amparo Maternal Euripedes Novelino</span>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../inicio/index.php">Início</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle ativo" href="#" id="dropdownDoador" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Doador<span class="sr-only">(current)</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="cadastrar.php">Cadastrar</a>
					<a class="dropdown-item" href="listar.php">Listar</a>
					<a class="dropdown-item" href="buscar.php">Buscar</a>
				</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../campanha/">Campanhas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../cadastroDespesas/">Despesas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../relatorio/">Relatórios</a>
				</li>
				<?php if(isset($_SESSION["logado"])){ ?>
				<li class="nav-item">
					<a class="nav-link" href="../logout.php">Sair</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</nav>

	<!-- Conteudo -->
	<section>
<?php

	if(isset($doadores)){

forEach($doadores as $doador){ 


	$sql = "SELECT id, numero FROM numeroRecibo";

	$busca = $con->prepare($sql);

	$busca->execute();

	if($busca->rowCount() > 0){
		
		$num = $busca->fetch(PDO::FETCH_OBJ);
		$numero = (int)$num->numero;
		$numero = $numero+1;

		$sqlIncrement = "UPDATE numeroRecibo SET numero = :numero WHERE id = :id";
		$inserir = $con->prepare($sqlIncrement);
		$inserir->bindValue(":id", $num->id);
		$inserir->bindValue(":numero", $numero);
		$inserir->execute();

		if($inserir->rowCount() > 0){
			$numSalvo = $numero;
		} else {
			echo "Houve um erro ao gerar o numero do recibo";
			exit();
		}

	}

	if($busca->rowCount() == 0){
		$sqlInicial = "INSERT INTO numeroRecibo(numero) VALUES (:numero)";
		$inserir = $con->prepare($sqlInicial);
		$inserir->bindValue(":numero", 1);
		$inserir->execute();

		if($inserir->rowCount() > 0){
			$numSalvo = 1;
		} else {
			echo "Houve um erro ao gerar o numero do recibo";
			exit();
		}

	}

?>
		<!-- Conteudo -->
		<div class="recibo">
			<div class="topo clearfix">
				<div class="logo">
					<img src="amparo.png" width="150" height="137">
				</div>
				<div class="cabecalho">
					<div class="text-center leis">
						<h3>AMPARO MATERNAL</h3>
						<p class="lei">Lei de Utilidade Pública Municipal nº 3.146/93</p>
						<p class="lei">Lei de Utilidade Pública Estadual nº 13.731/00</p>
						<p class="lei">Lei de Utilidade Pública Federal / processo nº 21.510/97-65</p>
					</div>
					<div class="endereco">
						Rua Vereador João Pacheco, 944 - CEP 38700-248 - Patos de Minas - Minas Gerais
					</div>
					<div class="contato">
						<b>Telefone (34) 3825-5010</b> - CNPJ 23.097.645/0001-90 - Ins. Estadual: Isenta
					</div>
				</div>
			</div>
			<div class="corpoRecibo clearfix">
				<div class="valor">
					<p class="serie">RECIBO DE DOAÇÃO - SÉRIE "A" - VALOR <span class="campoValor"><?php echo $doador->reaisADoar; ?>,<?php echo $doador->centavosADoar; ?></span> <span class="numeroRecibo"> Nº: <?php echo $numSalvo; ?></span></p>
				</div>
				<div class="informacoes">
					<p>Recebemos de <b class="txt"><?php echo $doador->nome; ?></b>, a quantia de <b class="txt">R$ <?php echo $doador->reaisADoar; ?>,<?php echo $doador->centavosADoar; ?></b></p>
				</div>
				<div class="mensagem clearfix">
					<p>Você está contribuindo com o programa</p>
					<p>"Cidadania em Rede", fazendo acontecer projetos</p>
					<p>de desenvolvimento Sócio - Educativo - Cultural</p>
					<p>em Patos de Minas - MG.</p>
				</div>
				<div class="assinatura clearfix text-center">
					<p class="ass"><img src="aa.jpg" width="200" height="40"></p>
					<p class="assNome">Mirian Gontijo Moreira da Costa</p>
					<p>Presidente</p>
				</div>
			</div>
		</div>
		<div>
<?php
$data = date("Y-m-d");
$con = conexaoMysql();
$validaNumData = "SELECT * FROM recibos WHERE data = :data";
$valida = $con->prepare($validaNumData);
$valida->bindValue(':data',$data);
$valida->execute();

if($valida->rowCount() == 0){
	$sql = "INSERT INTO recibos(idDoador, nome, numero, data, reais, centavos) VALUES (:idDoador, :nome, :numero, :data, :reais, :centavos)";

	$insere = $con->prepare($sql);
	$insere->bindValue(':idDoador', $doador->id_doador);
	$insere->bindValue(':nome', $doador->nome);
	$insere->bindValue(':numero',$numSalvo);
	$insere->bindValue(':data','$data');
	$insere->bindValue(':reais', $doador->reaisADoar);
	$insere->bindValue(':centavos', $doador->centavosADoar);

	$insere->execute();
}
?>
		</div>
<?php 
	} //FIM do FOREACH
	} else {
	echo '<h3 class="text-center">Nenhum doador doando HJ.</h3>';
} 
?>

<?php if($controle){ ?>
	<div class="no-print">
		<button type="button" id="btn-print">Imprimir</button>
	</div>
<?php } ?>
	</section>

	<?php
		include("rodape.php");
	?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>