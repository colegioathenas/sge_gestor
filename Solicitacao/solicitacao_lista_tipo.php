<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );
$nCdCurso = $_REQUEST ['curso'];

$query = "call solicitacao_lista_tipo()";
$tipos = consulta ( 'athenas', $query );
echo "<option value='0'>Selecione</option>";
foreach ( $tipos as $tipo ) {
	
	$codigo = $tipo ['nCdTpSolicitacao'];
	$nome = $tipo ['cNmTpSolicitacao'];
	$formulario = $tipo ['cPaginaPHP'];
	$id = $tipo ['cID'];
	$prazo = $tipo ['nQtdDia'];
	echo "<option value='$codigo' formulario='$formulario' idt='$id' prazo='$prazo' >$nome</option>";
}

?>