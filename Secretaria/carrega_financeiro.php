<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
setlocale ( LC_TIME, 'ptb', 'pt_BR', 'portuguese-brazil', 'bra', 'brazil', 'pt_BR.utf-8', 'pt_BR.iso-8859-1', 'br' );

$nCdTurma = $_REQUEST ['turma'];
$consulta = $_REQUEST ['consulta'];

$query = "select * from turma where nCdTurma = $nCdTurma";
$registros = consulta ( 'athenas', $query );
$turma = $registros [0];

echo "<option value='0'>Selecione</option>";
if ($consulta == 'anuidade') {
	$vlr_anuidade = $turma ['nVlrCurso'];
	$prazo_anuidade_max = $turma ['nCursoPrazoMax'];
	for($prazo_anuidade = 1; $prazo_anuidade <= $prazo_anuidade_max; $prazo_anuidade ++) {
		$anuidade_mensalidade = $vlr_anuidade / $prazo_anuidade;
		$valor = number_format ( $anuidade_mensalidade, 2, ".", "," );
		echo "<option value='$prazo_anuidade'>$prazo_anuidade x $valor</option>";
	}
}
if ($consulta == 'material') {
	$vlr_material = $turma ['nVlrMaterial'];
	$prazo_material_max = $turma ['nMaterialPrazoMax'];
	for($prazo_material = 1; $prazo_material <= $prazo_material_max; $prazo_material ++) {
		$material_mensalidade = $vlr_material / $prazo_material;
		$valor_material = number_format ( $material_mensalidade, 2, ".", "," );
		echo "<option value='$prazo_material'>$prazo_material x $valor_material</option>";
	}
}

?>