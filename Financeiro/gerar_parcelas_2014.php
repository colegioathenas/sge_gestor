<HTML>
<head>
<meta charset="utf-8">

</head>
<body>
	<pre>
<?php
echo "oi";
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";

$query = "SELECT * FROM Titulos where nNossoNumero is null";

$resultado = consulta ( 'athenas', $query );

foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	consulta ( 'athenas', $query );
}
echo "Gerado";
?>
</pre>
</body>
</html>
