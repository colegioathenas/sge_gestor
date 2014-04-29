<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Pessoa/pessoa_funcoes.php";

$action = $_REQUEST ['action'];
$cpf = ereg_replace ( "[^0-9]", "", $_REQUEST ['professor'] );
$disciplina = $_REQUEST ['disciplina'];

if ($action == "A") {
	$query = "insert into professor_disciplina values ($cpf,$disciplina);"; // 9857-1115
}

if ($action == "E") {
	$query = "delete from professor_disciplina where nCPF = $cpf and nCdDisciplina = $disciplina;";
}
consulta ( "athenas", $query );
?>