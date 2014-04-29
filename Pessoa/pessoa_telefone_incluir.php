<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );

$ddd = $_REQUEST ['ddd'];
$cpf = $_REQUEST ['cpf'];
$telefone = $_REQUEST ['telefone'];

$cpf = str_replace ( ".", "", $cpf );
$cpf = str_replace ( "-", "", $cpf );

$telefone = str_replace ( ".", "", $telefone );
$telefone = str_replace ( "-", "", $telefone );

$query = "INSERT INTO Pessoa_Telefone VALUES ($cpf,$ddd,$telefone)";

consulta ( 'athenas', $query );
?>