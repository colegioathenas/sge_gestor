<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$codigo = $_REQUEST ['codigo'];
$conteudo = $_REQUEST ['texto'];

$conteudo = str_replace ( "'", "\'", $conteudo );

$query = "update calendario set cConteudo = '$conteudo' where nCdCalendario = $codigo";

consulta ( 'athenas', $query );

echo $query;
?>