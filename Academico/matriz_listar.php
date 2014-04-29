<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "select matriz.*,cursos.cNmCurso from matriz inner join cursos on matriz.nCdCurso = cursos.nCdCurso order by dValidade DESC";

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td></td>
			<td>Curso</td>
			<td>Nome</td>
			<td>Validade</td>
		</tr>
	</thead>
	
<?php
$i = 0;
foreach ( $registros as $registro ) {
	
	$codigo = $registro ['nCdMatriz'];
	$nome = $registro ['cNmMatriz'];
	$curso = $registro ['cNmCurso'];
	$validade = date ( "d/m/Y", strtotime ( $registro ['dValidade'] ) );
	
	echo "<tr >";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' codigo='$codigo' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td><a href='matriz_detalhe.php?codigo=$codigo' >Acessar</a></td>";
	}
	echo "<td>$curso</td>";
	echo "<td>$nome</td>";
	echo "<td>$validade</td>";
	
	echo "</tr>";
}

?>

</table>
