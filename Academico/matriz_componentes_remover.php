<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$codigo = $_REQUEST ['codigo'];

$query = "delete from matriz_disciplina where nCdComponente = $codigo";

consulta ( 'athenas', $query );
?>