<?php
include_once ("../verifica_logado.php");
include_once ("../../config.php");
include_once "../../bd.php";
include_once "../../geral.php";
ini_set ( "display_errors", 0 );

$registro_form = array ();
$solicitacao = getRequest ( "solicitacao", 0 );
if ($solicitacao != 0) {
	$query = "select * from subcatt where nCdSolicitacao = $solicitacao";
	$registros = consulta ( "athenas", $query );
	$registro_form = $registros [0];
}
?>
<label style="margin-top: 5px; width: 120px">Nome do Aluno</label>
<input id="aluno_nome" name="aluno_nome" type="text" size="50"
	title="Nome"
	value="<?php echo isset($registro_form['cNmAluno']) ? $registro_form['cNmAluno'] : "";  ?>" />
<br />
<label style="margin-top: 5px; width: 120px">Turma</label>
<input id="turma_nome" name="turma_nome" type="text" size="50"
	title="Turma"
	value="<?php echo isset($registro_form['cTurma']) ? $registro_form['cTurma'] : ""; ?>" />
<br />
<label style="margin-top: 5px; width: 120px">Disciplina</label>
<input id="disciplina_nome" name="disciplina_nome" type="text" size="50"
	title="Disciplina"
	value="<?php echo isset($registro_form['cDisciplina']) ? $registro_form['cDisciplina'] : "";?>" />
<br />
<label style="margin-top: 5px; width: 120px">CID</label>
<input id="cid" name="cid" type="text" size="50"
	title="CID - Codigo Internacional de Doença"
	value="<?php echo isset($registro_form['cCID']) ? $registro_form['cCID'] : "";?>" />
