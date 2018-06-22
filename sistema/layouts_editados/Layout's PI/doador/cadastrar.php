<!DOCTYPE html>
<html>
<head>
	<title>Gerência de Doadores</title>
	<link rel="stylesheet" type="text/css" href="../geral/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../geral/css/myStyle.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
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
					<a class="dropdown-item dropdown-ativo-bb" href="cadastrar.php">Cadastrar</a>
					<a class="dropdown-item" href="listar.php">Listar</a>
					<a class="dropdown-item" href="buscar.php">Buscar</a>
				</div>
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
			</ul>
		</div>
	</nav>

	<!-- Conteudo -->
	<h3 class="text-center mt-40">Cadastrar doador</h3>
	<hr>
	<div class="container" ng-app="cadastroDoadorApp" ng-controller="cadastroDoadorController">
		<form name="cadastroDoador" ng-submit="submitForm()">
			<span ng-show="erroNome" class="msgErro text-center">{{erroGeral}}</span>
    		<div class="form-group">
		        <label>Nome*</label>
		        <input type="text" name="nome" class="form-control" ng-model="doador.nome" autocomplete='name' ng-required>
        		<span ng-show="erroNome" class="msgErro">{{erroNome}}</span>
    		</div>
    		<div class="form-group">
		        <label>Endereço</label>
		        <input type="text" name="endereco" class="form-control" ng-model="doador.endereco" autocomplete='address-line1'>
        		<span ng-show="erroEndereco" class="msgErro">{{erroEndereco}}</span>
    		</div>
    		<div class="form-group">
		        <label>E-Mail</label>
		        <input type="email" name="email" class="form-control" ng-model="doador.email" autocomplete='email'>
        		<span ng-show="erroEmail" class="msgErro">{{erroEmail}}</span>
    		</div>
    		<div class="form-group">
		        <label>Telefone Residencial ou Comercial</label>
		        <input type="text" name="telefoneFixo" class="form-control" ng-model="doador.telefoneFixo" autocomplete='tel'>
        		<span ng-show="erroTelefoneFixo" class="msgErro">{{erroTelefoneFixo}}</span>
    		</div>
    		<div class="form-group">
		        <label>Celular</label>
		        <input type="text" name="celular" class="form-control" ng-model="doador.celular">
        		<span ng-show="erroCelular" class="msgErro">{{erroCelular}}</span>
    		</div>
    		<div class="form-group">
		        <label>Celular (Opcional)</label>
		        <input type="text" name="celularOpcional" class="form-control" ng-model="doador.celularOpcional">
        		<span ng-show="erroCelularOpcional" class="msgErro">{{erroCelularOpcional}}</span>
    		</div>
    		<div class="form-group">
		        <label>Data de Nascimento</label>
		        <input type="date" name="dataDeNascimento" class="form-control" ng-model="dataNascimento.value">
        		<span ng-show="erroDataDeNascimento" class="msgErro">{{erroDataDeNascimento}}</span>
    		</div>
    		<div class="form-group">
		        <label>Data de Cadastro</label>
		        <input type="date" name="dataDeCadastro" class="form-control" ng-model="dataCadastro.value">
        		<span ng-show="erroDataDeCadastro" class="msgErro">{{erroDataDeCadastro}}</span>
    		</div>
    		<div class="form-group">
    			<label>Tipo de Doador</label>
		       	<select name="tipoDeDoador" class="sel w-100 form-control" ng-change="alteraTipoDoador()" ng-model="doador.tipoDeDoador">
		       		<option>Fidelizado</option>
		       		<option>Exporádico</option>
		       		<option>Anual</option>
		       	</select>
		       	<span ng-show="erroTipoDeDoador" class="msgErro">{{erroTipoDeDoador}}</span>
    		</div>
 			<div class="form-group" ng-show="diaShow">
 				<label>Doa todo dia</label>
    			<select class="sel w-100 form-control" name="dia" ng-model="doador.dia" ng-value="doador.dia">
					<?php
					for($index = 1; $index < 32; $index++){ ?>
					<option ng-model="doador.dia"><?php echo $index; ?></option>
					<?php } ?>
				</select>
    		</div>
    		<div class="form-group" ng-show="mesShow">
    			<label>Doa todo Mês:</label>
    			<select class="sel w-100 form-control" name="mes" ng-model="doador.mes" ng-value="doador.mes">
    				<option ng-model="doador.mes">Aleatório</option>
					<option ng-model="doador.mes">Janeiro</option>
					<option ng-model="doador.mes">Fevereiro</option>
					<option ng-model="doador.mes">Março</option>
					<option ng-model="doador.mes">Abril</option>
					<option ng-model="doador.mes">Maio</option>
					<option ng-model="doador.mes">Junho</option>
					<option ng-model="doador.mes">Julho</option>
					<option ng-model="doador.mes">Agosto</option>
					<option ng-model="doador.mes">Setembro</option>
					<option ng-model="doador.mes">Outubro</option>
					<option ng-model="doador.mes">Novembro</option>
					<option ng-model="doador.mes">Dezembro</option>
				</select>
    		</div>
    		<div class="form-group">
		        <label>Pessoa</label>
		        <select name="pessoa" class="form-control sel w-100" ng-model="doador.pessoa">
		        	<option>Física</option>
		        	<option>Jurídica</option>
		        </select>
        		<span ng-show="erroPessoa" class="msgErro">{{erroPessoa}}</span>
    		</div>
    		<div class="form-group">
		        <label>CPF ou CNPJ</label>
		        <input type="text" name="documento" class="form-control" ng-model="doador.documento">
        		<span ng-show="erroDocumento" class="msgErro">{{erroDocumento}}</span>
    		</div>
    		<div class="form-group">
		        <label>Operadora</label>
		        <input type="text" name="operadora" class="form-control" ng-model="doador.operadora">
        		<span ng-show="erroOperadora" class="msgErro">{{erroOperadora}}</span>
    		</div>
    		<div class="form-group">
		        <label>Turma</label>
		        <input type="text" name="turma" class="form-control" ng-model="doador.turma">
        		<span ng-show="erroTurma" class="msgErro">{{erroTurma}}</span>
    		</div>
    		<button class="btn btn-primary" type="submit">Cadastrar</button>
		</form>
	</div>
	<footer class="container-fluid">
		<p>AMPARO MATERNAL - EURÍPEDES NOVELINO &copy; - <?php date_default_timezone_set("America/Sao_Paulo"); echo date('Y');?></p>
	</footer>

<script type="text/javascript" src="../geral/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../geral/js/popper.min.js"></script>
<script type="text/javascript" src="../geral/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>