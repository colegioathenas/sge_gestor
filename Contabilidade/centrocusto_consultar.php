<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT *
                    FROM centro_custo                         
                   WHERE cNmCCusto like '%$value%' or nCdCCusto = '$value'
                 ORDER BY cNmCCusto;";

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td width='100px'></td>

			<td width='100px'>Codigo</td>
			<td>Centro de Custo</td>
		</tr>
	</thead>
	
<?php
foreach ( $registros as $registro ) {
	
	$codigo = $registro ['nCdCCusto'];
	$nome = $registro ['cNmCCusto'];
	
	echo "<tr>";
	if ($popup == "sim") {
		echo "<td width='100px'><a href='#' name='selecionar' codigo='$codigo' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td  width='100px'><a href='centrocusto_detalhe.php?codigo=$codigo' >Acessar</a></td>";
	}
	
	echo "<td  width='100px'>$codigo</td>";
	echo "<td>$nome</td>";
	echo "</tr>";
}

?>

</table>