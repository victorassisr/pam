<?php
	$json = file_get_contents("php://input");
	$doador = json_decode($json);


	$erros = Array();
	$sucesso = Array();

	if(!isset($doador->nome)){
		$erros["erroNome"] = "Nome não pode ficar vazio.";
	}

	if(!isset($doador->endereco)){
		$erros["erroEndereco"] = "Endereco não pode ficar vazio.";
	}

	if(!isset($doador->email)){
		$erros["erroEmail"] = "E-Mail não pode ficar vazio.";
	}

	if(!isset($doador->telefoneFixo)){
		$doador->telefoneFixo = "0 00 0000-0000";
	}

	if(!isset($doador->celular)){
		$doador->celular = "0 00 0 0000-0000";
	}

	if(!isset($doador->celularOpcional)){
		$doador->celularOpcional = "0 00 0 0000-0000";
	}

	if(!isset($doador->dataDeNascimento)){
		$erros["erroDataDeNascimento"] = "Nascimento não pode ficar vazio.";
	}

	if(!isset($doador->dataDeCadastro)){
		$erros["erroDataDeCadastro"] = "Data de cadastro não pode ficar vazio.";
	}

	if(!isset($doador->tipoDeDoador)){
		$erros["erroTipoDeDoador"] = "Selecione um tipo de doador!";
	}

	if(!isset($doador->pessoa)){
		$erros["erroPessoa"] = "Selecione um tipo de pessoa!";
	}

	if(!isset($doador->documento)){
		$erros["erroDocumento"] = "Informe o documento!";
	}

	if(!isset($doador->reaisADoar)){
		$doador->reaisADoar = 0;
	}

	if(!isset($doador->centavosADoar)){
		$doador->centavosADoar = "00";
	}

	if(!isset($doador->operadora)){
		$doador->operadora = "*";
	}

	if(!isset($doador->turma)){
		$doador->turma = "*";
	} 


	if(isset($erros) && $erros != null){
		echo json_encode($erros);
		exit();
	} else {
		//Atualizar no banco..
		require_once('conexao.php');

		$con = conexaoMySql();

		if($doador->dia != "0"){
			$dia = $doador->dia;
		} else {
			$dia = 0;
		}

		if($doador->mes != "Nao definido"){
			$mes = $doador->mes;
		} else{
			$mes = "Nao definido";
		}



		$sql = "UPDATE doador SET nome = :nome, endereco = :endereco, email = :email, telefoneResidencial = :telRes, celular1 = :cel1, celular2 = :cel2, nascimento = :nasc, dataCadastro = :cad, tipoDoador = :tipoCli, reaisADoar = :reaisADoar, centavosADoar = :centavosADoar, doaDia = :doaDia, doaMes = :doaMes, documento = :documento, tipoPessoa = :tipoPessoa, operadora = :operadora, turma = :turma WHERE id_doador = :id";

		$inserir = $con->prepare($sql);
		$inserir->bindValue(':id',$doador->id);
		$inserir->bindValue(':nome',$doador->nome);
		$inserir->bindValue(':endereco',$doador->endereco);
		$inserir->bindValue(':email',$doador->email);
		$inserir->bindValue(':telRes',$doador->telefoneFixo);
		$inserir->bindValue(':cel1',$doador->celular);
		$inserir->bindValue(':cel2',$doador->celularOpcional);
		$inserir->bindValue(':nasc',$doador->dataDeNascimento);
		$inserir->bindValue(':cad',$doador->dataDeCadastro);
		$inserir->bindValue(':tipoCli',$doador->tipoDeDoador);
		$inserir->bindValue(':reaisADoar',$doador->reaisADoar);
		$inserir->bindValue(':centavosADoar',$doador->centavosADoar);
		$inserir->bindValue(':doaDia',$doador->dia);
		$inserir->bindValue(':doaMes',$doador->mes);
		$inserir->bindValue(':documento',$doador->documento);
		$inserir->bindValue(':tipoPessoa',$doador->pessoa);
		$inserir->bindValue(':operadora',$doador->operadora);
		$inserir->bindValue(':turma',$doador->turma);

		$inserir->execute();

		$con = null;
		
		if($inserir->rowCount() > 0){
			$sucesso["sucesso"] = "Sucesso";
			echo json_encode($sucesso);
		} else {
			$erroBanco["erroBanco"] = "Nada a atualizar.";
			echo json_encode($erroBanco);
		}
		//Fim insercao
		
	}

?>