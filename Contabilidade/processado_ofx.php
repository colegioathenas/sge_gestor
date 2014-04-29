<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
include "../geral.php";
require ("../config.php");
include_once "../bd.php";

session_start ();
$arquivo = $_REQUEST ['nome_arquivo'];
$nCdConta = $_REQUEST ['nCdConta'];
$data = ofxToxml ( $arquivo );
$xml = simplexml_load_string ( $data );

$trans = $xml->BANKMSGSRSV1->STMTTRNRS->STMTRS->BANKTRANLIST->STMTTRN;
$nrconta = $xml->BANKMSGSRSV1->STMTTRNRS->STMTRS->BANKACCTFROM->ACCTID;
$nrbanco = $xml->BANKMSGSRSV1->STMTTRNRS->STMTRS->BANKACCTFROM->BANKID;
foreach ( $trans as $tran ) {
	$trandate = trim ( $tran->DTPOSTED );
	$tdate = date ( "Y-m-d", strtotime ( substr ( $trandate, 0, 8 ) ) );
	$tranamt = $tran->MEMO;
	$trancrdr = $tran->FITID;
	$TRNAMT = $tran->TRNAMT;
	
	$cIdBanco = trim ( $trancrdr );
	$dLancamento = trim ( $tdate );
	$cDescricao = trim ( $tranamt );
	$nValor = floatval ( trim ( $TRNAMT ) );
	
	$query = "call importar_lancamento($nCdConta,'$cIdBanco','$dLancamento','$cDescricao',$nValor)";
	consulta ( "athenas", $query );
	
	echo $query . "<br/>";
}

?>
