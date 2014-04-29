<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$matricula = $_REQUEST ['matricula'];
$turma = $_REQUEST ['turma'];
$status = $_REQUEST ['status'];
$chamada = $_REQUEST ['chamada'];

$query = "call matricula_transferir($matricula,$status,$turma,$chamada);";

consulta ( "athenas", $query );

?>