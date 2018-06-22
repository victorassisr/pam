var reciboDoador = angular.module("reciboDoador", []);
reciboDoador.controller("reciboController", function($scope, $location, $http){

	var str = String($location.$$absUrl);
    str2 = str.match(/id=[0-9]+/);
    if(str2 != null){
    	var id = String(str2[0].slice(3));
    	$http({
    		method : "GET",
    		url : "operacaoDoador.php?acao=buscar&id="+id
    	}).then(function(response){
    		console.log(response.data);
    		if(response.data.resposta === undefined){
    			$scope.tableDoador = "tableInfoDoador.php";
    			$scope.doador = response.data;
    		} else {
    			$scope.erro = response.data.resposta;
    		}
    	});
    } else {
    	alert("Por favor, selecione um doador válido!");
        location.href="listar.php";
        return;
    }
});