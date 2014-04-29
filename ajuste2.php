<pre>
<?php
require ("config.php");
include_once "bd.php";
include_once "geral.php";
ini_set ( "display_errors", 0 );

// rotina para atualizar NossoNumero
$query = "SELECT * FROM Titulos where nNossoNumero is null";
$resultado = consulta ( 'athenas', $query );
foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	echo "$nCdBoleto => $nosso_numero <br/>";
	
	consulta ( "athenas", $query );
}
?>
</pre>