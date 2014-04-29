<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
session_start ();

$cpf = $_REQUEST ['cpf'];
$nome = $_REQUEST ['nome'];
$cep = $_REQUEST ['cep'];
$cep = str_replace ( "-", "", $cep );
$endereco = $_REQUEST ['endereco'];
$complemento = $_REQUEST ['endereco_complemento'];
$bairro = $_REQUEST ['bairro'];
$cidade = $_REQUEST ['cidade'];
$uf = $_REQUEST ['uf'];
$rg = $_REQUEST ['rg'];

$nCdUsuario = $_SESSION ['nCdUsuario'];

$boletos = $_REQUEST ['boletos'];
$pagamentos = $_REQUEST ['fluxo_pgto'];
$valor_divida = $_REQUEST ['vlrDivida'];
$valor_divida = str_replace ( ".", "", $valor_divida );
$valor_divida = str_replace ( ",", ".", $valor_divida );
$vlrDesconto = $_REQUEST ['vlrDesconto'];
$vlrDesconto = str_replace ( ".", "", $vlrDesconto );
$vlrDesconto = str_replace ( ",", ".", $vlrDesconto );

$query = "call atualiza_pessoa($cpf,'$nome','$endereco',null,null,$cep
	,'$cidade','$bairro','$uf','$rg')";

consulta ( 'athenas', $query );

$query = "call acordo_inclui($cpf,$nCdUsuario,$valor_divida,$vlrDesconto)";
$resultado = consulta ( 'athenas', $query );

$nCdAcordo = $resultado [0] ['codigo'];

$pagamentos = explode ( "|", $pagamentos, - 1 );

foreach ( $pagamentos as $pagamento ) {
	
	$pgto = explode ( ";", $pagamento );
	
	list ( $dia, $mes, $ano ) = explode ( "/", $pgto [0] );
	$dataSql = "$ano-$mes-$dia";
	$valor = $pgto [1];
	$valor = str_replace ( ".", "", $valor );
	$valor = str_replace ( ",", ".", $valor );
	$tpPgtoStr = $pgto [2];
	switch ($tpPgtoStr) {
		case "Especie" :
			$tpPgtoCod = 1;
			break;
		case "Cheque" :
			$tpPgtoCod = 2;
			break;
		case "Boleto" :
			$tpPgtoCod = 3;
			break;
	}
	$query = "insert into acordo_fluxo_pgto (nCdAcordo,dPagamento,nVlrPagamento,nCdEspecie) values ($nCdAcordo,'$dataSql',$valor,$tpPgtoCod);";
	consulta ( 'athenas', $query );
}

$boletos = explode ( ",", $boletos, - 1 );
foreach ( $boletos as $boleto ) {
	
	$nCdBoleto = substr ( $boleto, - 10 );
	$nCdBoleto = substr ( $nCdBoleto, 0, 9 );
	$referencia = $_REQUEST ['obs' . $boleto];
	$query = "insert into acordo_referencia (nCdAcordo,nCdBoleto,cReferencia) values ($nCdAcordo,$nCdBoleto,'$referencia');";
	consulta ( 'athenas', $query );
}
grava_comunicacao ( $cpf, $_SESSION ['nCdUsuario'], 1, "Realizada proposta de acordo. Para acessar <a href=\"../Cobranca/acordo_detalhe.php?acordo=$nCdAcordo\"><u>clique aqui</u></a>" );
header ( "location:acordo_detalhe.php?acordo=" . $nCdAcordo );
?>