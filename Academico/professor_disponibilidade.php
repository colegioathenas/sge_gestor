<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

$cpf = ereg_replace ( "[^0-9]", "", $_REQUEST ['cpf'] );

$query = "select * from professor_disponibilidade where nCPF = $cpf and dFim >= CURDATE()";
$registros = consulta ( "athenas", $query );
?>
<table id="tbProfessorDisponibilidade">
<?php
$total = 0;
foreach ( $registros as $registro ) {
	$codigo = $registro ['nCdDisponibilidade'];
	$inicio = date ( "d/m/Y", strtotime ( $registro ['dInicio'] ) );
	$fim = date ( "d/m/Y", strtotime ( $registro ['dFim'] ) );
	$turno = $registro ['cTurno'];
	switch ($turno) {
		case 'M' :
			$turnoStr = 'Manha';
			break;
		case 'T' :
			$turnoStr = 'Tarde';
			break;
		case 'N' :
			$turnoStr = 'Noite';
			break;
	}
	$Seg = date ( "H:i", strtotime ( $registro ['tSegInicio'] ) ) . " - " . date ( "H:i", strtotime ( $registro ['tSegFim'] ) );
	$Ter = date ( "H:i", strtotime ( $registro ['tTerInicio'] ) ) . " - " . date ( "H:i", strtotime ( $registro ['tTerFim'] ) );
	$Qua = date ( "H:i", strtotime ( $registro ['tQuaInicio'] ) ) . " - " . date ( "H:i", strtotime ( $registro ['tQuaFim'] ) );
	$Qui = date ( "H:i", strtotime ( $registro ['tQuiInicio'] ) ) . " - " . date ( "H:i", strtotime ( $registro ['tQuiFim'] ) );
	$Sex = date ( "H:i", strtotime ( $registro ['tSexInicio'] ) ) . " - " . date ( "H:i", strtotime ( $registro ['tSexFim'] ) );
	
	if (($registro ['bDiasPares'] == true) and ($registro ['bDiasImpares'] == true)) {
		$obs = "";
	} else {
		if ($registro ['bDiasPares'] == true) {
			$obs = 'Somente Dias Pares';
		}
		if ($registro ['bDiasImpares'] == true) {
			$obs = 'Somente Dias Impares';
		}
	}
	
	echo "<tr>";
	echo "<td  width='20px'><img src='../image/remove_icon.png' name='disponibilidade_remover' url='professor_disponibilidade_remover.php?disponibilidade_codigo=$codigo' height='15px' title='Excluir Disponibilidade'/></td>
			  <td width='150px' valing='top'>$inicio</td>
			  <td width='150px' valing='top'>$fim</td>
			  <td width='50px' valing='top'>$turnoStr</td>
			  <td width='100px' valing='top'>$Seg</td>
			  <td width='100px' valing='top'>$Ter</td>
			  <td width='100px' valing='top'>$Qua</td>
			  <td width='100px' valing='top'>$Qui</td>
			  <td width='100px' valing='top'>$Sex</td>
			  <td width='250px' valing='top'>$obs</td>
			  <td><input type='hidden' name='action_disponibilidade' value='' codigo='$codigo' /></td>";
	echo "</tr>";
}

?>
</table>