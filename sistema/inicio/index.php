<?php
session_start();
	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}
	
	require_once("conexao.php");
	$con = conexaoMysql();
	

	date_default_timezone_set("America/Sao_Paulo");
	$diaAtual = date("d");

	$diaAtual = (int)$diaAtual;

	$sql = "SELECT COUNT(id_doador) FROM doador WHERE doaDia = :dia";

	$busca = $con->prepare($sql);
	$busca->bindValue(':dia', $diaAtual);
	$busca->execute();
	
	if($busca->rowCount() > 0){
		$qntd = $busca->fetch(PDO::FETCH_ASSOC);
		$quantidade = $qntd["COUNT(id_doador)"];
	}
?>
<html ng-app="despesas">
<head>
	<title>Inicio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css2/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
	<link rel="stylesheet" type="text/css" href="css2/myEstilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body ng-controller="despesasCtrl">


	<nav class="navbar navbar-expand-lg navbar-dark">
	  <a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

	  <span id="nome">Amparo Maternal Euripedes Novelino</span>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	        <a class="nav-link ativo" href="#">Início<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="../doador/">Doador</a>
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

	<div class="content container">
		<div class="row"
		style="font-size: 14pt;
				font-weight: bold;
				color: #018636;">
			
			<div class="col-md-6">
				<a href="../doador/">
					<img src="../inicio/img/icon_donation.png" style="width: 100px;">
					<span>Nova doação</span>
				</a>
			</div>
			<div class="col-md-6">
				<a href="../reciboGeral/">
					<img src="../inicio/img/icon_recibo.png" style="width: 100px;">
					<span>Gerar recibos <span class="badge badge-info"><?php echo $quantidade; ?></span></span>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<canvas class="grafico" id="myChart"></canvas>
			</div>
			<div class="col-md-6">
				<ul class="legenda">
					<li class="text-red">Despesas do Mês</li>
					<li class="text-orange">Doacões Recebidas no Mês</li>
					<li class="text-aqua">Doações à receber</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<table class="table table-hover table-dark table-responsive-xm">
		  <thead>
		    <tr>
		      <th scope="col">DESPESAS</th>
		      <th scope="col">Valor</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr ng-repeat="despesa in despesas track by $index">
		      <td>{{despesa.infoDespesa}}</td>
		      <th>R$ {{despesa.reais + "," + despesa.centavos}}</th>
		    </tr>
		  </tbody>
		</table>
	</div>

	<footer class="container-fluid">
		<p>AMPARO MATERNAL - EURÍPEDES NOVELINO &copy; - <?php echo date('Y');?></p>
	</footer>
<script type="text/javascript" src="js2/despesas.js"></script>
<script type="text/javascript" src="js2/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js2/popper.min.js"></script>
<script type="text/javascript" src="js2/bootstrap.min.js"></script>
<script type="text/javascript" src="js2/chart.js"></script>
<script type="text/javascript" src="js2/script.js"></script>
</body>
</html>
