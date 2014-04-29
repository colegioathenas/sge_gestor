<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
session_start ();
$boletos = $_REQUEST ['boletos'];
$cpf = $_REQUEST ['cpf'];
$recalculo = $_REQUEST ['recalculo'];

if ($cpf != "") {
	$data = $_REQUEST ['dt_vcto'];
	
	if ($data == "") {
		$data = date ( "Y-m-d" );
	} else {
		list ( $dia, $mes, $ano ) = split ( "/", $data );
		$data = "$ano-$mes-$dia";
	}
	
	$boletos = substr ( $boletos, 0, strlen ( $boletos ) - 1 );
	
	$nDias = " DATEDIFF(ADDDATE(CURDATE(), INTERVAL DATEDIFF('$data',CURDATE()) DAY),dVcto) ";
	
	$query = "SELECT COUNT(*) as qtd from titulos where nCdPessoa = $cpf and TipDtOcorrencia is null and dVcto < CURDATE() and 
			nNossoNumero not in ($boletos)";
	
	$desconto_total = 0;
	$desconto_minimo = 0;
	$resultado = consulta ( "athenas", $query );
	
	$query = "Select Sum(nVlrTitulo) as VlrTitulo, Sum(nVlrTitulo + (nVlrJuros * $nDias) + nVlrMulta) as VlrTotal from titulos where nNossoNumero  in ( $boletos ) ";
	
	$resultado_total = consulta ( "athenas", $query );
	
	$vlr_divida = $resultado_total [0] ["VlrTotal"];
	
	if ($resultado [0] ['qtd'] == 0) {
		$desconto_total = $resultado_total [0] ["VlrTotal"] - $resultado_total [0] ["VlrTitulo"];
		$desconto_minimo = $resultado_total [0] ["VlrTotal"] * 0.05;
	}
	
	if ($recalculo == "sim") {
		$result = array (
				'VlrTotal' => number_format ( $vlr_divida, 2, ",", "." ),
				'Desc1' => $desconto_total,
				'Desc2' => $desconto_minimo,
				'Vlr2' => number_format ( $vlr_divida / 2, 2, ",", "." ),
				'Vlr3' => number_format ( $vlr_divida / 3, 2, ",", "." ) 
		);
		echo json_encode ( $result );
	}
}
?>