<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$mes_ano = $_REQUEST ['mes_ano'];
$valor = $_REQUEST ['valor'];
$matricula = $_REQUEST ['matricula'];
$disciplina = $_REQUEST ['disciplina'];
$turma = $_REQUEST ['turma'];
$dia = $_REQUEST ['dia'];
$aula = $_REQUEST ['aula'];

$campoaula = "aula$aula";

$ano = substr ( $mes_ano, 0, 4 );
$mes = substr ( $mes_ano, - 2 );

$data_SQL = date ( 'Y-m-d', mktime ( 0, 0, 0, $mes, $dia, $ano ) );

$query = "call presenca_update('$data_SQL','$matricula',$disciplina,$turma,$aula,$valor);";

// echo $query;

consulta ( 'athenas', $query );
?>