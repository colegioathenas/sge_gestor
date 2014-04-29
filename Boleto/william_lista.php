<?php
include_once "../geral.php";
ini_set ( "display_errors", 0 );

echo "Lista<br/>";

for($nn = 172158; $nn <= 172258; $nn ++) {
	// $nCdBoleto = $registro['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nn );
	// $query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	echo $nosso_numero . "<br>";
	// consulta('athenas',$query);
}

?>
