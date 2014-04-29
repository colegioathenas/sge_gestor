<?php
include_once ("../../config.php");
include_once "../../bd.php";
include_once "../../geral.php";

$registro_form = array ();
$solicitacao = getRequest ( "solicitacao", 0 );
if ($solicitacao != 0) {
	$query = "select * from histreg where nCdSolicitacao = $solicitacao";
	$registros = consulta ( "athenas", $query );
	$registro_form = $registros [0];
}
?>
<label style="margin-top: 5px; width: 120px">Nome do Aluno</label>
<input id="aluno_nome" name="aluno_nome" type="text" size="50"
	title="Nome"
	value="<?php echo isset($registro_form['cNmAluno']) ? $registro_form['cNmAluno'] : "";  ?>" />
<br />
<label style="margin-top: 5px; width: 120px">Curso</label>
<input id="curso_nome" name="curso_nome" type="text" size="50"
	title="Curso"
	value="<?php echo isset($registro_form['cCurso']) ? $registro_form['cCurso'] : "";?>" />
<br />
<label style="margin-top: 5px; width: 120px">Turma</label>
<input id="turma_nome" name="turma_nome" type="text" size="50"
	title="Turma"
	value="<?php echo isset($registro_form['cTurma']) ? $registro_form['cTurma'] : ""; ?>" />
