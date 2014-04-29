<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$cpf = $_SESSION ['cpf'];
$cpf = str_replace ( ".", "", $cpf );
$cpf = str_replace ( "-", "", $cpf );

$inicio = $_REQUEST ['disponibilidade_add_inicio'];
$fim = $_REQUEST ['disponibilidade_add_fim'];
$par_impar = $_REQUEST ['disponibilidade_par_impar'];
$turno = $_REQUEST ['disponibilidade_turno'];

$segIni = $_REQUEST ['disponibilidade_seg_inicio'];
$segFim = $_REQUEST ['disponibilidade_seg_fim'];
$terIni = $_REQUEST ['disponibilidade_ter_inicio'];
$terFim = $_REQUEST ['disponibilidade_ter_fim'];
$quaIni = $_REQUEST ['disponibilidade_qua_inicio'];
$quaFim = $_REQUEST ['disponibilidade_qua_fim'];
$quiIni = $_REQUEST ['disponibilidade_qui_inicio'];
$quiFim = $_REQUEST ['disponibilidade_qui_fim'];
$sexIni = $_REQUEST ['disponibilidade_sex_inicio'];
$sexFim = $_REQUEST ['disponibilidade_sex_fim'];

list ( $dia, $mes, $ano ) = explode ( "/", $inicio );
$inicioSql = "$ano-$mes-$dia";

list ( $dia, $mes, $ano ) = explode ( "/", $fim );
$fimSql = "$ano-$mes-$dia";

if ($par_impar == "0") {
	$par = "1";
	$impar = "1";
}

if ($par_impar == "1") {
	$par = "1";
	$impar = "0";
}

if ($par_impar == "2") {
	$par = "0";
	$impar = "1";
}

$query = "insert into professor_disponibilidade values (0,$cpf,'$inicioSql','$fimSql','$turno',$par,$impar,'$segIni','$segFim','$terIni','$terFim','$quaIni','$quaFim','$quiIni','$quiIni','$sexIni','$sexFim');";

echo $query;

consulta ( 'athenas', $query );
?>