<?php
session_start();

	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Gerência de Doadores</title>
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/recibo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-dark">
		<a class="navbar-brand" href="#" title="Amparo Maternal Euripedes Novelino"><div id="logo"></div></a>

		<span id="nome">Amparo Maternal Euripedes Novelino</span>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="../inicio/index2.php">Início</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle ativo" href="#" id="dropdownDoador" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Doador<span class="sr-only">(current)</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="cadastrar.php">Cadastrar</a>
					<a class="dropdown-item dropdown-ativo-bt-bb" href="listar.php">Listar</a>
					<a class="dropdown-item" href="buscar.php">Buscar</a>
				</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../campanha/">Campanhas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Despesas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Relatórios</a>
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
	<section ng-app="reciboDoador" ng-controller="reciboController" ng-submit="cadastrarRecibo()">
		<div class="text-center"><span class="erro">{{erro}}</span></div>

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
				<input type="hidden" name="idDoador" ng-model="doador.id">
				<div class="valor">
					<p class="serie">RECIBO DE DOAÇÃO - SÉRIE "A" - VALOR <span class="campoValor">{{doador.reaisADoar}},{{doador.centavosADoar}}</span> <span class="numeroRecibo"> Nº: {{numero}}</span></p>
				</div>
				<div class="informacoes">
					<p>Recebemos de <b class="txt">{{doador.nome}}</b>, a quantia de <b class="txt">R$ {{doador.reaisADoar}},{{doador.centavosADoar}}</b></p>
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
			<form action="reciboDoador.php" method="POST" target="_blank">
				<input type="hidden" name="id_doador" value="{{doador.id_doador}}">
				<input type="hidden" name="nome" value="{{doador.nome}}">
				<input type="hidden" name="numeroRecibo" value="{{numero}}">
				<input type="hidden" name="reais" value="{{doador.reaisADoar}}">
				<input type="hidden" name="centavos" value="{{doador.centavosADoar}}">
				<button type="submit" class="btn btn-warning m-auto blk">GERAR RECIBO</button>
			</form>
		</div>
		<div class="divAltera">
			<form action="reciboDoador.php" method="POST">
				<div class="container">
					<input type="hidden" name="id_doador" value="{{doador.id_doador}}">
					<div class="form-group">
						<label>Nome:</label>
						<input type="text" class="form-control" name="nome" value="{{doador.nome}}">
					</div>
					<input type="hidden" name="numeroRecibo" value="{{numero}}">
					<div class="form-group">
						<label>Reais:</label>
						<input type="text" class="form-control" name="reais" value="{{doador.reaisADoar}}">
					</div>
					<div class="form-group">
						<label>Centavos: </label>
						<input type="text" class="form-control" name="centavos" value="{{doador.centavosADoar}}">
					</div>
				</div>
				<button type="submit" class="btn btn-warning m-auto blk">Alterar Valores</button>
			</form>
		</div>
	</section>


	<?php
		include("rodape_doador.php");
	?>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/recibo.js"></script>
</body>
</html>