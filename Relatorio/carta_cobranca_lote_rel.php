<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
session_start ();

?>
<html>
<head>
<meta charset="UTF-8" />

<style type="text/css" media="all">
body {
	font-family: "Times New Roman";
	font-size: 12;
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
	text-indent: 10mm;
	text-align: justify;
	font-family: "Times New Roman";
	font-size: 14;
	line-height: 150%;
}

table.tbassinatura {
	
}

p.quebra {
	page-break-before: always;
}
</style>

</head>

<body>
	
	<?php
	$data_inicio = $_REQUEST ['data_inicio'];
	$data_fim = $_REQUEST ['data_fim'];
	$valor_inicio = $_REQUEST ['valor_inicio'];
	$valor_fim = $_REQUEST ['valor_fim'];
	
	$query_data = "";
	$quer_valor = "";
	
	if ($valor_inicio != "") {
		
		$valor_inicio = str_replace ( ",", ".", str_replace ( ".", "", $_REQUEST ['valor_inicio'] ) );
		$valor_fim = str_replace ( ",", ".", str_replace ( ".", "", $_REQUEST ['valor_fim'] ) );
		$query_valor = "HAVING SUM(nVlrTitulo) BETWEEN $valor_inicio AND $valor_fim";
	}
	if ($data_inicio != "") {
		list ( $dia, $mes, $ano ) = split ( "/", $data_inicio );
		$data_inicio_sql = $ano . "-" . $mes . "-" . $dia;
		list ( $dia, $mes, $ano ) = split ( "/", $data_fim );
		$data_fim_sql = $ano . "-" . $mes . "-" . $dia;
		$query_data = "and dVcto between '$data_inicio_sql' and '$data_fim_sql'";
	}
	
	$query = "SELECT Pessoa.nCdPessoa, Pessoa.cNome 
			 	    from titulos 
			 	    	  inner join Pessoa on titulos.nCdPessoa = Pessoa.nCdPessoa 
			 	   where dVcto < CURDATE() 
			 	     and TipDtOcorrencia is null
			 	     $query_data
			 	  GROUP BY Pessoa.nCdPessoa, Pessoa.cNome 
			 	  $query_valor";
	
	$resultados = consulta ( 'athenas', $query );
	
	foreach ( $resultados as $resultado ) {
		$nome = $resultado ['cNome'];
		$cpf = $resultado ['nCdPessoa'];
		$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
		$query = "SELECT titulos.* 
			 	    from titulos 
			 	   where dVcto < CURDATE()
			 	     and TipDtOcorrencia is null
			 	     and nCdPessoa = $cpf";
		
		$titulos = consulta ( 'athenas', $query );
		
		include ('carta_cobranca_lote_modelo.php');
		echo "<p class=\"quebra\"></p>";
	}
	
	?>


</body>
</html>