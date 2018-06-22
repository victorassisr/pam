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
	<title>Recibo Doador nº <?php echo $_POST["numeroRecibo"]; ?></title>
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/recibo.css">
</head>
<body>
<body>
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
					<p class="serie">RECIBO DE DOAÇÃO - SÉRIE "A" - VALOR <span class="campoValor"><?php echo $_POST['reais']; ?>,<?php echo $_POST['centavos']; ?></span> <span class="numeroRecibo"> Nº: <?php echo $_POST['numeroRecibo']; ?></span></p>
				</div>
				<div class="informacoes">
					<p>Recebemos de <b class="txt"><?php echo $_POST['nome']; ?></b>, a quantia de <b class="txt">R$ <?php echo $_POST['reais']; ?>,<?php echo $_POST['centavos']; ?></b></p>
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
			<script type="text/javascript">
				window.onload = function(){
					window.print();
				}
			</script>
</body>
</html>