<?php
include ("../verifica_logado.php");
?>
<html>
<head>
<title>Boletos</title>
<STYLE>
p.quebra {
	page-break-before: always;
}
</STYLE>
</head>
<body>
<?php

require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

session_start ();

$matricula = $_SESSION ['mat'];
$nCdPessoa = $_SESSION ['responsavel_cpf'];
$nCdBoleto = $_REQUEST ['nCdBoleto'];

$nCdPessoa = str_replace ( "-", "", $nCdPessoa );
$nCdPessoa = str_replace ( ".", "", $nCdPessoa );

if ($nCdBoleto != "") {
	$nCdBoleto = split ( ";", $nCdBoleto );
	if (count ( $nCdBoleto ) == 1) {
		$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
			 Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa 
			 WHERE nNossoNumero = $nCdBoleto[0] ";
		$layout = "unico";
	} else {
		$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
			 Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa 
			 WHERE nNossoNumero IN (";
		foreach ( $nCdBoleto as $nnum ) {
			if ($nnum != "") {
				$query .= "'$nnum',";
			}
		}
		
		$query = substr ( $query, 0, strlen ( $query ) - 1 ) . ")  order by dVcto";
		$layout = "multiplo";
	}
} else {
	
	$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
			 Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa 
			 WHERE Titulos.nCdPessoa = $nCdPessoa and Titulos.SeuNum like '%" . $matricula . "2013%' order by dVcto";
	$layout = "multiplo";
}

$resultado = consulta ( "athenas", $query );

$curl = curl_init ( 'http://sge_gestor/Boleto/boleto_cef.php' );
// echo"<pre>";
// print_r($resultado);
// echo"</pre>";

curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );

$html = "";

$i = 0;

$qtd_bol = count ( $resultado );
$pos = 3;
$i = 1;
$qtdQ = ceil ( $qtd_bol / 3 );
$Q = 0;
$reg = 2 * $qtdQ;

for($nBol = 0; $nBol <= $qtd_bol; $nBol ++) {
	$pos = $pos + 1;
	if ($pos > 3) {
		$pos = 1;
		$reg = $reg - (2 * $qtdQ - 1);
	} else {
		$reg = $reg + $qtdQ;
	}
	
	if ($reg <= $qtd_bol) {
		
		$registro = $resultado [$reg - 1];
		
		$vencimento = $registro ['dVcto'];
		$vencimento = substr ( $vencimento, 0, 10 );
		$vencimento = explode ( "-", $vencimento );
		
		$dados = array (
				
				'codigoboleto' => $registro ['nCdBoleto'],
				'nossonumero' => $registro ['nNossoNumero'],
				'numero_documento' => $registro ['SeuNum'],
				'valor_cobrado' => $registro ['nVlrTitulo'],
				'data_venc' => $vencimento [2] . "/" . $vencimento [1] . "/" . $vencimento [0],
				'desconto' => $registro ['nVlrDesconto'],
				'sacado' => $registro ['cNome'],
				'endereco1' => $registro ['cLogradouro'] . " - " . $registro ['cComplemento'] . " - " . $registro ['cBairro'],
				'endereco2' => $registro ['cCidade'] . " - " . $registro ['cUF'] . " - " . $registro ['nCEP'],
				'msg1' => $registro ['cMensagem1'],
				'msg2' => $registro ['cMensagem2'],
				'msg3' => $registro ['cMensagem3'],
				'msg4' => $registro ['cMensagem4'],
				'msg5' => $registro ['cMensagem5'],
				'msg6' => $registro ['cMensagem6'],
				'layout' => $layout 
		);
		
		// Iremos usar o método POST
		curl_setopt ( $curl, CURLOPT_POST, true );
		// Definimos quais informações serão enviadas pelo POST (array)
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, $dados );
		
		$result = curl_exec ( $curl );
		
		// "$i = > reg = ". $reg ." pos = $pos <br/>"
		
		$html .= $result;
		
		$html .= '<br/><br/><img height="1" src="imagens/6.png" width="870" border="0" /><br/><br/>';
	}
	if (floatval ( $i ) % 3 == 0) {
		$html .= "<p class=\"quebra\" />";
	}
	
	$i ++;
}

curl_close ( $curl );
// nossonumero
// valor
// vencimento
// documento

echo $html;

?>
</body>