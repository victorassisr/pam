//LISTAR CAMPANHAS
	angular.module("campanhas", []);
	angular.module("campanhas").controller("campanhasCtrl", function($scope, $http){
		$http({
		method : "GET",
		url : "listarCampanhas.php",
		}).then(function sucesso(response){
			var str = String(response.data);
			$scope.campanhas = response.data;	
		});

    $scope.excluir = function(id, nome){
      var confirmacao = confirm("Deseja realmente excluir a campanha " + nome + "?");
      if(confirmacao === true){
        $http({
          method : "GET",
          url : "excluir.php?acao=excluir&id="+id,
        }).then(function(response){
          alert(response.data.resultado);
          location.href = "../campanha/lista.php";
          
        });
      } else {
        return;
      }
    }
	});

//LISTAR CAMPANHAS ATIVAS
  angular.module("campanhasAtivas", []);
  angular.module("campanhasAtivas").controller("campanhasAtivasCtrl", function($scope, $http){
    $http({
    method : "GET",
    url : "listarAtivas.php",
    }).then(function sucesso(response){
      var str = String(response.data);
      if(response.data.resposta != undefined){
        alert(response.data.resposta);
      } else {
        $scope.campanhas = response.data;       
      }

    });
  
    $scope.excluir = function(id, nome){

        var confirmacao = confirm("Deseja realmente excluir a campanha " + nome + "?");
        if(confirmacao === true){
          $http({
            method : "GET",
            url : "excluir.php?acao=excluir&id="+id,
          }).then(function(response){
            alert(response.data.resultado);
            location.href = "../campanha/index.php";
            
          });
        } else {
          return;
        }
    }//Fim da function excluir
  });
//EDITAR CAMPANHA
	angular.module('editarCampanha', []);
    angular.module('editarCampanha').controller('editarCampanhaCtrl', function($scope, $http, $filter) {

        $scope.submitForm = function() {
            $http({
              method  : 'POST',
              url     : 'editarCampanha.php',
             }).then(function(response){
              var result = (typeof response.data === 'string');
              if(result){
                if(response.data.match(/<b>Fatal error/)){
                  alert("Erro ao processar a requisição!");
                  confirm("Erro FATAL, tente novamente.\nSe persistir, contate o administrador.");
                }else
                	location.href = "../campanha/";
              }                
            });
     	}
     });
//CADASTRAR CAMPANHA
angular.module("cadastroCampanha", []);
angular.module("cadastroCampanha").controller("cadastroCampanhaCtrl", function($scope, $http, $filter) {
  
$scope.cadastroCamp = function(){

      $scope.campanha.dataInicial = $filter('date')($scope.dataInicial, 'yyyy-MM-dd');
      $scope.campanha.dataFinal = $filter('date')($scope.dataFinal, 'yyyy-MM-dd');

        $http({
          method : "POST",
          url : "cadastrarCampanha.php",
          data : $scope.campanha
        }).then(function(response){
          alert(response.data.resultado);
          location.href = "cadastro.php"
        });
      } 
});
