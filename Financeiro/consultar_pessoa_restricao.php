<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include ("../geral.php");

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT * FROM Consulta_SCPC where cNome like '%$value%' or nCPF = '$value';";

$registros = consulta ( 'athenas', $query );
?>

<table width="100%">
	<thead>
		<tr>
			<td></td>
			<td>CPF / CNPJ</td>
			<td>Nome</td>
			<td></td>
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
	$cpf = $registro ['nCPF'];
	$nome = $registro ['cNome'];
	$cpf = str_pad ( $cpf, 11, "0", STR_PAD_LEFT );
	$cpf_mask = mask ( $cpf, "###.###.###-##" );
	$situacao = $registro ['bBloqueado'];
	$textoLB = "Liberar";
	if ($situacao == "0") {
		$textoLB = "Bloquear";
	}
	
	echo "<tr style='background-color: $color' >";
	echo "<td><a href='../consultas/scpc/$cpf.htm' target='_blank' >Acessar</a></td>";
	echo "<td>$cpf_mask</td>";
	echo "<td>$nome</td>";
	echo "<td><a href='' name='aterarSituacao' situacao='$situacao' cpf='$cpf' >$textoLB</a></td>";
	echo "</tr>";
}

?>

</table>
