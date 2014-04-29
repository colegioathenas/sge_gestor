<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
ini_set ( "display_errors", 0 );

$boletos = $_REQUEST ['boletos'];
$cpf = $_REQUEST ['cpf'];

$boletos = explode ( ",", $boletos );

foreach ( $boletos as $boleto ) {
	
	$vlrTitulo = $_REQUEST ['vl' . $boleto];
	$vcto = $_REQUEST ['dt' . $boleto];
	$vlrDesconto = $_REQUEST ['ds' . $boleto];
	
	$vlrTitulo = str_replace ( ".", "", $vlrTitulo );
	$vlrTitulo = str_replace ( ",", ".", $vlrTitulo );
	
	$vlrDesconto = str_replace ( ".", "", $vlrDesconto );
	$vlrDesconto = str_replace ( ",", ".", $vlrDesconto );
	
	list ( $dia, $mes, $ano ) = explode ( "/", $vcto );
	$vctoSql = "$ano-$mes-$dia";
	
	$multa = $vlrTitulo * 0.02;
	$juros = $vlrTitulo * 0.00033;
	
	$query = "UPDATE titulos 
				     SET nVlrTitulo = $vlrTitulo
				      , dVcto = '$vctoSql'
				      , dDesconto	= '$vctoSql'
				      , dMulta		= '$vctoSql'
				      , dDesconto   = '$vctoSql'
				      , nVlrMulta	= $multa
				      , nVlrJuros   = $juros
				      , nVlrDesconto = $vlrDesconto
				      , cMensagem1  = '- MULTA DE  		R$:   " . number_format ( $multa, 2, ",", "." ) . " APÓS $vcto'
				      , cMensagem2  = '- JUROS DE  		R$:   " . number_format ( $juros, 2, ",", "." ) . " AO DIA'
				      , cMensagem3  = '- DESCONTO DE    R$    " . number_format ( $vlrDesconto, 2, ",", "." ) . " ATÉ $vcto'
				  WHERE nNossoNumero = $boleto;";
	
	consulta ( "athenas", $query );
	
	header ( "location:../Pessoa/cadastro.php?cpf=$cpf&msg=AJBOLOK" );
}

?>