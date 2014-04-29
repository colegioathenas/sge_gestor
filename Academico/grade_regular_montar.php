<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
session_start ();

$turma = $_REQUEST ['turma'];
$query = "select nCdGrade,disciplina.nCdDisciplina,cNmDisciplina,nCdPessoa, cNome ,nAula,nDiaSemana
  from grade_horario_regular grd
        inner join disciplina on disciplina.nCdDisciplina = grd.nCdDisciplina
        inner join pessoa on pessoa.nCdPessoa = grd.nCdProfessor
  where nCdTurma = $turma
order by nAula,nDiaSemana;";

$resultado = consulta ( "athenas", $query );
$max = sizeof ( $resultado );
echo "<pre>";
// print_r($resultado);
echo "</pre>";
?>
<table class="tbGrade">
	<thead>
		<tr>
			<td>Aula</td>
			<td>Segunda</td>
			<td>Terça</td>
			<td>Quarta</td>
			<td>Quinta</td>
			<td>Sexta</td>
		</tr>
	</thead>
	<tbody>
<?php
$index = 0;
for($i = 1; $i <= 7; $i ++) {
	echo "<tr>
            <td>$i</td>";
	for($j = 1; $j <= 5; $j ++) {
		/* 2i */
		echo "<td class='timetable' id='$j$i' dia='$j' aula='$i'";
		if ($index <= $max) {
			$html = " ></td>\n";
			while ( ($resultado [$index] ["nAula"] == $i) && ($resultado [$index] ["nDiaSemana"] == $j) ) {
				$html = "professor  = '" . $resultado [$index] ["nCdPessoa"] . "'
                          disciplina = '" . $resultado [$index] ["nCdDisciplina"] . "'
                          codigo     = '" . $resultado [$index] ["nCdGrade"] . "' 
                          index = $index>
                          <span style='font-size:22px'>" . $resultado [$index] ["cNmDisciplina"] . "</span>
                          <br/> " . $resultado [$index] ["cNome"] . "</td>";
				$index ++;
			}
			echo $html;
		}
	}
	
	echo "</tr>\n";
}
?>                
    </tbody>
</table>

