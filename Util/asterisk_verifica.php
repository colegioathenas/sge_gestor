<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );

$query = "select * from asterisk_inbound where bNovo = 1";

$registro = consulta ( "athenas", $query );
// echo $query;

if ($registro [0] ["nCdInbound"] != "") {
	$query_update = "update asterisk_inbound set bNovo = 0 where nCdInbound = " . $registro [0] ["nCdInbound"];
	
	consulta ( "athenas", $query_update );
}

$query_cadastro = "SELECT p.nCdPessoa,cNome FROM pessoa_telefone pt INNER JOIN pessoa p ON p.nCdPessoa = pt.`nCdPessoa` WHERE CONCAT(nDDD,nTelefone)= " . $registro [0] ["cNumero"];
$cadastro = consulta ( "athenas", $query_cadastro );

if (count ( $cadastro ) > 0) {
	echo "Acessar cadastro de: <br/> ";
	echo "<table>";
	foreach ( $cadastro as $cad ) {
		
		echo "<tr>";
		echo "<td><a href='/Pessoa/cadastro.php?cpf=" . $cad ["nCdPessoa"] . "'>" . $cad ["cNome"] . "</a><td>";
		echo "</tr>";
	}
	echo "</table>";
}

?>
