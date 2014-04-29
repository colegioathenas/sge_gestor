
<html>
<head>
<title>Boletos</title>
<STYLE>
p.quebra {
	page-break-before: always;
}
</STYLE>
<meta charset="utf-8" />
</head>
<body>
<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

$codigo = $_REQUEST ['codigo'];
$chave = $_REQUEST ['chave'];

$query = "SELECT Titulos.*, Pessoa.cNome, Pessoa.nCEP,Pessoa.cLogradouro,  Pessoa.cComplelemnto, Pessoa.cCidade,
			 Pessoa.cBairro,Pessoa.cUF FROM Titulos inner join Pessoa on Titulos.nCdPessoa = Pessoa.nCdPessoa 
			 WHERE nCdBoleto = $codigo and cID = '$chave'";

$resultado = consulta ( "athenas", $query );

$registro = $resultado [0];

$curl = curl_init ( 'http://localhost/Boleto/boleto_cef.php' );
// echo"<pre>";
// print_r($resultado);
// echo"</pre>";

curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );

$html = "";

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
		'layout' => 'unico' 
);

// Iremos usar o método POST
curl_setopt ( $curl, CURLOPT_POST, true );
// Definimos quais informações serão enviadas pelo POST (array)
curl_setopt ( $curl, CURLOPT_POSTFIELDS, $dados );

$result = curl_exec ( $curl );

// "$i = > reg = ". $reg ." pos = $pos <br/>"

$html .= $result;

$html .= '<br/><br/><img height="1" src="imagens/6.png" width="870" border="0" /><br/><br/>';

curl_close ( $curl );
// nossonumero
// valor
// vencimento
// documento

echo $html;

?>
</body>