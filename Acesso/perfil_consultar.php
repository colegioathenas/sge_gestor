<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT * FROM perfil where cNmPerfil like '%$value%' ;";

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td width="100px"></td>
			<td>Perfil</td>
		</tr>
	</thead>
	
<?php

foreach ( $registros as $registro ) {
	
	$nome = $registro ['cNmPerfil'];
	$codigo = $registro ['nCdPerfil'];
	
	echo "<tr>";
	
	echo "<td><a href='perfil_detalhe.php?codigo=$codigo' >Acessar</a></td>";
	
	echo "<td>$nome</td>";
	echo "</tr>";
}

?>

</table>
