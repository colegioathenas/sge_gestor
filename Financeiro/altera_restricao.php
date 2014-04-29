<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include ("../geral.php");

$cpf = $_REQUEST ['cpf'];
$bBloqueado = $_REQUEST ['situacao'];
$query = "UPDATE consulta_scpc set bbloqueado = $bBloqueado where nCPF = $cpf;";

$registros = consulta ( 'athenas', $query );

if ($bBloqueado) {
	echo "CPF Bloqueado";
} else {
	echo "CPF Liberado";
}
?>
