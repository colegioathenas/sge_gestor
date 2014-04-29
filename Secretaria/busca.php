<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
ini_set ( "display_errors", 0 );
header ( 'Content-Type: text/html; charset=iso-8859-1' );

$q = $_GET ['term'];
$my_data = mysql_real_escape_string ( $q );

$consulta = $_REQUEST ['consulta'];
if ($consulta == 'lista') {
	$query = "call listaNomes('%$my_data%');";
	$resultado = consulta ( "acadesc", $query );
	foreach ( $resultado as $row ) {
		$names [] .= "id:" . $row ['Classe'] . ", value:" . $row ['Nome'];
	}
	
	echo "<pre>";
	print_r ( $resultado );
	echo "</pre>";
	echo json_encode ( $names );
}
if ($consulta == 'matricula') {
	$serie = $_REQUEST ['serie'];
	$query = "call matriulados($serie,'%$my_data%');";
	$resultado = consulta ( "athenas", $query );
	foreach ( $resultado as $row ) {
		$names [] .= $row ["Nome"];
	}
	echo json_encode ( $names );
}

?>