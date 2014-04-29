<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
require_once ('../Util/html2pdf/html2pdf.class.php');
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );

$matricula = $_REQUEST ['matricula'];

$query = "CALL getDadosContratoServEduc($matricula);";
$resultado = consulta ( "athenas", $query );
$registro = $resultado [0];
switch ($registro ['cTurno']) {
	case "M" :
		$registro ['cTurnoStr'] = "MANHÃ";
		break;
	case "T" :
		$registro ['cTurnoStr'] = "TARDE";
		break;
	case "N" :
		$registro ['cTurnoStr'] = "NOITE";
		break;
}

$registro ['cInicioLetivo'] = strftime ( "%B de %Y", strtotime ( $registro ['dInicio'] ) );
$registro ['cFimLetivo'] = strftime ( "%B de %Y", strtotime ( $registro ['dFim'] ) );

$_SESSION ['dados_contrato'] = $registro;

if ($registro ['cTpCurso'] == "R") {
	header ( "location:contrato_regular.php" );
}
if ($registro ['cTpCurso'] == "T") {
	header ( "location:contrato_tecnico.php" );
}
/*
 * if ($registro[0]['cTpCurso'] == "D"){ header("location:contrato_dependencia.php"); }
 */

?>