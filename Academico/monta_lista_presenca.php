<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
?>

<div>
	<table border="1">
		<thead>
			<tr>
				<td width='340px'>Aluno</td>
		
<?php
$ano = substr ( $_REQUEST ['mes_ano'], 0, 4 );
$mes = substr ( $_REQUEST ['mes_ano'], - 2 );

$usuario = $_SESSION ['nCdUsuario'];
$turma = $_REQUEST ['turma'];
$disciplina = $_REQUEST ['disciplina'];

$query = "select day(dCalendario) as dia
				  	  from calendario 
				 	       inner join usuario on calendario.nCdProfessor = usuario.nCPF
				      where usuario.nCdUsuario = $usuario
				        and nCdTurma = $turma
				        and nCdDisciplina = $disciplina
				       order by dCalendario;
		  		";
$resultado = consulta ( "athenas", $query );

foreach ( $resultado as $registro ) {
	$d = $registro ['dia'];
	$data_atual = mktime ( 0, 0, 0, $mes, $d, $ano );
	
	if (date ( "N", $data_atual ) < 6) {
		
		switch (date ( "N", $data_atual )) {
			case 1 :
				$dw = "S";
				break;
			case 2 :
				$dw = "T";
				break;
			case 3 :
				$dw = "Q";
				break;
			case 4 :
				$dw = "Q";
				break;
			case 5 :
				$dw = "S";
				break;
		}
		
		$qtd_dia [] = $d;
		echo "<td width='35px'>
						<table>
							<tr><td>$dw</td></tr>
							<tr><td>$d</td></tr>
							
						</table>
					 </td>";
	}
}

?>
		
		
	</tr>
		</thead>
	</table>
</div>
<div style="height: 330px; overflow: scroll;">
	<table border="1">
<?php

$query = "Select * from faltas where nCdTurma = $turma and nCdDisciplina = $disciplina";
$resultado = consulta ( 'athenas', $query );
$faltas = array ();
foreach ( $resultado as $registro ) {
	if (count ( $faltas [$registro ['aluno_mat']] ) == 0) {
		$falta = array ();
	} else {
		
		$falta = $faltas [$registro ['aluno_mat']];
	}
	
	$falta [intval ( date ( "d", strtotime ( $registro ["dFalta"] ) ) )] = $registro;
	
	$faltas [$registro ['aluno_mat']] = $falta;
}

$query = "Select * from matriculado where nCdTurma =  $turma";
$alunos = consulta ( 'athenas', $query );
$x = 0;

foreach ( $alunos as $aluno ) {
	$x ++;
	$aluno_mat = $aluno ['aluno_mat'];
	if ($x % 2 == 0) {
		$color = '#CCCCCC';
	} else {
		$color = '#AAAAAA';
	}
	echo "<tr style='background-color: $color'><td width='340px'>" . $aluno ['aluno_nome'] . "</td>";
	foreach ( $qtd_dia as $dia ) {
		$checado1 = "";
		$checado2 = "";
		if ($faltas [$aluno ['aluno_mat']] [intval ( $dia )] ['aula1'] == '1') {
			$checado1 = " checked='checked'";
		}
		if ($faltas [$aluno ['aluno_mat']] [intval ( $dia )] ['aula2'] == '1') {
			$checado2 = " checked='checked'";
		}
		echo "<td width='35px'>
		  			<table>
		  				<tr>
		  					<td><input type='checkbox' title='" . $aluno ['aluno_nome'] . "/$dia' matricula='$aluno_mat' dia='$dia' $checado1 aula='1' /> </td>
							<td><input type='checkbox' title='" . $aluno ['aluno_nome'] . "/$dia' matricula='$aluno_mat' dia='$dia' $checado2 aula='2'/> </td>
						</tr>
					</table>	 
			</td>";
	}
	echo "</tr>";
}
?>
</table>
</div>
