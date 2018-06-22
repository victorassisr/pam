		var parametro = document.getElementById('parametro');
		var data = document.getElementById('data');
		var filtro = document.getElementById('filtro');

		data.addEventListener("change",function(){  //Se mudar a data..
			if(data.value != ""){ //Se a data for diferente de uma string vazia..
				if(filtro.value="DOADOR"){
					parametro.style.display = "none"; //Oculta o parametro.
					parametro.value = "";
				} else {
					parametro.style.display = "none"; //Oculta o parametro.
					parametro.value = "";
					labelData.style.display = "inline"; //Oculta label da data
					campoData.style.display = "inline"; //Oculta data.
					campoData.value = "";
				}
			} else { //Senão
				parametro.style.display = "inline"; //Mostra o campo parametro.
			}
		});

		parametro.addEventListener("keyup",function(){ //Se digitar algo no parametro
			var labelData = document.getElementById('labelData');
			var campoData = document.getElementById('data');
			if(filtro.value=="DOADOR"){
				if(parametro.value != ""){ //Se o parametro for diferente a uma string vazia
					labelData.style.display = "none"; //Oculta label da data
					campoData.style.display = "none"; //Oculta data.
					campoData.value = "";
				} else { //Caso contrário
					labelData.style.display = "inline"; //Mostra label data
					campoData.style.display = "inline"; //Mostra campo data.
				}
			}
		});

		filtro.addEventListener("change",function(){ //Se alterar o filtro

			if(filtro.value == "DOACAO"){ //Se o valor do filtro for igual a 2 (Procura por data de doacoes)
				parametro.style.display = "none"; //Oculta o parametro
				parametro.value = "";
				labelData.style.display = "inline"; //Mostra label data
				data.style.display = "inline"; //Mostra campo data.
			} else { //Caso contrário
				parametro.style.display = "inline"; //Mostra o campo parametro
			}
		});

//Angular

var busca = angular.module("buscaDoador", []);
busca.controller("buscaDoadorCtrl",function($scope, $http, $filter){
	$scope.parametros = {};
	//pegar categorias..
	$http({
		method : "GET",
		url : "categoriasBusca.php"
	}).then(function(response){
		$scope.buscas = response.data;
		$scope.parametros.tipoDeBusca = response.data[0].tipoBusca;
	});

	$scope.buscarDoador = function(){
		if($scope.data != null){
			$scope.parametros.data = $filter('date')($scope.data, 'yyyy-MM-dd');
		} else {
			$scope.parametros.data = "0000-00-00";
		}


		//pegar doadores..
		$http({
			method : "POST",
			url : "buscaDoador.php",
			data : $scope.parametros
		}).then(function(response){
			if(response.data.notFound != undefined){
				$scope.not_found = true;
				$scope.notFound = response.data.notFound;
				$scope.doadores = "";
			} else {
				$scope.not_found = false;
				$scope.doadores = response.data;
			}
		});
	}
});