<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$qtd_parc = $_REQUEST ['titulo_qtd'];
$tp_vcto = $_REQUEST ['titulo_tp_vencimento'];
$mes_inicio = substr ( $_REQUEST ['mes_inicio'], - 2 );
$ano_inicio = substr ( $_REQUEST ['mes_inicio'], 0, 4 );
$vencimento = $_REQUEST ['titulo_vencimento'];
$desconto = $_REQUEST ['titulo_desconto'];
$valor = $_REQUEST ['titulo_valor'];
$cpf = $_REQUEST ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$referencia = $_REQUEST ['ref'];
$rm = $_REQUEST ['aluno'];
$aluno = $_REQUEST ['aluno_nome'];

$valor = str_replace ( ",", ".", str_replace ( ".", "", $valor ) );
$desconto = str_replace ( ",", ".", str_replace ( ".", "", $desconto ) );

switch ($referencia) {
	case '1' :
		$referenciaStr = "Mensalidade";
		break;
	case '2' :
		$referenciaStr = "Material Didatico";
		break;
	case '3' :
		$referenciaStr = "Uniforme";
		break;
	case '4' :
		$referenciaStr = "Documentacao";
		break;
	case '5' :
		$referenciaStr = "Seguro";
		break;
	case '6' :
		$referenciaStr = "Dosimetro";
		break;
	case '7' :
		$referenciaStr = "Acordo";
		break;
	case '9' :
		$referenciaStr = "Outros";
		break;
}

for($i = 1; $i <= $qtd_parc; $i ++) {
	
	$SeuNum = $referencia . str_pad ( $rm, 6, "0", STR_PAD_LEFT ) . "2014" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $qtd_parc, 2, "0", STR_PAD_LEFT );
	if ($tp_vcto == "DU") {
		$dVctosql = date ( 'Y-m-d', fdiautil ( ($mes_inicio + $i - 1), $ano_inicio, $vencimento ) );
		$dVcto = date ( 'd/m/Y', fdiautil ( ($mes_inicio + $i - 1), $ano_inicio, $vencimento ) );
	} else {
		$dVctosql = date ( 'Y-m-d', mktime ( 0, 0, 0, $mes_inicio + $i - 1, $vencimento, $ano_inicio ) );
		$dVcto = date ( 'd/m/Y', mktime ( 0, 0, 0, $mes_inicio + $i - 1, $vencimento, $ano_inicio ) );
	}
	
	$dEmissao = date ( 'Y-m-d' );
	
	$nVlrTituloSql = $valor;
	$nVlrDescontoSql = $desconto;
	$nVlrMultaSql = $nVlrTituloSql * 0.1;
	$nVlrJurosSql = $nVlrTituloSql * 0.0033;
	
	$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
	$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
	$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
	
	$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APOS $dVcto";
	$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
	$cMensagem3 = "- DESCONTO DE  R$    $nVlrDesconto ATE $dVcto OU PROXIMO DIA UTIL";
	$cMensagem4 = "- NAO RECEBER APOS 30 DIAS DE ATRASO";
	$cMensagem5 = "- REF. $referenciaStr";
	$cMensagem6 = "- Aluno: $aluno";
	
	$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
				, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5,cMensagem6)
				VALUES ('$cpf','$SeuNum','$dVctosql','$dEmissao','$nVlrTituloSql','$nVlrJurosSql','$dVctosql','$nVlrDescontoSql'
				,'$dVctosql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5','$cMensagem6')";
	
	consulta ( "athenas", $query );
	
	// print_r($query);
}

$query = "SELECT * FROM Titulos where nCdPessoa = $cpf and nNossoNumero is null";

$resultado = consulta ( 'athenas', $query );

foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	consulta ( 'athenas', $query );
}
header ( "location:../Pessoa/cadastro.php?cpf=$cpf" );
?>
