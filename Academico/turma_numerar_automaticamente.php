<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$turma = $_REQUEST ['turma'];

$query = "SELECT (SELECT MAX(nChamada) FROM matricula WHERE nCdTurma = $turma) AS numero_maior, matricula.* FROM matricula  INNER JOIN pessoa ON pessoa.nCdPessoa = matricula.`nCdPessoa` WHERE nCdTurma = $turma ORDER BY nchamada,cNome";
$matriculados = consulta ( "athenas", $query );
$maior = $matriculados [0] ['numero_maior'];
$query_atualiza_numero = array ();
foreach ( $matriculados as $matricula ) {
	if ($matricula ['nChamada'] == 0) {
		$maior ++;
		$query_atualiza_numero [] = "update matricula set nChamada = $maior where nCdMatricula = " . $matricula ["nCdMatricula"];
	}
}

foreach ( $query_atualiza_numero as $query_atualiza ) {
	consulta ( "athenas", $query_atualiza );
}

?>