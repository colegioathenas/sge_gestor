<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Pessoa/pessoa_funcoes.php";

$action = $_REQUEST ['action'];
$cpf = ereg_replace ( "[^0-9]", "", $_REQUEST ['professor'] );
$codigo = $_REQUEST ['codigo'];

if ($action == "A") {
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
}
if ($action == "E") {
	$query = "delete from professor_disponibilidade where nCdDisponibilidade = $codigo;";
}

consulta ( "athenas", $query );

?>