<?php
require ("config.php");
include_once "bd.php";
ini_set ( "display_errors", 0 );

$metodo = $_REQUEST ['metodo'];

if ($metodo == 'consulta') {
	$matricula = $_REQUEST ['param1'];
	$query = "Select * from Alunos where Mat = $matricula";
	$resultado = consulta ( "acadesc", $query );
	echo json_encode ( $resultado [0] );
}
if ($metodo == 'consulta_telefone') {
	$matricula = $_REQUEST ['param1'];
	$query = "Select * from DocumentosAlunos where Mat = $matricula";
	$resultado = consulta ( "acadesc", $query );
	echo json_encode ( $resultado [0] );
}
?>
