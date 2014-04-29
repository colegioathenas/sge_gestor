<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$codigo = $_REQUEST ["codigo"];
$matriz = $_REQUEST ["matriz"];
$disciplina = $_REQUEST ["disciplina"];
$chtp = $_REQUEST ["chtp"];
$che = $_REQUEST ["che"];
$modulo = $_REQUEST ["modulo"];

if ($chtp == "") {
	$chtp = "null";
}
if ($che == "") {
	$che = "null";
}

$query = "call matriz_disciplina_update($codigo,$matriz,$disciplina,$chtp,$che,$modulo)";

consulta ( 'athenas', $query );
?>
