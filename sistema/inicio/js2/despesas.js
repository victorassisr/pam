	
	angular.module("despesas", []);
	angular.module("despesas").controller("despesasCtrl", function($scope, $http){
		$http({
		method : "GET",
		url : "listaD.php",
		}).then(function sucesso(response){
			var str = String(response.data);
			$scope.despesas = response.data;	
		});

	});