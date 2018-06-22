<?php
session_start();
	if(!isset($_SESSION["logado"])){
		header("location:http://localhost/projetoAmparoMaternal/site/admin/");
		exit;
	}
date_default_timezone_set('America/Sao_Paulo');
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Relatório - Amparo </title>
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
			<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet"> 
			<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
			<link rel="stylesheet" type="text/css" href="css/estilo.css">
			<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
		</head>
		<body>
			<?php include ("menu.php");

if(isset($_POST["dataInicial"]) && isset($_POST["dataFinal"]) && isset($_POST["opcao"]) && $_POST["dataInicial"] != "" && $_POST["dataFinal"] != "" 
	&& $_POST["opcao"] != ""){
	require_once("conexao.php");

	$con = conexaoMysql();

	$di = $_POST["dataInicial"];

	$df = $_POST["dataFinal"];

	$op = $_POST["opcao"];

	$total = 0;

	//DESPESAS
	if($op == "DESPESAS")
	{
		$sql = "SELECT * FROM despesas WHERE data >= '$di' AND data <= '$df' ";

		$busca = $con->prepare($sql);

		$busca->execute();

		if($busca->rowCount() > 0){
			$despesas = $busca->fetchAll(PDO::FETCH_OBJ);

			foreach($despesas as $despesa){
				(double)$valor = $despesa->reais . "." . $despesa->centavos;
				$total += $valor;
			} //Soma dos valores das despesas.
		} else {
			$erro =  "Nada encontrado com os parâmetros inseridos";
		}
	}

	//DOACOES
	if($op == "DOACAO"){
		//Busca pela doacao
		$sql = "SELECT * FROM doacao WHERE dataDoacao >= '$di' AND dataDoacao <= '$df' ";

		$busca = $con->prepare($sql);

		$busca->execute();

		if($busca->rowCount() > 0){
			$doacoes = $busca->fetchAll(PDO::FETCH_OBJ);
			//Busca campanhas
			$sqlCampanhas = "SELECT id_campanha, nomeCampanha FROM campanhas";
			$buscaCampanhas = $con->prepare($sqlCampanhas);
			$buscaCampanhas->execute();
			$campanhas = $buscaCampanhas->fetchAll(PDO::FETCH_OBJ);

			//Busca nome do doador
			$sqlDoadores = "SELECT id_doador, nome FROM doador";
			$buscaDoadores = $con->prepare($sqlDoadores);
			$buscaDoadores->execute();
			$doadores = $buscaDoadores->fetchAll(PDO::FETCH_OBJ);
			foreach($doacoes as $doacao){
				(double)$valor = $doacao->valorDinheiro . "." . $doacao->valorCentavos;
				$total += $valor;
			}
		} else {
			$erro =  "Nada encontrado com os parâmetros inseridos";
		}

		$sqlPagSeguro = "SELECT * FROM doacoesPag WHERE data >= '$di' AND data <= '$df'";
		$buscaPag = $con->prepare($sqlPagSeguro);
		$buscaPag->execute();

		if($buscaPag->rowCount() > 0){
			$doacoesPag = $buscaPag->fetchAll(PDO::FETCH_OBJ);
		}
	}

	if(isset($erro)){
		echo $erro;
	}

	if(isset($despesas)){
		//Começa a mostrar os resultados de despesas.
		?>
		<h2>Relatório de despesas</h2>	
		<div class="container">	
			<table class="table table-hover table-white table-responsive-xm">
			<caption>Relatório de despesas de <?php echo date("d-m-Y", strtotime($di)); ?> à <?php echo date("d-m-Y", strtotime($df)); ?> </caption>
			  <thead>
			    <tr class="table-success">
		    	 	<th scope="col">DESPESA</th>
		    	 	<th scope="col">DATA</th>
		    	 	<th scope="col">VALOR</th>
		    	</tr>
		 	  </thead>
		  	  <tbody>
		  	  	<?php foreach($despesas as $despesa){ ?>
		    	<tr>
		      		<td><?php echo $despesa->infoDespesa; ?></td>
		      		<th scope="row"><?php echo date("d/m/Y", strtotime($despesa->data)); ?></th>
		      		<th scope="row">R$ <?php echo $despesa->reais; ?>,<?php echo $despesa->centavos; ?></th>
 		    	</tr>
 		    	<?php } ?>	
 		    	<tr>
 		    		<th scope="row"colspan="2" class="bg-dark">TOTAL</th>
 		    		<th scope="row" class="bg-dark">R$ <?php echo $total; ?></th>
 		    	</tr>
		  	  </tbody>
			</table>
		</div>
		<?php
	} //Fim do if despesas

	if(isset($doacoes)){
		//Começa a mostrar os resultados de doações
		?>
		<h2>Relatório de Doações</h2>	
		<div class="container">	
			<table class="table table-hover table-white table-responsive-xm">
			<caption>Relatório de doações de <?php echo date("d/m/Y", strtotime($di)); ?> à <?php echo date("d/m/Y", strtotime($df)); ?> </caption>
			  <thead>
			    <tr class="table-success">
		    	 	<th scope="col">Doador</th>
		    	 	<th scope="col">Data</th>
		    	 	<th scope="col">Campanha</th>
		    	 	<th scope="col">Item</th>
		    	 	<th scope="col">Quantidade</th>
		    	 	<th scope="col">Valor</th>
		    	</tr>
		 	  </thead>
		  	  <tbody>
		  	  	<?php foreach($doacoes as $doacao){ ?>
		    	<tr>
		    		<?php foreach($doadores as $doador){
							 if($doacao->id_doador == $doador->id_doador){
								$doadorAtual = $doador->nome; 
							}
						} ?>
		      		<th><?php  echo $doadorAtual; ?></th>
		      		<th scope="row"><?php echo date("d/m/Y", strtotime($doacao->dataDoacao)); ?></th>
		      			<?php  foreach($campanhas as $campanha){
							if($doacao->id_campanha == $campanha->id_campanha){
								$campanhaAtual = $campanha->nomeCampanha; 
							}
						} ?>
		      		<th scope="row"><?php echo $campanhaAtual; ?></th>
						

					<th><?php  echo $doacao->item_doacao; ?></th>
					<th><?php echo $doacao->quantidade; ?></th>
		      		<th scope="row">R$ <?php  echo $doacao->valorDinheiro; ?>,<?php echo $doacao->valorCentavos; ?></th>
 		    	</tr>
 		    	<?php } ?>	
 		    	<tr>
 		    		<th scope="row"colspan="5" class="bg-dark">TOTAL</th>
 		    		<th scope="row" class="bg-dark">R$ <?php echo $total; ?></th>
 		    	</tr>
		  	  </tbody>
			</table>
		</div>

		<!--Mostrar Doacoes PagSeguro-->
	<?php if(isset($doacoesPag)){ 
		$totalPag = 0; ?>
		<div class="container">	
			<table class="table table-hover table-white table-responsive-xm">
			<caption>Relatório de doações realizadas pelo PagSeguro <?php echo date("d/m/Y", strtotime($di)); ?> à <?php echo date("d/m/Y", strtotime($df)); ?> </caption>
			  <thead>
			    <tr class="table-success">
		    	 	<th scope="col">Status</th>
		    	 	<th scope="col">Data</th>
		    	 	<th scope="col">CPF</th>
		    	 	<th scope="col">Valor</th>
		    	</tr>
		 	  </thead>
		  	  <tbody>
				<?php foreach($doacoesPag as $doacaoPag){ ?>
					<?php $totalPag += (double)$doacaoPag->valor; ?>
		    	<tr>
		      		<th>Disponível</th>
		      		<th scope="row"><?php echo date("d/m/Y", strtotime($doacaoPag->data)); ?></th>
		      		<th scope="row"><?php echo $doacaoPag->cpf; ?></th>
						
					<th><?php  echo $doacaoPag->valor; ?></th>
 		    	</tr>
 		    	<?php } ?>	
 		    	<tr>
 		    		<th scope="row"colspan="3" class="bg-dark">TOTAL</th>
 		    		<th scope="row" class="bg-dark">R$ <?php echo $totalPag; ?></th>
 		    	</tr>
		  	  </tbody>
			</table>
		</div>
	<?php
	} }
	

	} else {
		echo "<script>
			alert(\"Parâmetros obrigatórios não informados.\");
			</script>";
	}

	include("rodape.php");
?>
	</body>
</html>

