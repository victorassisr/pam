<?php

	if(isset($_GET['id']) && $_GET['id'] != ""){
		$id_doador = $_GET['id'];

	require_once('conexao.php');
	$con = conexaoMysql();

	//Busca Doador
	$sql = "SELECT id_doador, nome FROM doador WHERE id_doador = :id_doador";
	$busca = $con->prepare($sql);
	$busca->bindValue(':id_doador',$id_doador);
	$busca->execute();
	if($busca->rowCount() == 1){
		$doador = $busca->fetch(PDO::FETCH_OBJ);

	//Busca Campanhas
	$sql = "SELECT id_campanha, nomeCampanha FROM campanhas";
	$busca = $con->prepare($sql);
	$busca->execute();
	$campanhas = $busca->fetchAll(PDO::FETCH_OBJ);

	//Busca tipo de Doação
	$sql = "SELECT id_tipoDoacao, nome FROM tipoDoacao";
	$busca = $con->prepare($sql);
	$busca->execute();
	$tipoDoacoes = $busca->fetchAll(PDO::FETCH_OBJ);

	//Busca tipo de Doação em dinheiro
	$sql = "SELECT idTipoDinheiro, tipo FROM tipoDoacaoDinheiro";
	$busca = $con->prepare($sql);
	$busca->execute();
	$tiposDinheiro = $busca->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Doacao</title>
</head>
<body>

	<form action="cadastroDoacao.php" method="POST" id="formDoacao">

		<label for="itemDoacao" id="lItemDoacao">O que foi doado?</label>
		<input type="text" name="itemDoacao" id="itemDoacao">

		<br><br>

		<select name="campanha">
			<option value="default">Selecione a Campanha..</option>
			<?php foreach($campanhas as $campanha){ ?>
			<option value="<?php echo $campanha->id_campanha; ?>"><?php echo $campanha->nomeCampanha; ?></option>
			<?php } ?>
		</select>

		<br><br>

		<label for="doador">Doador: </label>
		<input type="text" name="doador" id="doador" value="<?php echo $doador->nome; ?>" readonly>
		<input type="hidden" name="id_doador" value="<?php echo $doador->id_doador; ?>">

		<br><br>

		<label for="dataDoacao">Data da Doação</label>
		<input type="date" name="dataDoacao" id="dataDoacao">

		<br><br>

		<label for="quantidade" id="lQuantidade">Quantidade: </label>
		<input type="number" name="quantidade" id="quantidade">

		<br><br>

		<label for="valorDinheiro" id="lValorDinheiro">Valor Doado: </label>
		<input type="text" name="valorDinheiro" id="valorDinheiro">
		<label for="valorCentavos" id="lValorCentavos">,</label>
		<input type="text" maxlength="2" name="valorCentavos" id="valorCentavos">

		<br><br>

		<select name="tipoDinheiro">
			<option value="default">Selecione a categoria..</option>
			<?php foreach($tiposDinheiro as $tipoDinheiro){ ?>
			<?php
				if($tipoDinheiro->tipo == "deposito"){
					$tipoDinheiro->tipo = "Depósito";
				}

				if($tipoDinheiro->tipo == "especie"){
					$tipoDinheiro->tipo = "Espécie";
				}

				if($tipoDinheiro->tipo == "cheque"){
					$tipoDinheiro->tipo = "Cheque";
				}

				if($tipoDinheiro->tipo == "cartao"){
					$tipoDinheiro->tipo = "Cartão";
				}

				if($tipoDinheiro->tipo == "outro"){
					$tipoDinheiro->tipo = "Outros";
				}
			?>
			<option value="<?php echo $tipoDinheiro->idTipoDinheiro; ?>"><?php echo $tipoDinheiro->tipo; ?></option>
			<?php } ?>
		</select>

		<br><br>

		<select name="tipoDoacao">
			<option value="default">Selecione a categoria..</option>
			<?php foreach($tipoDoacoes as $tipoDoacao){ ?>
			<option value="<?php echo $tipoDoacao->id_tipoDoacao; ?>"><?php echo $tipoDoacao->nome; ?></option>
			<?php } ?>
		</select>

		<br><br>

		<input type="submit" value="Cadastrar">
	</form>

	<script>
		
		//COLOCAR DATA NO INPUT DATA DE DOAÇÂO
	dataDoacao = document.getElementById('dataDoacao');
	
	data = new Date(); //Cria uma nova data
	dia = data.getDate();	//Pega o dia
	mes = data.getMonth() + 1; //Pega o mes [0 a 11] soma mais 1 pra ficar certo.
	ano = data.getFullYear(); //Pega o ANO.

	if(dia < 10){	//Se o dia for menor q 10, coloca o 0 antes.
		dia = "0"+dia;
	}
	if(mes < 10){	//Se o mes for menor q 10, coloca o 0 antes.
		mes = "0"+mes;
	}

	dataAtual = ano + "-" + mes + "-" + dia; //Formata a data para ser valida no value do input.
	dataDoacao.value = dataAtual; //Coloca a data validada no input.

	//FIM COLOCAR DATA NO INPUT DATA DE CADASTRO
	</script>

	<script type="text/javascript">

		form = document.getElementById("formDoacao");


		//Labels
		labelForItemDoacao = document.getElementById("lItemDoacao");
		labelForQuantidade = document.getElementById("lQuantidade");
		labelForValorDinheiro = document.getElementById("lValorDinheiro");
		labelForValorCentavos = document.getElementById("lValorCentavos");


		form.tipoDinheiro.style.display = "none";
		form.tipoDinheiro.style.display = "none";
		form.itemDoacao.style.display = "none";
		labelForItemDoacao.style.display = "none";
		form.quantidade.style.display = "none";
		labelForQuantidade.style.display = "none";
		form.valorDinheiro.style.display = "none";
		form.valorCentavos.style.display = "none";
		labelForValorDinheiro.style.display = "none";
		labelForValorCentavos.style.display = "none";

		form.tipoDoacao.addEventListener("change",function(){

			tipo = form.tipoDoacao.options;

			valor = tipo[tipo.selectedIndex].innerHTML;

			if(valor == 'Dinheiro'){
				form.tipoDinheiro.style.display = "inline";
				form.tipoDinheiro.value = "default";
				form.itemDoacao.style.display = "none";
				form.itemDoacao.value = "default";
				labelForItemDoacao.style.display = "none";
				form.quantidade.style.display = "none";
				form.quantidade.value = "default";
				labelForQuantidade.style.display = "none";
				form.valorDinheiro.style.display = "inline";
				form.valorDinheiro.value = "";
				form.valorCentavos.style.display = "inline";
				form.valorCentavos.value = "";
				labelForValorCentavos.style.display = "inline";
				labelForValorDinheiro.style.display = "inline";
			} else {
				form.tipoDinheiro.style.display = "none";
				form.tipoDinheiro.value = "default";
				form.itemDoacao.style.display = "inline";
				form.itemDoacao.value = "";
				labelForItemDoacao.style.display = "inline";
				form.quantidade.style.display = "inline";
				form.quantidade.value = "";
				labelForQuantidade.style.display = "inline";
				form.valorDinheiro.style.display = "none";
				form.valorDinheiro.value = "default";
				form.valorCentavos.style.display = "none";
				form.valorCentavos.value = "default";
				labelForValorCentavos.style.display = "none";
				labelForValorDinheiro.style.display = "none";
			}
		});

		
	function check(){	
		dinheiro = form.valorDinheiro.value + "." + form.valorCentavos.value;
		if(dinheiro.match(/^-?\d+\.\d+$/) != null){
			form.valorDinheiro.style.border = "1px solid #a9a9a9";
			form.valorDinheiro.style.padding = "2px 2px";
			form.valorCentavos.style.border = "1px solid #a9a9a9";
			form.valorCentavos.style.padding = "2px 2px";
		} else {
			form.valorDinheiro.style.border = "2px solid red";
			form.valorCentavos.style.border = "2px solid red";
		}
	}

	form.valorDinheiro.addEventListener("keyup",function(){
		if(form.valorDinheiro.value.match(/^[0-9]+$/) && form.valorDinheiro.value != ""){
			form.valorDinheiro.style.border = "1px solid #0F0";
			form.valorDinheiro.style.padding = "2px 2px";
		} else {
			form.valorDinheiro.style.border = "2px solid red";
		}
	});

	form.valorCentavos.addEventListener("keyup",function(){
		if(form.valorCentavos.value.match(/^[0-9]+$/) && form.valorCentavos.value != ""){
			form.valorCentavos.style.border = "1px solid #0F0";
			form.valorCentavos.style.padding = "2px 2px";
		} else {
			form.valorCentavos.style.border = "2px solid red";
		}
	});

	</script>


</body>
</html>

<?php
		} else {
			echo "O doador não existe! Selecione um doador válido!";
		}

	} else {
		echo "Voce deve selecionar um usuário para cadastrar a doação primeiro!";
	}

$con = null;
?>

