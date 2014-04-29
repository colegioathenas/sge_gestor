<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");

require ("../config.php");
include_once "../bd.php";

$serie = $_REQUEST ['serie'];

$query = "Select distinct aluno_mat,aluno_nome,CASE WHEN nRM IS NULL THEN 'Rematricula' ELSE 'Matricula' END as matricula,cNmTurma,cNmCurso
				from matriculado 
					 left join rm on aluno_mat = nRM
					 inner join turma on nCdCurso = serie and turma.cTurno = 'M'
					 inner join cursos on cursos.nCdCurso = serie
			   where serie = $serie and cNmTurma like '%A%'";

$matriculados = consulta ( "athenas", $query );

$turma = $matriculados [0] ['cNmTurma'];
$curso = $matriculados [0] ['cNmCurso'];
?>
<html>
<head>
<title>Rela&ccedil;&atilde;o de Matr&iacute;culas</title>
<style>
body {
	font-family: Verdana font-size : small
}

thead {
	background-color: black;
}

thead tr {
	color: white;
}
</style>
</head>
<body>

	<h2>Rela&ccedil;&atilde;o de Matr&iacute;culas</h2>
	<p>
			
			Curso / Serie: <?php echo $curso; ?> <br />
			Turma: <?php echo $turma; ?>
		</p>

	<table width="800px">
		<thead>
			<tr>
				<td width="80px">RM</td>
				<td>Nome</td>
				<td width="180px">Matricula / Rematricula</td>
			</tr>
		</thead>
			<?php
			$i = 0;
			foreach ( $matriculados as $matriculado ) {
				$i ++;
				if ($i % 2 == 0) {
					$color = "#AAAAAA";
				} else {
					$color = "#DDDDDD";
				}
				echo "<tr bgcolor=" . $color . ">
							<td >" . str_pad ( $matriculado ['aluno_mat'], 6, "0", STR_PAD_LEFT ) . "</td>
							<td>" . $matriculado ['aluno_nome'] . "</td>
							<td>" . $matriculado ['matricula'] . "</td>
						</tr>";
			}
			?>
		</table>

</body>
</html>