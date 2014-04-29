<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
$disciplina = $_REQUEST ['disciplina'];
$mes_ano = $_REQUEST ['mes_ano'];
$dia = $_REQUEST ['dia'];
$turma = $_REQUEST ['turma'];
$turno = $_REQUEST ['turno'];

$ano = substr ( $mes_ano, 0, 4 );
$mes = substr ( $mes_ano, - 2 );
$data = date ( 'Y-m-d', mktime ( 0, 0, 0, $mes, $dia, $ano ) );
;

$par = 0;
$impar = 0;
if ($dia % 2 == 0) {
	$par = 1;
} else {
	$impar = 1;
}

$query = "call calendario_carrega_professor ( '$data',$par,$impar,$disciplina, $turma, '$turno' )";
$resultado_sql = consulta ( 'athenas', $query );
echo "<option value='0'>Selecione</option>";
foreach ( $resultado_sql as $registro ) {
	echo "<option value='" . $registro ['nCPF'] . "'>" . $registro ['cNome'] . "</option>";
}

?>