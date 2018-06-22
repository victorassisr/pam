<?php

 $json = file_get_contents("php://input");

 $busca = json_decode($json);



	if($busca->data != "0000-00-00"){

		require_once('conexao.php'); //Inclui o arquivo de conexão na página.

		$con = conexaoMysql(); //Atribui a conexão a variaveel $con

		$data = "%".$busca->data."%"; //Coloca % no inicio e fim da data
			if($data != "%%"){

				$sql = "SELECT * FROM doador WHERE dataCadastro LIKE :parametro OR nascimento LIKE :parametro";

				//Seleciona tudo do doador onde a data ou nascimento seja igual ao parametro.

				$busca = $con->prepare($sql); //Prepara a busca.

				$busca->bindValue(':parametro',$data); //Coloca o valor da data no lugar de :parametro

				$busca->execute(); //Executa a busca no Banco

				if($busca->rowCount() > 0){ //Se retornar algum resultado
					$doadores = $busca->fetchAll(PDO::FETCH_OBJ); //Retorna os doadores
					echo json_encode($doadores);
				} else { //Senão
					$nf["notFound"] = "Nada encontrado!";
					echo json_encode($nf); //Nenhum resultado encontrado
				}
			} else {
				$nf["notFound"] = "Nada encontrado!";
				echo json_encode($nf); //Nenhum resultado encontrado
			}
	} else {
		$parametro = "%".$busca->pesquisa."%"; //Adiciona % no inicio e fim do parametro pra não dar erro na consulta SQL
		require_once('conexao.php'); //Inclui o arquivo de conexão na página.

		$con = conexaoMysql(); //Atribui a conexão a variaveel $con

		if($parametro != "%%"){ //Se o pparametro for diferente de %%, ou seja, não foi definido um parametro.

			$sql = "SELECT * FROM doador WHERE nome LIKE :parametro OR endereco LIKE :parametro OR email LIKE :parametro OR telefoneResidencial LIKE :parametro OR celular1 LIKE :parametro OR celular2 LIKE :parametro OR nascimento LIKE :parametro OR dataCadastro LIKE :parametro OR tipoDoador LIKE :parametro OR doaDia LIKE :parametro OR doaMes LIKE :parametro OR tipoPessoa LIKE :parametro OR operadora LIKE :parametro OR turma LIKE :parametro";

			//Seleciona tudo do doador onde dados dorem correspondentes ao parametro buscado..

			$busca = $con->prepare($sql); //Prepara a consulta

			$busca->bindValue(':parametro',$parametro); //Atribui o valor de $parametro a :parametro

			$busca->execute(); //Executa a busca.

			if($busca->rowCount() > 0){ //Se retornar pelo menos um resultado
				$doadores = $busca->fetchAll(PDO::FETCH_OBJ); //Doadores são atribuidos a variavel $doadores.
				echo json_encode($doadores);
			} else { //Senão
				$nf["notFound"] = "Nada encontrado!";
				echo json_encode($nf); //Nenhum resultado encontrado
			}
		} else {
			$nf["notFound"] = "Nada encontrado!";
			echo json_encode($nf); //Nenhum resultado encontrado
		} 

	}
		
/*
	$parametro = $busca->parametro; //Pega o parametro
	$tipo = $_POST['tipo']; //Pega o tipo

	$parametro = "%".$parametro."%"; //Adiciona % no inicio e fim do parametro pra não dar erro na consulta SQL

	require_once('conexao.php'); //Inclui o arquivo de conexão na página.

	$con = conexaoMysql(); //Atribui a conexão a variaveel $con

	if($tipo == "DOADOR"){ //Se o tipo de busca for igual a 1

		if($parametro != "%%"){ //Se o pparametro for diferente de %%, ou seja, não foi definido um parametro.

			$sql = "SELECT * FROM doador WHERE nome LIKE :parametro OR endereco LIKE :parametro OR email LIKE :parametro OR telefoneResidencial LIKE :parametro OR celular1 LIKE :parametro OR celular2 LIKE :parametro OR nascimento LIKE :parametro OR dataCadastro LIKE :parametro OR tipoDoador LIKE :parametro OR doaDia LIKE :parametro OR doaMes LIKE :parametro OR tipoPessoa LIKE :parametro OR operadora LIKE :parametro OR turma LIKE :parametro";

			//Seleciona tudo do doador onde dados dorem correspondentes ao parametro buscado..

			$busca = $con->prepare($sql); //Prepara a consulta

			$busca->bindValue(':parametro',$parametro); //Atribui o valor de $parametro a :parametro

			$busca->execute(); //Executa a busca.

			if($busca->rowCount() > 0){ //Se retornar mais q um resultado
				$doadores = $busca->fetchAll(PDO::FETCH_OBJ); //Doadores são atribuidos a variavel $doadores.
				echo json_encode($doadores);
			} else { //Senão
				echo "<h1>Nada encontrado!</h1>"; //Nenhum resultado encontrado
			}
		} else { //Se o parametro for vazio %%
			if($_POST['data'] != ""){ //Se a data for diferente de vazia
				$data = "%".$_POST['data']."%"; //Coloca % no inicio e fim da data


				$sql = "SELECT * FROM doador WHERE dataCadastro LIKE :parametro OR nascimento LIKE :parametro";

				//Seleciona tudo do doador onde a data ou nascimento seja igual ao parametro.

				$busca = $con->prepare($sql); //Prepara a busca.

				$busca->bindValue(':parametro',$data); //Coloca o valor da data no lugar de :parametro

				$busca->execute(); //Executa a busca no Banco

				if($busca->rowCount() > 0){ //Se retornar algum resultado
					$doadores = $busca->fetchAll(PDO::FETCH_OBJ); //Retorna os doadores
					echo json_encode($doadores);
				} else { //Senão
					echo "<h1>Nada encontrado!</h1>"; //Mostra nada encontrado.
				}

			} else { //Se caso não encontrar nada, mostra:
				echo "<h1>Nada encontrado!</h1>";
			}
		}

	}

	//Busca pela doacao

	if($tipo == "DOACAO"){


		if($_POST['data'] != ""){ //Se a data for diferente de vazia
			$data = "%".$_POST['data']."%"; //Coloca % no inicio e fim da data.


			$sql = "SELECT * FROM doacao WHERE dataDoacao LIKE :parametro";

			//Seleciona tudo de doacao onde a data for igual a busca.

			$busca = $con->prepare($sql); //Prepara a query

			$busca->bindValue(':parametro',$data); //Atribui valor da data a :parametro

			$busca->execute(); //Executa a busca.

			if($busca->rowCount() > 0){ //Se retornar algum resultado
				$doacoes = $busca->fetchAll(PDO::FETCH_OBJ); //Doacoes
				foreach ($doacoes as $doacao) {
					//Em cada doação consulta o doador que a fez.
					$sql = "SELECT nome FROM doador WHERE id_doador = :idDoador";
					//Seleciona o nome do doador onde o id_doador for igual :idDoador.
					$busca = $con->prepare($sql);//Prepara a consulta

					$busca->bindValue(':idDoador',$doacao->id_doador); //Atribuui o valor do id_doador que foi retornado da doacao.

					$busca->execute(); //Executa a busca

					$doador = $busca->fetch(PDO::FETCH_OBJ); //Dados do doador.

					if($doacao->tipoDinheiro == 1){ //Se o tipo de doação for em dinheiro, mostra
						echo "<p>Doador: ".$doador->nome." Doou: ".$doacao->item_doacao." Na quantia de: ". $doacao->valorDinheiro.",". $doacao->valorCentavos ." Na data de: "."<input type=\"date\" name=\"data\" value='" . $doacao->dataDoacao ."' readonly></p>";
					} //Se não for em dinheiro mostra:
					echo "<p>Doador: ".$doador->nome." Doou: ".$doacao->item_doacao." Na data de: "."<input type=\"date\" name=\"data\" value='" . $doacao->dataDoacao ."' readonly></p>";;
				}
			} else { //Não encontrou nada
				echo "<h1>Nada encontrado!</h1>";
			}

		} else { //Não encontrou nada
			echo "<h1>Nada encontrado!</h1>";
		}

	}

} else { //Se não tiver passado um parametro e um tipo mostra a mensagem.
	echo "Exepecifique corretamente o que você deseja buscar.";
}

*/
?>