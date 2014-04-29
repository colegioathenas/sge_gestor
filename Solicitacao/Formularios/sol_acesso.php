<?php
include_once ("../../config.php");
include_once "../../bd.php";
include_once "../../geral.php";

$registro_form = array ();
$solicitacao = getRequest ( "solicitacao", 0 );
if ($solicitacao != 0) {
	$query = "select * from solacesso where nCdSolicitacao = $solicitacao";
	$registros = consulta ( "athenas", $query );
	$registro_form = $registros [0];
}

?>
<label style="margin-top: 5px; width: 120px">CPF</label>
<input id="solAcesso_cpf" name="solAcesso_cpf" type="text" size="14"
	title="cpf"
	value="<?php echo isset($registro_form['cpf']) ?  $registro_form['cpf'] : "";?>" />
<br />
<label style="margin-top: 5px; width: 120px">Nome</label>
<input id="solAcesso_nome" name="solAcesso_nome" type="text" size="50"
	title="Nome"
	value="<?php echo isset($registro_form['nome']) ? $registro_form['nome'] : "";  ?>" />
<br />
<label style="margin-top: 5px; width: 120px">Telefone</label>
<input id="solAcesso_telefone" name="solAcesso_telefone" type="text"
	size="50" title="Curso"
	value="<?php echo isset($registro_form['telefone']) ? $registro_form['telefone'] : "";?>" />
