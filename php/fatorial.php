<html>
<head>
<meta charset="utf8" />
</head>
<body>
<?php
$numero = $_REQUEST ['valor'];
// multiplicar o numero x pelo x-1 até x-1 ser 1
$resultado = 1;
for($i = $numero; $i >= 1; $i --) {
	$resultado *= $i;
}
echo "O fatorial de $numero é $resultado";
?>
</body>
</html>