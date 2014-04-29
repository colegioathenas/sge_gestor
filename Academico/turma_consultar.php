<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT turma.*,cursos.cNmCurso 
                    FROM turma 
                         inner join cursos on cursos.nCdCurso = turma.nCdCurso 
                   WHERE cNmTurma like '%$value%' or nCdTurma = '$value'
                 ORDER BY dFim DESC, cNmTurma;";

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td></td>

			<td>Nome</td>
			<td>Curso</td>
		</tr>
	</thead>
	
<?php
$i = 0;
foreach ( $registros as $registro ) {
	$i ++;
	if ($i % 2 == 0) {
		$color = 'white';
	} else {
		$color = 'gray';
	}
	$codigo = $registro ['nCdTurma'];
	$nome = $registro ['cNmTurma'];
	$curso = $registro ['cNmCurso'];
	
	echo "<tr>";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' codigo='$codigo' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td width='150px'><a href='turma_cadastro.php?codigo=$codigo'>Acessar</a>
					  &nbsp;
				      <a href='#' name='turma_duplicar' codigo='$codigo'  >Duplicar</a>
			      </td>";
	}
	
	echo "<td>$nome</td>";
	echo "<td>$curso</td>";
	echo "</tr>";
}

?>

</table>