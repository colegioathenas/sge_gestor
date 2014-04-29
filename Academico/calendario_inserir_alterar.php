<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$mes_ano = $_REQUEST ['mes_ano'];
$professor = $_REQUEST ['professor'];
$disciplina = $_REQUEST ['disciplina'];
$turma = $_REQUEST ['turma'];
$dia = $_REQUEST ['dia'];

$ano = substr ( $mes_ano, 0, 4 );
$mes = substr ( $mes_ano, - 2 );

$data_SQL = date ( 'Y-m-d', mktime ( 0, 0, 0, $mes, $dia, $ano ) );

$query = "call atualiza_calendario('$data_SQL',$professor,$disciplina,$turma)";

consulta ( 'athenas', $query );
?>