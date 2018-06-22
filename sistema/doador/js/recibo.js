var reciboDoador = angular.module("reciboDoador", []);
reciboDoador.controller("reciboController", function($scope, $location, $http){

    $scope.recibo = {};

	var str = String($location.$$absUrl);
    str2 = str.match(/id=[0-9]+/);
    if(str2 != null){
    	var id = String(str2[0].slice(3));
    	$http({
    		method : "GET",
    		url : "operacaoDoador.php?acao=buscar&id="+id
    	}).then(function(response){
    		if(response.data.resposta === undefined){
    			$scope.tableDoador = "tableInfoDoador.php";
    			$scope.doador = response.data;
                console.log(response.data);
                $scope.recibo.nome = response.data.nome;
                $scope.recibo.id_doador = response.data.id_doador;
                $scope.recibo.reais = response.data.reaisADoar;
                $scope.recibo.centavos = response.data.centavosADoar;
                $scope.recibo.numero = response.data.numero;
    		} else {
    			$scope.erro = response.data.resposta;
    		}
    	});
    } else {
    	alert("Por favor, selecione um doador válido!");
        location.href="listar.php";
        return;
    }

    //Gerar numero do recibo
    $http({
            method : "GET",
            url : "gerarNumeroRecibo.php"
        }).then(function(response){
            if(response.data.numero != undefined){
                $scope.numero = response.data.numero;
            }
            if(response.data.erro != undefined){
                alert("Houve um erro ao processar o recibo!\nErro: "+response.data.erro);
                location.href="listar.php";
            }
        });

    //Cadastrar Recibo
    $scope.cadastrarRecibo = function(){
        $http({
                method : "POST",
                url : "cadastrarRecibo.php",
                data : $scope.recibo
            }).then(function(response){
                console.log(response.data);
            });
    }
});