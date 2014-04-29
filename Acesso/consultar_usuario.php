<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT * FROM Usuario where cNmUsuario like '%$value%' or cLogin like '%$value%';";

$registros = consulta ( 'athenas', $query );
?>

<table style="width: 100%">
	<thead>
		<tr>
			<td width="100px"></td>
			<td width="100px">Login</td>
			<td>Nome</td>
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
	$login = $registro ['cLogin'];
	$nome = $registro ['cNmUsuario'];
	$codigo = $registro ['nCdUsuario'];
	
	echo "<tr style='background-color: $color'>";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' cpf='$login' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td><a href='cadastro_usuario.php?codigo=$codigo' >Acessar</a></td>";
	}
	echo "<td>$login</td>";
	echo "<td>$nome</td>";
	echo "</tr>";
}

?>

</table>
