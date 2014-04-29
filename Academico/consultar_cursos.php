<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT * FROM cursos where cNmCurso like '%$value%' or nCdCurso = '$value';";

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td></td>

			<td>Nome</td>
			<td>Tipo</td>
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
	$codigo = $registro ['nCdCurso'];
	$nome = $registro ['cNmCurso'];
	$cTipo = $registro ['cTpCurso'];
	$cDescricao = "";
	switch ($cTipo) {
		case 'R' :
			$cDescricao = "Regular";
			break;
		case "T" :
			$cDescricao = "Tecnico";
		default :
			
			break;
	}
	
	echo "<tr>";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' codigo='$codigo' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td><a href='cadastro_curso.php?codigo=$codigo' >Acessar</a></td>";
	}
	
	echo "<td>$nome</td>";
	echo "<td>$cDescricao</td>";
	echo "</tr>";
}

?>

</table>