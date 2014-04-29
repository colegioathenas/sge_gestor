<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$dInicio = $_REQUEST ['inicio'];
$dFim = $_REQUEST ['fim'];
$nCdCurso = $_REQUEST ['codigo'];

if (($dInicio != "") && ($dFim != "")) {
	
	list ( $diaIni, $mesIni, $anoIni ) = explode ( "/", $dInicio );
	list ( $diaFim, $mesFim, $anoFim ) = explode ( "/", $dFim );
	
	$dInicioSQL = "'$anoIni-$mesIni-$diaIni'";
	$dFimSQL = "'$anoFim-$mesFim-$diaFim'";
	
	$query = "select turma.*, cursos.cNmCurso   
                        from turma 
                             inner join cursos on cursos.nCdCurso = turma.nCdCurso
                       where (dInicio between $dInicioSQL and $dFimSQL) 
                          or (dFim between $dInicioSQL and $dFimSQL)
                     order by cOrdem,cNmCurso";
	
	$turmas = consulta ( "athenas", $query );
	
	$query_turmas_rateio = "select nCdTurma from centro_custo_turma where nCdCCusto = $nCdCurso";
	$registros_turmas_rateio = consulta ( "athenas", $query_turmas_rateio );
	$turmas_rateio = array ();
	foreach ( $registros_turmas_rateio as $turma_rateio ) {
		$turmas_rateio [$turma_rateio ['nCdTurma']] = "1";
	}
}
?>

<table>
    <?php
				foreach ( $turmas as $turma ) {
					$checkbox = "<input type='checkbox' estado='O' codigo='" . $turma ['nCdTurma'] . "' ";
					if ($turmas_rateio [$turma ['nCdTurma']] == "1") {
						$checkbox .= "checked='checked' valor='1' ";
					} else {
						$checkbox .= " valor='0' ";
					}
					$checkbox .= "/>";
					echo "<tr>";
					echo "<td width='30px'>$checkbox</td>";
					echo "<td>" . $turma ['cNmCurso'] . " (" . $turma ['cNmTurma'] . ")</td>";
					echo "</tr>\n";
				}
				?>
</table>