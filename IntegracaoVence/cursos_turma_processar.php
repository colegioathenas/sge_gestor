<?php
include ("../verifica_logado.php");
header ( 'Content-Type: text/html; charset=utf-8' );
include "cursos_turma.php";

$opcao = $_REQUEST ['opcao'];
$idopcao = $_REQUEST ['idopcao'];
$dados = consultar_curso_turma ( $idopcao, $opcao );

echo "<option value='0'>Selecione</option>";
foreach ( $dados as $dado ) {
	if ($opcao == "curso") {
		echo "<option edicao='" . $dado ["edicao"] . "' turno='" . $dado ["turno"] . "' idcurso='" . $dado ["idcurso"] . "'>" . $dado ["nome"] . " (" . $dado ["edicao"] . "º Edição) - " . $dado ["turno"] . "</option>";
	}
	if ($opcao == "turma") {
		echo "<option value='" . $dado ["idturma"] . "'>" . $dado ["nome"] . "</option>";
	}
}

?>