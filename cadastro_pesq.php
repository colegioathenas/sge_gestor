<?php
require ("config.php");
include_once "bd.php";
ini_set ( "display_errors", 0 );

$valor = $_REQUEST ['valor'];
$query = "SELECT * FROM Pessoa where nCdPessoa = '$valor' or cNome like '%$valor%' ";
$resultado = consulta ( "athenas", $query );

echo "<table width='700px'>";
echo "<thead>";
echo "<tr>";
echo "<th width=220px></th><th>CPF</th><th>Nome</th>";
echo "</tr>";
echo "</thead>";
foreach ( $resultado as $res ) {
	echo "<tr>";
	echo "<td><a href='solicitacao.php'>Solicitacao</a>|";
	echo "<a href='contato.php'>Reg. Contato</a>|";
	echo "<a href='acessar.php'>Acessar</a></td>";
	echo "<td>" . $res [nCdPessoa] . "</td>";
	echo "<td>" . $res [cNome] . "</td>";
	
	echo "</tr>";
}
echo "</table>"?>

