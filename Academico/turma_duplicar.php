<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$codigo = $_REQUEST ['turma'];
$nome = $_REQUEST ['nome'];

$query_duplica_turma = "call turma_duplicar($codigo,'$nome');";
consulta ( "athenas", $query_duplica_turma );

?>