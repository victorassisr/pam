<html>
<head>
	<title>Inicio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css2/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css2/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/estilo.css">-->
	<link rel="stylesheet" type="text/css" href="css2/myEstilo.css">
</head>
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
	        <a class="nav-link ativo" href="#">Início<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Doadores</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Campanhas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Despesas</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Relatórios</a>
	      </li>
	      <!--
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Dropdown
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="#">Action</a>
	          <a class="dropdown-item" href="#">Another action</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item" href="#">Something else here</a>
	        </div>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link disabled" href="#">Disabled</a>
	      </li>
	  		-->
	    </ul>
	  </div>
	</nav>

	<div class="content container">
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
		      <th scope="col">#</th>
		      <th scope="col">À PAGAR</th>
		      <th scope="col">À RECEBER</th>
		      <th scope="col">VENCIDAS</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <th scope="row">1</th>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		    </tr>
		    <tr>
		      <th scope="row">2</th>
		      <td>Jacob</td>
		      <td>Thornton</td>
		      <td>@fat</td>
		    </tr>
		    <tr>
		      <th scope="row">3</th>
		      <td colspan="2">Larry the Bird</td>
		      <td>@twitter</td>
		    </tr>
		  </tbody>
		</table>
	</div>

	<footer class="container-fluid">
		<p>AMPARO MATERNAL - EURÍPEDES NOVELINO &copy; - <?php echo date('Y');?></p>
	</footer>

<script type="text/javascript" src="js2/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js2/popper.min.js"></script>
<script type="text/javascript" src="js2/bootstrap.min.js"></script>
<script type="text/javascript" src="js2/chart.js"></script>
<script type="text/javascript" src="js2/script.js"></script>
</body>
</html>
