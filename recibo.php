<?php
require ("config.php");
include_once "bd.php";
include_once "geral.php";
ini_set ( "display_errors", 0 );
session_start ();

?>
<html>
<head>

<style type="text/css" media="all">
body {
	font-family: "Times New Roman";
	font-size: 10;
}

.texto {
	font-family: "Times New Roman";
	font-size: 12;
}

.minititle {
	font-family: "Times New Roman";
	font-size: 8;
}

table.tabela {
	border-width: 0.3px;
	border-spacing: 0px;
	border-style: solid;
	border-color: black;
	border-collapse: collapse;
}

table.tabela th {
	border-width: 0.3px;
	padding: 5px;
	border-bottom: none;
	border-color: black;
	text-align: left;
}

table.tabela td {
	border-width: 0.5px;
	padding: 5px;
	padding-top: 0px;
	border-style: solid;
	border-top-style: none;
	border-color: black;
}

.paragrafo {
	text-align: justify;
	font-family: "Times New Roman";
	font-size: 14;
	line-height: 150%;
}

table.tbassinatura {
	
}
</style>
<meta charset="utf-8">

</head>

<body>

	<div align="center" style="width: 800px">
<?php
echo "<span style='font-family:\"Comic Sans MS\";font-weight: bold;font-size:12pt;font-style:italic'>PROTOCOLO</span>";

?>
<p class='paragrafo'>Teste</p>

</body>
</html>
