<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$value = $_REQUEST ['valor'];
$popup = $_REQUEST ['popup'];
$query = "select professor.*,cNome from professor inner join pessoa on professor.nCPF = pessoa.nCdPessoa where cNome like '%$value%' or nCdPessoa = '$value';";

$registros = consulta ( 'athenas', $query );
?>

<table class="tbGrid">
	<thead>
		<tr>
			<td></td>
			<td>CPF</td>
			<td>Nome</td>
			<td>Infantil</td>
			<td>Fund I</td>
			<td>Fund II</td>
			<td>M&eacute;dio</td>
			<td>T&eacute;cnico</td>
		</tr>
	</thead>
	
<?php
$i = 0;
foreach ( $registros as $registro ) {
	
	$cpf = $registro ['nCPF'];
	$nome = $registro ['cNome'];
	$infantil = "";
	$fundI = "";
	$fundII = "";
	$medio = "";
	$tecnico = "";
	
	if ($registro ["bTecnico"] == true) {
		$tecnico = "<span class='ui-icon ui-icon-check'></span>";
	}
	if ($registro ["bInfantil"] == true) {
		$infantil = "<span class='ui-icon ui-icon-check'></span>";
	}
	if ($registro ["bFundI"] == true) {
		$fundI = "<span class='ui-icon ui-icon-check'></span>";
	}
	if ($registro ["bFundII"] == true) {
		$fundII = "<span class='ui-icon ui-icon-check'></span>";
	}
	if ($registro ["bMedio"] == true) {
		$medio = "<span class='ui-icon ui-icon-check'></span>";
	}
	
	echo "<tr >";
	if ($popup == "sim") {
		echo "<td><a href='#' name='selecionar' cpf='$cpf' nome='$nome' >Acessar</a></td>";
	} else {
		echo "<td><a href='professor_detalhe.php?cpf=$cpf' >Acessar</a></td>";
	}
	echo "<td>$cpf</td>";
	echo "<td>$nome</td>";
	echo "<td>$infantil</td>";
	echo "<td>$fundI</td>";
	echo "<td>$fundII</td>";
	echo "<td>$medio</td>";
	echo "<td>$tecnico</td>";
	
	echo "</tr>";
}

?>

</table>
