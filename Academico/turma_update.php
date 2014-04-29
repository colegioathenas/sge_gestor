<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include '../geral.php';

$turma = getRequest ( "turma", 0 );
$curso = getRequest ( "curso", 0 );
$nome = getRequest ( "nome", "" );
$turno = getRequest ( "turno", "" );
$vagas = getRequest ( "vagas", 0 );
$inicio = getRequest ( "inicio", "null" );
$fim = getRequest ( "fim", "null" );
$matriz = getRequest ( "matriz", 0 );
$matriculasAbertas = getRequest ( "matriculasAbertas", 0 );
$valorSql = getRequest ( "valor", 0 );
$valorMatSQL = getRequest ( "valorMat", 0 );
$vcto1 = getRequest ( "vcto1", "" );
$prazo = getRequest ( "prazo", 0 );
$prazoMat = getRequest ( "prazoMat", 0 );
$ultvcto = getRequest ( "ultvcto", 0 );

list ( $diaI, $mesI, $anoI ) = explode ( "/", $inicio );
$inicioSql = "$anoI-$mesI-$diaI";

list ( $dia, $mes, $ano ) = explode ( "/", $fim );
$fimSql = "$ano-$mes-$dia";

$query = "call turma_update( $turma
							   , $curso
							   ,'$nome'
							   ,'$turno'
							   ,$vagas
							   ,'$inicioSql'
							   ,'$fimSql'
							   ,$matriz
							   ,$matriculasAbertas
							   ,$valorSql
							   ,$valorMatSQL
							   ,$vcto1
							   ,$prazo
							   ,$prazoMat
							   ,$ultvcto)";

consulta ( "athenas", $query );
?>