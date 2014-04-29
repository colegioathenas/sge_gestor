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

$usuario = $_SESSION ['nCdUsuario'];
$turma = $_REQUEST ['turma'];
$disciplina = $_REQUEST ['disciplina'];

?>
		<td width='41px'>N1</td>
				<td width='41px'>N2</td>
				<td width='41px'>Media</td>
			</tr>
		</thead>
	</table>
</div>
<div style="height: 330px; overflow: scroll;">
	<table border="1">
<?php

$query = "Select aluno_mat, nNota1, nNota2, nMedia from notas where nCdTurma = $turma and nCdDisciplina = $disciplina";
$resultado = consulta ( 'athenas', $query );
$notas = array ();
foreach ( $resultado as $registro ) {
	$notas [$registro ['aluno_mat']] = $registro;
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
	$n1 = "";
	$n2 = "";
	$media = "";
	
	if (isset ( $notas [$aluno_mat] )) {
		$n1 = number_format ( $notas [$aluno_mat] ['nNota1'], 2, ",", "." );
		$n2 = number_format ( $notas [$aluno_mat] ['nNota2'], 2, ",", "." );
		$media = number_format ( $notas [$aluno_mat] ['nMedia'], 2, ",", "." );
	}
	
	echo "<tr style='background-color: $color'><td width='340px'>" . $aluno ['aluno_nome'] . "</td>
				<td><input type='text' size='4' id='nota1$aluno_mat' class='nota'  matricula='$aluno_mat' value='$n1' ></input></td>
				<td><input type='text' size='4' id='nota2$aluno_mat' class='nota' matricula='$aluno_mat' value='$n2' ></input></td>
				<td><input type='text' size='4' id='media$aluno_mat' class='media' readonly='readonly'  value='$media'></input></td>
			</tr>
			";
}
?>
</table>
</div>
