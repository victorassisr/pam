var app = angular.module("listarDoadores", []);

app.controller("controladorListarDoadores", function($scope, $http){

	$http({
		method : "GET",
		url : "operacaoDoador.php?acao=listar",
	}).then(function sucesso(response){
		var str = String(response.data);
		if(str.match(/Parse error/)){
			$scope.erro = "Houve um erro ao buscar os doadores, se o problema persistir, contate o administrador do site.";
		} else if(str.match(/ExceptionErro/)){
			$scope.erro = "Houve um erro!";
		} else if(str.match(/Fatal error/)){
			$scope.erro = "Houve um erro!";
		}else if(response.data.resposta != undefined){
			$scope.erro = response.data.resposta;
		}else {
			$scope.doadores = response.data;
		}

	});

	$scope.excluir = function(id, nome){
		var confirmacao = confirm("Deseja realmente excluir o doador " + nome + "?");
		if(confirmacao === true){
			$http({
				method : "GET",
				url : "operacaoDoador.php?acao=excluir&id="+id,
			}).then(function(response){
				console.log(response.data);
				var str = String(response.data);
				if(str.match(/Parse error/)){
					$scope.erro = "Houve um erro ao excluir o doador, se o problema persistir, contate o administrador do sistema.";
				} else if(str.match(/Fatal error/)){
					$scope.erro = "Houve um erro!";
				} else if(response.data.sucesso != undefined){
					alert(response.data.sucesso);
					location.href="index.php";
				}else if(response.data.resposta != undefined){
					alert(response.data.resposta);
					location.href="listar.php";
				}
			});
		} else {
			return;
		}
	}

	$scope.editar = function(id){

	}

});