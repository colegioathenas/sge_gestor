<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 1 );
session_start ();

$matricula = $_REQUEST ['matricula'];
$disciplina = $_REQUEST ['disciplina'];
$turma = $_REQUEST ['turma'];
$nota1 = $_REQUEST ['nota1'];
$nota2 = $_REQUEST ['nota2'];

$nNota1 = str_replace ( ",", ".", $nota1 );
$nNota2 = str_replace ( ",", ".", $nota2 );

if ($nota1 != '') {
	
	if ($nota2 == "") {
		$nMedia = floatval ( $nNota1 );
		$nNota2 = "null";
	} else {
		
		$nMedia = (doubleval ( $nNota1 ) + doubleval ( $nNota2 )) / 2.0000;
		
		$nMedia = arredondar ( $nMedia );
	}
	
	$query = "call atualiza_nota('$matricula',$disciplina,$turma,$nNota1,$nNota2,$nMedia);";
	
	consulta ( 'athenas', $query );
	
	echo number_format ( $nMedia, 2, ",", "." );
}
?>