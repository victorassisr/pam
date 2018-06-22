<?php

if(isset($_GET['val']) && $_GET['val'] != ""){

		$data['token'] ='B12506F5A8564348AA7A53027C677834';
		$data['email'] = 'amparomaternal@yahoo.com.br';
		$data['currency'] = 'BRL';
		$data['itemId1'] = '1';
		$data['itemQuantity1'] = '1';
		$data['itemDescription1'] = 'Doação';
		$data['itemAmount1'] = $_GET['val'];

		$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

		$data = http_build_query($data);


		$curl = curl_init($url);


		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		$xml= curl_exec($curl);

		curl_close($curl);

		$xml= simplexml_load_string($xml);
		echo $xml->code;
		
	} else {
		echo '{ "erro" : "erroValorInvalido",
				"msg" : "O valor especificado é inválido."
			}';
	}
?>