<?php
include ("../verifica_logado.php");

require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 1 );
$cpf = $_SESSION ['cpf'];
$acordo = $_REQUEST ['acordo'];
$query = "UPDATE acordo set nCdStatus = 2 where nCdAcordo = $acordo";
consulta ( "athenas", $query );

$query = "Select * from acordo where nCdAcordo = $acordo";
$resultado = consulta ( "athenas", $query );

$desconto = $resultado [0] ['nVlrDesconto'];

$query = "Select acordo_referencia.*,titulos.nNossoNumero from acordo_referencia inner join titulos on titulos.nCdBoleto = acordo_referencia.nCdBoleto where acordo_referencia.nCdAcordo = $acordo";
$resultado = consulta ( "athenas", $query );

foreach ( $resultado as $boleto ) {
	$nosso_numero = $boleto ['nNossoNumero'];
	$query = "call baixar_titulo('$nosso_numero',CURDATE(),0,0,0,0,0,0,0,null,null,99,99,99,'98',$acordo)";
	consulta ( "athenas", $query );
}

$query = "Select * from acordo_fluxo_pgto where nCdAcordo = $acordo and nCdEspecie = 3";
$resultado = consulta ( "athenas", $query );

$nrBol = 0;
$qtdBol = count ( $resultado );
foreach ( $resultado as $boleto ) {
	
	$vlrTitulo = floatval ( $boleto ['nVlrPagamento'] ) + floatval ( $desconto / $qtdBol );
	$nrBol ++;
	$SeuNum = "7" . str_pad ( $acordo, 6, "0", STR_PAD_LEFT ) . "2013" . str_pad ( $nrBol, 2, "0", STR_PAD_LEFT ) . str_pad ( $qtdBol, 2, "0", STR_PAD_LEFT );
	$dVctoSql = date ( 'Y-m-d', strtotime ( $boleto ['dPagamento'] ) );
	$dVcto = date ( 'd/m/Y', strtotime ( $boleto ['dPagamento'] ) );
	$dEmissao = date ( 'Y-m-d' );
	
	$nVlrDescontoSql = floatval ( $desconto / $qtdBol );
	$nVlrMultaSql = $vlrTitulo * 0.02;
	$nVlrJurosSql = $vlrTitulo * 0.0033;
	
	$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
	$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
	$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
	
	$cMensagem1 = "- MULTA DE  		R$   $nVlrMulta APOS $dVcto";
	$cMensagem2 = "- JUROS DE  		R$   $nVlrJuros AO DIA";
	$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATE $dVcto";
	$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
	$cMensagem5 = "REF: Acordo " . str_pad ( $acordo, 6, "0", STR_PAD_LEFT ) . "2013 " . str_pad ( $$nrBol, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $qtdBol, 2, "0", STR_PAD_LEFT );
	
	$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
		, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
		VALUES ('$cpf','$SeuNum','$dVctoSql','$dEmissao','$vlrTitulo','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
		,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5')";
	
	echo $query . "<br/>";
	consulta ( "athenas", $query );
}

$query = "SELECT * FROM Titulos where nCdPessoa = $cpf and nNossoNumero is null";
$resultado = consulta ( 'athenas', $query );
foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	// echo $nCdBoleto." - ".$nosso_numero."<br/>";
	consulta ( 'athenas', $query );
}

grava_comunicacao ( $cpf, $_SESSION ['nCdUsuario'], 2, "Acordo $acordo aprovado. Detalhes <a href=\"../Cobranca/acordo_detalhe.php?acordo=$acordo\"><u>clique aqui</u></a>" );

?>