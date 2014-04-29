<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );

$turma = $_REQUEST ['turma'];

$query = " select distinct disciplina.nCdDisciplina, disciplina.cNmDisciplina
 			     from matriz_disciplina 
	   				  inner join turma on matriz_disciplina.nCdMatriz = turma.nCdMatriz
	   				  inner join disciplina on matriz_disciplina.nCdDisciplina = disciplina.nCdDisciplina
				where ncdturma = $turma
				order by disciplina.cNmDisciplina";

$disciplinas = consulta ( 'athenas', $query );

$query = "Select nCPF,cNome from Professor inner join Pessoa on Pessoa.nCdPessoa = Professor.nCPF";
$professores = consulta ( 'athenas', $query );

$html_disciplina = "<select><option value='0'>Selecione</option>";
foreach ( $disciplinas as $disciplina ) {
	$codigo = $disciplina ['nCdDisciplina'];
	$nome = $disciplina ['cNmDisciplina'];
	$html_disciplina .= "<option value='$codigo'>$nome</option>";
}
$html_disciplina .= "</select>";

$html_professor = "<select><option value='0'>Selecione</option>";
$html_professor .= "</select>";

?>
<table border="1">
	<thead>
		<tr>

			<td width='200px'>Segunda</td>
			<td width='200px'>Terca</td>
			<td width='200px'>Quarta</td>
			<td width='200px'>Quinta</td>
			<td width='200px'>Sexta</td>

		</tr>
	</thead>
 <?php
	$ano = substr ( $_REQUEST ['mes_ano'], 0, 4 );
	$mes = substr ( $_REQUEST ['mes_ano'], - 2 );
	
	$primeiro_dia = mktime ( 0, 0, 0, $mes, 1, $ano );
	$dw = date ( "N", $primeiro_dia );
	
	$semana_anterior = date ( "W", $primeiro_dia );
	
	$ultimo_dia = date ( "t", $primeiro_dia );
	
	$dia_inicial = 0;
	
	$query = "Select DAY(dCalendario) as dia, turma.cTurno
						 ,  nCdProfessor
						 , nCdDisciplina 
						 , turma.nCdTurma
		  			  from Calendario 
		  			  	   inner join turma on turma.nCdturma = Calendario.nCdTurma
		  			 where Calendario.nCdTurma = $turma 
		  			   and MONTH(dCalendario) = $mes 
		  			   and YEAR(dCalendario) = $ano";
	
	$calendario = consulta ( "athenas", $query );
	
	$calendarioBD = array ();
	foreach ( $calendario as $cal ) {
		
		$data = date ( 'Y-m-d', mktime ( 0, 0, 0, $mes, $cal ['dia'], $ano ) );
		;
		
		$par = 0;
		$impar = 0;
		if ($cal ['dia'] % 2 == 0) {
			$par = 1;
		} else {
			$impar = 1;
		}
		
		$query = "call calendario_carrega_professor ( '$data',$par,$impar," . $cal ['nCdDisciplina'] . "," . $cal ['nCdTurma'] . ",'" . $cal ['cTurno'] . "')";
		
		$resultado_sql = consulta ( 'athenas', $query );
		
		$disponibilidade = "<select><option value='0' width='200px'>Selecione</option>";
		foreach ( $resultado_sql as $registro ) {
			$disponibilidade .= "<option value='" . $registro ['nCPF'] . "'>" . $registro ['cNome'] . "</option>";
		}
		$disponibilidade .= "</select>";
		$cal ['disponibilidade'] = $disponibilidade;
		$calendarioBD [$cal ['dia']] = $cal;
	}
	
	echo "<tr>";
	do {
		$dia_inicial ++;
		$dw_inicial = date ( "N", mktime ( 0, 0, 0, $mes, $dia_inicial, $ano ) );
	} while ( $dw_inicial >= 6 );
	
	for($vazio = 1; $vazio < $dw_inicial; $vazio ++) {
		echo "<td></td>";
	}
	
	for($d = $dia_inicial; $d <= $ultimo_dia; $d ++) {
		$data_atual = mktime ( 0, 0, 0, $mes, $d, $ano );
		
		if (date ( "N", $data_atual ) < 6) {
			if ($semana_anterior != date ( "W", $data_atual )) {
				echo "</tr><tr>";
				$semana_anterior = date ( "W", $data_atual );
			}
			$profSelect = "";
			$discSelect = "";
			
			if (isset ( $calendarioBD [$d] )) {
				$profSelect = $calendarioBD [$d] ['nCdProfessor'];
				$discSelect = $calendarioBD [$d] ['nCdDisciplina'];
				
				$cmb_professor = $calendarioBD [$d] ['disponibilidade'];
				$cmb_professor = str_replace ( "<select>", "<select id='professor$d'  class='cmbProfessor'  dia='$d'>", $cmb_professor );
			} else {
				$cmb_professor = str_replace ( "<select>", "<select id='professor$d'  class='cmbProfessor'  dia='$d'>", $html_professor );
			}
			$cmb_disciplina = str_replace ( "<select>", "<select id='disciplina$d' class='cmbDisciplina' dia='$d'>", $html_disciplina );
			
			echo "<td>
						<table>
							<tr><td align='right'><span style='font-size:x-small'>$d</span></td></tr>
							<tr><td>" . str_replace ( "<option value='$discSelect'>", "<option value='$discSelect' selected='selected'>", $cmb_disciplina ) . "</td></tr>
							<tr><td>" . str_replace ( "<option value='$profSelect'>", "<option value='$profSelect' selected='selected'>", $cmb_professor ) . "</td></tr>
						</table>
					 </td>";
		}
	}
	
	echo "</tr>";
	
	?>
</table>
