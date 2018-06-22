var editarDoadorApp = angular.module('editarDoadorApp', []);
    editarDoadorApp.controller('editarDoadorController', function($scope, $http, $filter, $location) {
      $scope.doador = {};
      d = {};
      var str = String($location.$$absUrl);
      str2 = str.match(/id=[0-9]+/);
      if(str2 != null){
        var id = String(str2[0].slice(3));

        $http({
          method : "GET",
          url : "operacaoDoador.php?acao=buscar&id="+id,
        }).then(function(response){
          var resp = String(response.data);
          if(resp.match(/Parse error/)){
            $scope.erro = "Houve um erro ao buscar os doadores, se o problema persistir, contate o administrador do site.";
          } else if(resp.match(/ExceptionErro/)){
            $scope.erro = "Houve um erro!";
          } else if(resp.match(/Fatal error/)){
            $scope.erro = "Houve um erro!";
          }else if(response.data.resposta != undefined){
            $scope.erro = response.data.resposta;
          }else {
              $scope.formulario = "formEditarDoador.php";
              d = response.data;
              $scope.doador.id = d.id_doador;
              $scope.doador.nome = d.nome;
              $scope.doador.endereco = d.endereco;
              $scope.doador.email = d.email;
              $scope.doador.telefoneFixo = d.telefoneResidencial;
              $scope.doador.celular = d.celular1;
              $scope.doador.celularOpcional = d.celular2;
              $scope.dataNascimento = { value : new Date(d.nascimento+":00:00:00") };
              $scope.dataCadastro = { value : new Date(d.dataCadastro+":00:00:00") };
              $scope.doador.reaisADoar = parseFloat(d.reaisADoar);
              $scope.doador.centavosADoar = d.centavosADoar;
              $scope.doador.dia = d.doaDia;
              $scope.doador.mes = d.doaMes;
              $scope.doador.documento = d.documento;
              $scope.doador.tipoDeDoador = d.tipoDoador;
              $scope.doador.pessoa = d.tipoPessoa;
              $scope.doador.operadora = d.operadora;
              $scope.doador.turma = d.turma;

              //Colocar Dia ou mes, dependendo do doador..
              if($scope.doador.tipoDeDoador == "Fidelizado"){
                $scope.diaShow = true;
                $scope.mesShow = false;
                $scope.valorASerDoado = true;
                $scope.doador.mes = "Não definido";
              } else {
                $scope.diaShow = false;
                $scope.valorASerDoado = false;
                $scope.doador.dia = 0;
              }

              if($scope.doador.tipoDeDoador == "Exporádico"){
                $scope.mesShow = true;
                $scope.diaShow = false;
                $scope.doador.dia = 0;
                $scope.doador.mes = "Aleatório";
              } else {
                $scope.mesShow = false;
                $scope.doador.mes = "Não definido";
              }

              if($scope.doador.tipoDeDoador == "Anual"){
                $scope.doador.dia = 0;
                $scope.doador.mes = "Aleatório";
                $scope.mesShow = false;
                $scope.diaShow = false;
              } //Fim de colocar Dia ou mes, dependendo do doador..

          }
        }); //Fim do then da requisicao dos dados do doador
      } else {
        alert("Por favor, selecione um doador válido!");
        location.href="listar.php";
        return;
      }

        $scope.submitForm = function() {
            $scope.doador.dataDeNascimento = $filter('date')($scope.dataNascimento.value, 'yyyy-MM-dd');
            $scope.doador.dataDeCadastro = $filter('date')($scope.dataCadastro.value, 'yyyy-MM-dd');
            $http({
              method  : 'POST',
              url     : 'editarDoador.php',
              data    : $scope.doador,
              headers : { 'Content-Type': 'application/x-www-form-urlencoded' },
             }).then(function(response){
              var result = (typeof response.data === 'string');

              if(result){
                if(response.data.match(/<b>Fatal error<\/b>/)){
                  alert("Erro ao processar a requisição!");
                  confirm("Erro FATAL, tente novamente.\nSe persistir, contate o administrador.");
                } else {
                  alert("Erro não especificado.");
                }
              }
                //Mostra as mensagens de erro.
                if(response.data.erroNome != undefined){
                	$scope.erroNome = response.data.erroNome;
                }
                if(response.data.erroBanco != undefined){
                	$scope.erroGeral = response.data.erroBanco;
                }
                if(response.data.erroEndereco != undefined){
                  $scope.erroEndereco = response.data.erroEndereco;
                }
                if(response.data.erroEmail != undefined){
                  $scope.erroEmail = response.data.erroEmail;
                }
                if(response.data.erroDocumento != undefined){
                  $scope.erroDocumento = response.data.erroDocumento;
                }
	              if(response.data.sucesso != undefined){
	                alert("Cadastrado com sucesso!");
	                location.href="cadastrar.php";
	             }
            });
        } //Fim do submitForm()

        $scope.alteraTipoDoador = function(){
        	//Se caso os valores do tipo de doador mudar, oculta ou mostra as infos pertinentes.
        	if($scope.doador.tipoDeDoador == "Fidelizado"){
        		$scope.diaShow = true;
        		$scope.mesShow = false;
        		$scope.doador.mes = "Não definido";
        		$scope.doador.dia = "1";
        	} else {
	        	$scope.diaShow = false;
	        	$scope.doador.dia = 0;
	        }
	        
        	if($scope.doador.tipoDeDoador == "Exporádico"){
        		$scope.mesShow = true;
        		$scope.diaShow = false;
        		$scope.doador.dia = 0;
        		$scope.doador.mes = "Aleatório";
        	} else {
	        	$scope.mesShow = false;
	        	$scope.doador.mes = "Não definido";
	        }
			
        	if($scope.doador.tipoDeDoador == "Anual"){
        		$scope.doador.dia = 0;
        		$scope.doador.mes = "Aleatório";
        		$scope.mesShow = false;
   	     		$scope.diaShow = false;
        	}
        } //Fim função alteraTipoDeDoador()

window.onload = function(){
        //Validacao no carregamento da página
        if($scope.doador.tipoDeDoador == "Fidelizado"){
        	$scope.diaShow = true;
        	$scope.mesShow = false;
        	$scope.doador.mes = "Não definido";
        } else {
        	$scope.diaShow = false;
        	$scope.doador.dia = 0;
        }

        if($scope.doador.tipoDeDoador == "Exporádico"){
        	$scope.mesShow = true;
        	$scope.diaShow = false;
        	$scope.doador.dia = 0;
        	$scope.doador.mes = "Aleatório";
        } else {
	        $scope.mesShow = false;
	        $scope.doador.mes = "Não definido";
	    }

       	if($scope.doador.tipoDeDoador == "Anual"){
        	$scope.doador.dia = 0;
        	$scope.doador.mes = "Aleatório";
        	$scope.mesShow = false;
        	$scope.diaShow = false;
        }
        //Fim da validacao
      }
    }); //Fim do controller
