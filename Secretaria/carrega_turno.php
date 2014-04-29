<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
$nCdCurso = $_REQUEST ['curso'];

$query = "call lista_turnos_matricula($nCdCurso)";
$turnos = consulta ( 'athenas', $query );
echo "<option value='0'>Selecione</option>";
foreach ( $turnos as $turno ) {
	if ($turno ['nVagas'] > 0) {
		$anuidade = $turno ['nVlrCurso'];
		$material = $turno ['nVlrMaterial'];
		$desconto = $turno ['nDesconto'];
		echo "<option value='" . $turno ['nCdTurma'] . "' vlr_anuidade='$anuidade' vlr_material='$material' vlr_desconto='$desconto'>" . $turno ['cTurnoDescr'] . "</option>";
	}
}

?>