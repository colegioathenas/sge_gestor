<?php
session_start ();
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
$consulta = $_REQUEST ['consulta'];
$param1 = $_REQUEST ['param1'];
$param2 = $_REQUEST ['param2'];
$param3 = $_REQUEST ['param3'];
$login = $_SESSION ['nCdUsuario'];

if ($consulta == 'cursos') {
	$query = "call sgegestor_carrega_combo_curso()";
	$resultado_sql = consulta ( 'athenas', $query );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdCurso'] . "' selected>" . $resultado_sql [0] ['cNmCurso'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdCurso'] . "'>" . $registro ['cNmCurso'] . "</option>";
		}
	}
}

if ($consulta == 'turmas') {
	
	$query = "call sgegestor_carrega_combo_turma($param1)";
	$resultado_sql = consulta ( 'athenas', $query );
	
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdTurma'] . "' selected>" . $resultado_sql [0] ['cNmTurma'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdTurma'] . "'>" . $registro ['cNmTurma'] . "</option>";
		}
	}
}

if ($consulta == 'divisao') {
	
	$query = "call sgeprof_carrega_combo_divisao($login,$param1,$param2)";
	$resultado_sql = consulta ( 'athenas', $query );
	print_r ( $resultado_sql );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdDivisao'] . "' selected>" . $resultado_sql [0] ['cDivisao'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdDivisao'] . "'>" . $registro ['cDivisao'] . "</option>";
		}
	}
}

if ($consulta == 'disciplina') {
	
	$query = "call sgeprof_carrega_combo_disciplina($login,$param1,$param2,$param3)";
	$resultado_sql = consulta ( 'athenas', $query );
	print_r ( $resultado_sql );
	echo "<option value='0'>Selecione</option>";
	if (count ( $resultado_sql ) == 1) {
		echo "<option value='" . $resultado_sql [0] ['nCdDisciplina'] . "' selected>" . $resultado_sql [0] ['cNmDisciplina'] . "</option>";
	} else {
		foreach ( $resultado_sql as $registro ) {
			echo "<option value='" . $registro ['nCdDisciplina'] . "'>" . $registro ['cNmDisciplina'] . "</option>";
		}
	}
}

?>