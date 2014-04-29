<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$codigo = $_REQUEST ["codigo"];
$turma = $_REQUEST ["turma"];
$dia = $_REQUEST ["dia"];
$aula = $_REQUEST ["aula"];
$professor = $_REQUEST ["professor"];
$disciplina = $_REQUEST ["disciplina"];

if ($codigo == "") {
	$codigo = "0";
}

$query = "call grade_horario_regular_update($codigo,$turma,$dia,$aula,$professor,$disciplina)";

$resultado = consulta ( 'athenas', $query );

echo $resultado [0] ['codigo'];

?>