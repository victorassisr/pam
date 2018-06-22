<!DOCTYPE html>
	<html ng-app="despesas">
	<head>
		<title>Despesas Lista</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
	</head>
	<body ng-controller="despesasCtrl">

		<?php include ("menu.html"); ?>
		
		<div class="container">	
			<table class="table table-hover table-dark table-responsive-xm">
			  <thead>
			    <tr>
		    	 	<th scope="col">DESPESAS</th>
		    	 	<th scope="col">Descrição</th>
		    	 	<th scope="col">Vencimento</th>
		    	 	<th scope="col">Valor</th>
		    	</tr>
		 	  </thead>
		  	  <tbody>
		    	<tr ng-repeat="despesa in despesas track by $index">
		      		<td>{{despesa.infoDespesa}}</td>
		      		<th>{{despesa.infoDespesa}}</th>
		      		<th scope="row">{{despesa.data | date: 'dd/MM/yyyy'}}</th>
		      		<th scope="row">{{ despesa.reais + "," + despesa.centavos}}</th>
		      		<th scope="row"><a href="editarDespesa.php?id={{despesa.idDespesa}}"><i class="material-icons">edit</i></a></th>
		      		<th scope="row" ng-click="excluir(despesa.idDespesa)" class="icon-excluir" title="Deletar">
		   				<i class="material-icons">delete</i>
		   			</th>
		    	</tr>
		  	  </tbody>
			</table>
		</div>
		<?php 	include("rodape.php"); ?>

		<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../geral/js/popper.min.js"></script>
		<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../geral/js/script.js"></script>
		<script type="text/javascript" src="js/despesas.js"></script>
	</body>
</html>