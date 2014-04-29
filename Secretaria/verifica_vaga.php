<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
ini_set ( "display_errors", 0 );

$nCdCurso = $_REQUEST ['curso'];
$cTurno = $_REQUEST ['turno'];

$query = "call verifica_vaga($nCdCurso,'$cTurno')";

$resultado = consulta ( "athenas", $query );

if ($resultado [0] ['QtdVaga'] <= 0) {
	echo "0";
} else {
	echo $resultado [0] ['QtdVaga'];
}
?>