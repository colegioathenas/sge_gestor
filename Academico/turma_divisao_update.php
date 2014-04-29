<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include '../geral.php';

$turma = $_REQUEST ['turma'];
$codigo = $_REQUEST ['codigo'];
$nome = $_REQUEST ['nome'];
$inicio = $_REQUEST ['inicio'];
$fim = $_REQUEST ['fim'];
$inicioLcto = $_REQUEST ['inicioLcto'];
$fimLcto = $_REQUEST ['fimLcto'];
$formula = $_REQUEST ['formula'];
$notas = getRequest ( 'notas', "0" );
$diario = getRequest ( 'diario', "0" );
$frequencia = getRequest ( 'frequencia', "0" );
$imprimeFalta = getRequest ( 'imprimeFalta', "0" );
$formulaFalta = $_REQUEST ['formulaFalta'];

list ( $diaI, $mesI, $anoI ) = explode ( "/", $inicio );
$inicioSQL = "$anoI-$mesI-$diaI";

list ( $dia, $mes, $ano ) = explode ( "/", $fim );
$fimSQL = "$ano-$mes-$dia";

list ( $diaIL, $mesIL, $anoIL ) = explode ( "/", $inicioLcto );
$inicioLctoSQL = "$anoIL-$mesIL-$diaIL";

list ( $diaFL, $mesFL, $anoFL ) = explode ( "/", $fimLcto );
$fimLctoSQL = "$anoFL-$mesFL-$diaFL";

$query = "call turma_divisao_update($codigo,$turma,'$nome','$inicioLctoSQL','$fimLctoSQL','$inicioSQL','$fimSQL','$formula',$notas,$diario,$frequencia,$imprimeFalta,'$formulaFalta')";
print_r ( $query );
consulta ( 'athenas', $query );
?>


