<!DOCTYPE html>
<html ng-app="campanhasAtivas">
<head>
	<title>Campanhas</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="../geral/js/angular-1.6.9.min.js"></script>
</head>
<body ng-controller="campanhasAtivasCtrl">
	<?php  include("menu.html") ?>
	<div class="container">	
		<table class="table table-hover table-dark table-responsive-xm">
		  <thead>
		    <tr>
		      <th scope="col">CAMPANHAS ATIVAS</th>
		      <th scope="col">Início</th>
		      <th scope="col">Término</th>
		      <th scope="col">Editar</th>
		      <th scope="col">Excluir</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr ng-repeat="campanha in campanhas">
		      <td>{{campanha.nomeCampanha}}</td>
		      <th scope="row">{{campanha.dataInicial | date:'dd/MM/yyyy'}}</th>
		      	<th scope="row">{{campanha.dataFinal | date:'dd/MM/yyyy'}}</th>
		      	<th scope="row"><a href="editarCampanha.php?id={{campanha.id_campanha}}"><i class="material-icons">edit</i></a></th>
		   		<th scope="row" ng-click="excluir(campanha.id_campanha, campanha.nomeCampanha)" class="icon-excluir" title="Deletar campanha - {{campanha.nomeCampanha}}">
		   			<i class="material-icons">delete</i>
		   		</th>
		    </tr>
		  </tbody>
		</table>
	</div>
<?php 
	include("rodape.php");
?>
<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="../geral/js/chart.js"></script> -->
<script type="text/javascript" src="../geral/js/script.js"></script>
<script type="text/javascript" src="js/scriptIndex.js"></script>
</body>
</html>