<html>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include ("easy.curl.class.php");
include_once ("simple_html_dom.php");

ini_set ( "display_errors", 0 );

$fn = "full_list.txt";
$f_contents = file ( $fn );
srand ( ( double ) microtime () * 1000000 );
$proxy = $f_contents [array_rand ( $f_contents )];

$proxy = explode ( ":", $proxy );
$proxy_addr = $proxy [0];
$proxy_port = $proxy [1];
$msg = "";
$proxy_addr = "";
$proxy_port = "";

$nb = $_REQUEST ["nb"];

$ckfile = "/tmp/inss.txt";

$parametros = array (
		"C_1" => "BLH00.12",
		"C_2" => "",
		"C_3" => $nb,
		"layout" => "8,69,10",
		"submit" => "Transmite" 
);
$resultado = "";
$url = "http://www010.dataprev.gov.br/CWS//BIN/BCM.asp";
$curl = new cURL ();
$html = $curl->post ( $url, $parametros, array (
		CURLOPT_PROXY => $proxy_addr,
		CURLOPT_PROXYPORT => $proxy_port,
		CURLOPT_COOKIEJAR => $ckfile 
) );
// $html = $curl->post($url,$parametros,array(CURLOPT_COOKIEJAR => $ckfile));
$proxima_pagina = "99";
if ($html == "") {
	$msg = "SERVIÇO INDISPONIVEL TEMPORARIAMENTE";
	$texto = "";
} else {
	$dom = str_get_html ( $html );
	$texto = $dom->plaintext;
	$proxima_pagina = $dom->find ( 'input[name=C_6]', 0 )->value;
}
$resultado = $texto;
// print_r($curl);

if (strpos ( $texto, "NAO EXISTE HISTORICO DE CONSIGNACOES PARA ESSE BENEFICIO" ) === FALSE) {
	
	while ( (strpos ( $texto, "Data Consig" ) > 0) && ($proxima_pagina != "99") ) {
		$c1 = $dom->find ( 'input[name=C_1]', 0 )->value;
		$c2 = $dom->find ( 'input[name=C_2]', 0 )->value;
		$c3 = $dom->find ( 'input[name=C_3]', 0 )->value;
		$c4 = ""; // $dom->find('input[name=C_4]',0)->value;
		$c5 = $dom->find ( 'input[name=C_5]', 0 )->value;
		$c6 = $dom->find ( 'input[name=C_6]', 0 )->value;
		$c7 = ""; // $dom->find('input[name=C_7]',0)->value;
		
		$parametros = array (
				"C_1" => $c1,
				"C_2" => $c2,
				"C_3" => $c3,
				"C_4" => $c4,
				"C_5" => $c5,
				"C_6" => $c6,
				"C_7" => $c7,
				"layout" => "8,8,2,69,10,2,1",
				"submit" => "Transmite" 
		);
		
		$html = $curl->post ( $url, $parametros, array (
				CURLOPT_PROXY => $proxy_addr,
				CURLOPT_PROXYPORT => $proxy_port,
				CURLOPT_COOKIEFILE => $ckfile,
				CURLOPT_REFERER => $url 
		) );
		// $html = $curl->post($url,$parametros, array(CURLOPT_COOKIEFILE => $ckfile ));
		// print_r($curl);
		$msg = "";
		if ($html == "") {
			$msg = "ATENCAO ESSE HISTORICO ESTÁ INCOMPLETO \r\n\r\n";
			$texto = "";
		} else {
			$dom = str_get_html ( $html );
			$texto = $dom->plaintext;
			$proxima_pagina = $dom->find ( 'input[name=C_6]', 0 )->value;
		}
		// $resultado = $resultado."\r\n\r\n--------------------------------------------------------------------------------\r\n\r\n".$texto;
		$resultado = $resultado . "\r\n" . $texto;
	}
	$html = "";
	// $html = $html.$resultado."\r\n";
	if ($msg == "") {
		$html = "<table class=\"tbGrid\">";
		$html = $html . "<thead><tr>
                <td>Banco</td>
                <td>Contrato</td>
                <td>Tipo</td>
                <td>Valor</td>
                <td>Emprestimo</td>
                <td>Situacao</td>
                <td>Prazo</td>
                <td>Inicio</td>
                <td>Final</td>
         </tr></thead>";
		
		$html2 = "<table class=\"tbGrid\">";
		$html2 = $html2 . "<thead><tr>
                <td>Banco</td>
                <td>Contrato</td>
                <td>Tipo</td>
                <td>Valor</td>
                <td>Emprestimo</td>
                <td>Situacao</td>
                <td>Prazo</td>
                <td>Inicio</td>
                <td>Final</td>
                <td>Fim do Desconto</td>
         </tr></thead>";
		
		$linhas = explode ( "\r\n", $resultado );
		$nome = substr ( $linhas [1], 254, 31 );
		foreach ( $linhas as $linha ) {
			
			$dt_consig = trim ( substr ( $linha, 336, 6 ) );
			$tipo = trim ( substr ( $linha, 354, 22 ) );
			$valor = trim ( substr ( $linha, 384, 14 ) );
			$inicio = trim ( substr ( $linha, 414, 10 ) );
			$motivo = trim ( substr ( $linha, 435, 23 ) );
			$final = trim ( substr ( $linha, 495, 10 ) );
			$situacao = trim ( substr ( $linha, 516, 22 ) );
			$competencia = trim ( substr ( $linha, 579, 6 ) );
			$prazo = trim ( substr ( $linha, 637, 2 ) );
			$emprestimo = trim ( substr ( $linha, 658, 9 ) );
			$contrato = trim ( substr ( $linha, 678, 20 ) );
			$banco = trim ( substr ( $linha, 708, 15 ) );
			$fim_desc = trim ( substr ( $linha, 793, 7 ) );
			
			// echo $nome." ".$dt_consig."<br/>";
			
			$dt_consig1 = trim ( substr ( $linha, 823, 6 ) );
			$tipo1 = trim ( substr ( $linha, 841, 22 ) );
			$valor1 = trim ( substr ( $linha, 871, 14 ) );
			$inicio1 = trim ( substr ( $linha, 901, 10 ) );
			$motivo1 = trim ( substr ( $linha, 922, 23 ) );
			$final1 = trim ( substr ( $linha, 982, 10 ) );
			$situacao1 = trim ( substr ( $linha, 1003, 22 ) );
			$competencia1 = trim ( substr ( $linha, 1066, 6 ) );
			$prazo1 = trim ( substr ( $linha, 1124, 2 ) );
			$emprestimo1 = trim ( substr ( $linha, 1145, 9 ) );
			$contrato1 = trim ( substr ( $linha, 1165, 20 ) );
			$banco1 = trim ( substr ( $linha, 1195, 15 ) );
			$fim_desc1 = trim ( substr ( $linha, 1280, 7 ) );
			
			if ($situacao == "ATIVA") {
				
				$html = $html . "<tr>
  		<td>$banco</td>
		<td>$contrato</td>
		<td>$tipo</td>
		<td>$valor</td>
		<td>$emprestimo</td>
		<td>$situacao</td>
		<td>$prazo</td>
		<td>$inicio</td>
		<td>$final</td>
         </tr>";
			} else {
				$html2 = $html2 . "<tr>
                <td>$banco</td>
                <td>$contrato</td>
                <td>$tipo</td>
                <td>$valor</td>
                <td>$emprestimo</td>
                <td>$situacao</td>
                <td>$prazo</td>
                <td>$inicio</td>
                <td>$final</td>
                <td>$fim_desc</td>
         </tr>";
			}
			
			if ($dt_consig1 != "") {
				if ($situacao1 == "ATIVA") {
					$html = $html . "<tr>
                <td>$banco1</td>
                <td>$contrato1</td>
                <td>$tipo1</td>
                <td>$valor1</td>
                <td>$emprestimo1</td>
                <td>$situacao1</td>
                <td>$prazo1</td>
                <td>$inicio1</td>
                <td>$final1</td>
         </tr>";
				} else {
					$html2 = $html2 . "<tr>
                <td>$banco1</td>
                <td>$contrato1</td>
                <td>$tipo1</td>
                <td>$valor1</td>
                <td>$emprestimo1</td>
                <td>$situacao1</td>
                <td>$prazo1</td>
                <td>$inicio1</td>
                <td>$final1</td>
                <td>$fim_desc1</td>
         </tr>";
				}
			}
		}
		
		echo "NB: $nb<br/>Nome:$nome";
		
		$html .= "</table>";
		$html2 .= "</table>";
		echo "<h1>Ativos</h1>";
		echo $html;
		echo "<h1>Inativos</h1>";
		echo $html2;
	} else {
		echo "<pre>";
		echo $msg;
		echo "</pre>";
	}
} else {
	echo "NAO EXISTE HISTORICO DE CONSIGNACOES PARA ESSE BENEFICIO";
}
?>
</body>
</html>
