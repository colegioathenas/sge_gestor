<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$codigo = $_REQUEST ['codigo'];

$query = "DELETE FROM turma_divisao where nCdDivisao = '$codigo';";

consulta ( 'athenas', $query );
?>