<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
?>
<?php

function mask($val, $mask) {
	$maskared = '';
	$k = 0;
	for($i = 0; $i <= strlen ( $mask ) - 1; $i ++) {
		if ($mask [$i] == '#') {
			if (isset ( $val [$k] ))
				$maskared .= $val [$k ++];
		} else {
			if (isset ( $mask [$i] ))
				$maskared .= $mask [$i];
		}
	}
	return $maskared;
}
?>	

<?php
$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "SELECT * FROM pessoa where cNome like '%$value%' or nCdPessoa = '$value';";
$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td></td>
			<td>CPF / CNPJ</td>
			<td>Nome</td>
		</tr>
	</thead>
	
<?php
$i = 0;
foreach ( $registros as $registro ) {
	
	$cpf = $registro ['nCdPessoa'];
	$nome = $registro ['cNome'];
	$cpfF = mask ( substr ( str_repeat ( "0", 11 ) . $cpf, - 11 ), '###.###.###-##' );
	echo "<tr>";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' cpf='$cpfF' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td><a href='cadastro.php?cpf=$cpf' >Acessar</a></td>";
	}
	echo "<td>$cpfF</td>";
	echo "<td>$nome</td>";
	echo "</tr>";
}

?>

</table>
