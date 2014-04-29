<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

$nosso_numero = $_REQUEST ['nossonumero'];
$movimento = $_REQUEST ['dt_movimento'];

$query = "SELECT cNome, titulos.* FROM titulos inner join Pessoa on titulos.nCdPessoa = Pessoa.nCdPessoa where nNossoNumero = '$nosso_numero'";

$resultado = consulta ( "athenas", $query );

if ($resultado [0] ['nNossoNumero'] != "") {
	
	$retorno = array ();
	
	$nome = $resultado [0] ['cNome'];
	$seu_num = $resultado [0] ['SeuNum'];
	$vcto = $resultado [0] ['dVcto'];
	$valor = $resultado [0] ['nVlrTitulo'];
	$desconto = $resultado [0] ['nVlrDesconto'];
	$multa = $resultado [0] ['nVlrMulta'];
	$juros = $resultado [0] ['nVlrJuros'];
	
	list ( $dia1, $mes1, $ano1 ) = split ( '/', date ( "d/m/Y", strtotime ( $vcto ) ) );
	list ( $dia2, $mes2, $ano2 ) = split ( '/', $movimento );
	
	$timestamp1 = mktime ( 0, 0, 0, $mes1, $dia1, $ano1 );
	$timestamp2 = mktime ( 0, 0, 0, $mes2, $dia2, $ano2 );
	
	$segundos_diferenca = $timestamp2 - $timestamp1;
	
	$dias_diferenca = $segundos_diferenca / (60 * 60 * 24);
	
	if ($dias_diferenca <= 0) {
		$multa = 0;
		$juros = 0;
	} else {
		$desconto = 0;
		$juros = $juros * $dias_diferenca;
	}
	
	$total = $valor - $desconto + $multa + $juros;
	
	$retorno = array (
			"nome" => $nome,
			"seu_num" => $seu_num,
			"vcto" => date ( "d/m/Y", strtotime ( $vcto ) ),
			"valor" => number_format ( $valor, 2, ",", "." ),
			"desconto" => number_format ( $desconto, 2, ",", "." ),
			"multa" => number_format ( $multa, 2, ",", "." ),
			"juros" => number_format ( $juros, 2, ",", "." ),
			"total" => number_format ( $total, 2, ",", "." ) 
	);
}

echo json_encode ( $retorno );

?>