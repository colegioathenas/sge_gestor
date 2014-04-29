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

$codigo = $_REQUEST ['disponibilidade_codigo'];

$query = "delete from professor_disponibilidade where nCdDisponibilidade = $codigo;";

echo $query;

consulta ( 'athenas', $query );
?>