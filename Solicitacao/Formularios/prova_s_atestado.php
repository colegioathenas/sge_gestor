<?php
include_once ("../../verifica_logado.php");
include_once ("../../config.php");
include_once "../../bd.php";
include_once "../../geral.php";
ini_set ( "display_errors", 0 );
$query = "select * from tpSolicitacao where nCdTpSolicitacao = " . $_REQUEST ['codigo'];
$opcoes = consulta ( "athenas", $query );
$QtdParc = $opcoes [0] ["nQtdParc"];
$Valor = $opcoes [0] ["nValor"];

$registro_form = array ();
$solicitacao = getRequest ( "solicitacao", 0 );
if ($solicitacao != 0) {
	$query = "select * from subsatt where nCdSolicitacao = $solicitacao";
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
<?php if ($solicitacao == 0) { ?>
<label style="margin-top: 5px; width: 120px">Valor</label>
<input id="valor" name="valor" type="text" size="10" readonly="readonly"
	value="<?php echo number_format($Valor,2,",",".")?>" />
<br />

<label style="margin-top: 5px; width: 120px">Forma Pgto</label>
<select id="qtdParc" name="qtdParc">
	<option value='0'>Selecione</option>

<?php
	
	for($i = 1; $i <= $QtdParc; $i ++) {
		$vlr = $Valor / $i;
		echo "<option value='$i'>$i x de " . number_format ( $vlr, 2, ",",".")."</option>";
	}
?>

<?php  } ?>

</select>