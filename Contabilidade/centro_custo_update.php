<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$acao = $_REQUEST ['acao'];

if ($acao == "centro_custo") {
	
	$codigo = $_REQUEST ['codigo'];
	$nome = $_REQUEST ['nome'];
	$inicio = $_REQUEST ['inicio'];
	$fim = $_REQUEST ['fim'];
	
	$codigo = $codigo == "" ? 0 : $codigo;
	
	list ( $diaIni, $mesIni, $anoIni ) = explode ( "/", $inicio );
	list ( $diaFim, $mesFim, $anoFim ) = explode ( "/", $fim );
	
	$dInicioSQL = "'$anoIni-$mesIni-$diaIni'";
	$dFimSQL = "'$anoFim-$mesFim-$diaFim'";
	
	$query = "call centro_custo_update($codigo, '$nome', $dInicioSQL, $dFimSQL);";
	
	$registro = consulta ( 'athenas', $query );
	
	echo $registro [0] ['codigo'];
}

if ($acao == "centro_custo_turma") {
	
	$ccusto = $_REQUEST ['ccusto'];
	$turma = $_REQUEST ['turma'];
	$valor = $_REQUEST ['valor'];
	$estado = $_REQUEST ['estado'];
	
	if (($estado == "E") && ($valor == "1")) {
		$query = "delete from centro_custo_turma where nCdCCusto = $ccusto and nCdTurma = $turma";
	}
	
	if (($estado == "I") && ($valor == "0")) {
		$query = "insert into centro_custo_turma values ($ccusto,$turma);";
	}
	
	echo $query;
	consulta ( 'athenas', $query );
}
?>
