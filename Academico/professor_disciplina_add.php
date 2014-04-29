<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$cpf = $_SESSION ['cpf'];
$cpf = str_replace ( ".", "", $cpf );
$cpf = str_replace ( "-", "", $cpf );

$codigo = $_REQUEST ['disciplina_disciplina'];

$query = "insert into professor_disciplina values ($cpf,$codigo);";

consulta ( 'athenas', $query );
?>