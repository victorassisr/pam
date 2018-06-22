<?php

	if(isset($_GET['id']) && $_GET['id'] != ""){
		$id_doacao = $_GET['id'];

	require_once('conexao.php');
	$con = conexaoMysql();

	//Busca Doacao
	$sql = "SELECT * FROM doacao WHERE id_doacao = :id_doacao";
	$busca = $con->prepare($sql);
	$busca->bindValue(':id_doacao',$id_doacao);
	$busca->execute();
	if($busca->rowCount() == 1){
		$doacao = $busca->fetch(PDO::FETCH_OBJ);

	//Busca Campanha
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

	//Busca doador
	$sql = "SELECT id_doador, nome FROM doador WHERE id_doador = :id";
	$busca = $con->prepare($sql);
	$busca->bindValue(':id',$doacao->id_doador);
	$busca->execute();
	$doador = $busca->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
<head>
	<noscript>
		<meta http-equiv="Refresh" content="0;url=https://10.0.0.50/projetoAmparoMaternal/index.php?erro=nojs">
	</noscript>

	<title>Cadastrar Doacao</title>
</head>
<body>

	<form action="updateDoacao.php" method="POST" id="formDoacao">

		<label for="itemDoacao" id="lItemDoacao">O que foi doado?</label>
		<input type="text" name="itemDoacao" id="itemDoacao" value="<?php echo $doacao->item_doacao; ?>">

		<br><br>

		<select name="campanha">
			<option value="default">Selecione a Campanha..</option>
			<?php foreach($campanhas as $campanha){
			if($doacao->id_campanha == $campanha->id_campanha){ ?>
				<option value="<?php echo $campanha->id_campanha; ?>" selected><?php echo $campanha->nomeCampanha; ?></option>
			<?php } else { ?>
			<option value="<?php echo $campanha->id_campanha; ?>"><?php echo $campanha->nomeCampanha; ?></option>
			<?php }} ?>
		</select>

		<br><br>

		<label for="doador">Doador: </label>
		<input type="text" name="doador" id="doador" value="<?php echo $doador->nome; ?>" readonly>
		<input type="hidden" name="id_doador" value="<?php echo $doador->id_doador; ?>">

		<br><br>

		<label for="dataDoacao">Data da Doação</label>
		<input type="date" name="dataDoacao" id="dataDoacao" value="<?php echo $doacao->dataDoacao; ?>">

		<br><br>

		<label for="quantidade" id="lQuantidade">Quantidade: </label>
		<input type="number" name="quantidade" id="quantidade" value="<?php echo $doacao->quantidade; ?>">

		<br><br>

		<label for="valorDinheiro" id="lValorDinheiro">Valor Doado: </label>
		<input type="text" name="valorDinheiro" id="valorDinheiro" value="<?php echo $doacao->valorDinheiro; ?>">
		<label for="valorCentavos" id="lValorCentavos">,</label>
		<input type="text" maxlength="2" name="valorCentavos" id="valorCentavos" value="<?php echo $doacao->valorCentavos; ?>">

		<br><br>

		<select name="tipoDinheiro">
			<option value="default">Selecione a categoria..</option>
			<?php foreach($tiposDinheiro as $tipoDinheiro){

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

			if($tipoDinheiro->idTipoDinheiro == $doacao->tipoDinheiro){
				?>
			<option value="<?php echo $tipoDinheiro->idTipoDinheiro; ?>" selected><?php echo $tipoDinheiro->tipo; ?></option>
			<?php } else { ?>
			<option value="<?php echo $tipoDinheiro->idTipoDinheiro; ?>"><?php echo $tipoDinheiro->tipo; ?></option>
			<?php }} ?>
		</select>

		<br><br>

		<select name="tipoDoacao">
			<option value="default">Selecione a categoria..</option>
			<?php foreach($tipoDoacoes as $tipoDoacao){ ?>
			<?php if($tipoDoacao->id_tipoDoacao == $doacao->id_tipoDoacao){
				?>
				<option value="<?php echo $tipoDoacao->id_tipoDoacao; ?>" selected><?php echo $tipoDoacao->nome; ?></option>
			<?php } else{ ?>
			<option value="<?php echo $tipoDoacao->id_tipoDoacao; ?>"><?php echo $tipoDoacao->nome; ?></option>
			<?php }} ?>
		</select>

		<br><br>

		<input type="hidden" name="id_doacao" value="<?php echo $doacao->id_doacao; ?>">

		<input type="submit" value="Cadastrar">
	</form>

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
				form.itemDoacao.style.display = "none";
				form.itemDoacao.value = "default";
				labelForItemDoacao.style.display = "none";
				form.quantidade.style.display = "none";
				form.quantidade.value = "default";
				form.valorDinheiro.value = "";
				form.valorCentavos.value = "";
				labelForQuantidade.style.display = "none";
				form.valorDinheiro.style.display = "inline";
				form.valorCentavos.style.display = "inline";
				labelForValorCentavos.style.display = "inline";
				labelForValorDinheiro.style.display = "inline";
			} else {
				form.tipoDinheiro.style.display = "none";
				form.tipoDinheiro.value = "default";
				form.itemDoacao.style.display = "inline";
				form.itemDoacao.value = "";
				labelForItemDoacao.style.display = "inline";
				form.quantidade.style.display = "inline";
				labelForQuantidade.style.display = "inline";
				form.quantidade.value = "0";
				form.valorDinheiro.style.display = "none";
				form.valorDinheiro.value = "default";
				form.valorCentavos.style.display = "none";
				form.valorCentavos.value = "default";
				labelForValorCentavos.style.display = "none";
				labelForValorDinheiro.style.display = "none";
			}
		});
		
			tipo = form.tipoDoacao.options;

			valor = tipo[tipo.selectedIndex].innerHTML;

			if(valor == 'Dinheiro'){
				form.tipoDinheiro.style.display = "inline";
				form.itemDoacao.style.display = "none";
				form.itemDoacao.value = "default";
				labelForItemDoacao.style.display = "none";
				form.quantidade.style.display = "none";
				form.quantidade.value = "default";
				labelForQuantidade.style.display = "none";
				form.valorDinheiro.style.display = "inline";
				form.valorCentavos.style.display = "inline";
				labelForValorCentavos.style.display = "inline";
				labelForValorDinheiro.style.display = "inline";
			} else {
				form.tipoDinheiro.style.display = "none";
				form.tipoDinheiro.value = "default";
				form.itemDoacao.style.display = "inline";
				labelForItemDoacao.style.display = "inline";
				form.quantidade.style.display = "inline";
				labelForQuantidade.style.display = "inline";
				form.valorDinheiro.style.display = "none";
				form.valorDinheiro.value = "default";
				form.valorCentavos.style.display = "none";
				form.valorCentavos.value = "default";
				labelForValorCentavos.style.display = "none";
				labelForValorDinheiro.style.display = "none";
			}

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

