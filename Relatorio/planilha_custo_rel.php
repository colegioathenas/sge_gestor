
<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
?>
<html>
<head>
<style>
body {
	overflow: auto;
}

table {
	font-size: x-small;
	width: 2000px;
}
</style>
<meta charset="UTF-8" />
</head>
<body>
        
   
<?php
$dInicio = "01/05/2013"; // $_REQUEST['inicio'];
$dFim = "31/05/2013"; // $_REQUEST['fim'];

list ( $diaIni, $mesIni, $anoIni ) = explode ( "/", $dInicio );
list ( $diaFim, $mesFim, $anoFim ) = explode ( "/", $dFim );

$dInicioSQL = "'$anoIni-$mesIni-$diaIni'";
$dFimSQL = "'$anoFim-$mesFim-$diaFim'";

$query_turmas = "select distinct turma.nCdTurma, turma.cNmTurma 
                       from matricula 
                            inner join turma on turma.nCdTurma = matricula.nCdTurma 
                            inner join cursos on cursos.nCdCurso = turma.nCdCurso
                       where    $dInicioSQL between turma.dInicio and turma.dFim 
                             or $dFimSQL between turma.dInicio and turma.dFim 
                        order by cOrdem, cNmTurma ";
$turmas = consulta ( "athenas", $query_turmas );

$query_plano_conta = "select nCdContaContabil,cCodConta, cNmConta from conta_contabil order by cCodConta";
$plano_contas = consulta ( "athenas", $query_plano_conta );
$contas = array ();
foreach ( $plano_contas as $plano_conta ) {
	$contas [$plano_conta ['nCdContaContabil']] = array ();
	
	$contas [$plano_conta ['nCdContaContabil']] ['codigo'] = $plano_conta ["cCodConta"];
	$contas [$plano_conta ['nCdContaContabil']] ['nome'] = $plano_conta ["cNmConta"];
	$contas [$plano_conta ['nCdContaContabil']] ['valores'] = array ();
}

foreach ( $turmas as $turma ) {
	$codigo = $turma ["nCdTurma"];
	$query_rateio = "CALL contabilidade_apuracao_por_turma($codigo,$dInicioSQL,$dFimSQL);";
	$rateios = consulta ( "athenas", $query_rateio );
	
	foreach ( $rateios as $rateio ) {
		$contas [$rateio ['nCdContaContabil']] ['valores'] [] = number_format ( $rateio ["vlrTurma"], 2, ",", "." );
	}
}

echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<td colspan='2'>Conta</td>";
foreach ( $turmas as $turma ) {
	echo "<td>" . $turma ["cNmTurma"] . "</td>";
}
echo "</tr>";
echo "<thead>";
foreach ( $contas as $conta ) {
	echo "<tr>";
	echo "<td width='80px'>" . $conta ["codigo"] . "</td>";
	echo "<td width='250px'>" . $conta ["nome"] . "</td>";
	foreach ( $conta ["valores"] as $valor ) {
		echo "<td>";
		echo $valor == "0,00" ? "-" : $valor;
		echo "</td>";
	}
	echo "</tr>";
}
echo "</table>"?>
 </body>
</html>