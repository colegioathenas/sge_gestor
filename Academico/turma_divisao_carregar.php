<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$curso = $_REQUEST ['curso'];

$query = "SELECT * FROM turma_divisao where nCdTurma = '$curso';";

$registros = consulta ( 'athenas', $query );

?>
<a href="#" name="btnIncluir" codigo="0">[ Incluir ]</a>
<div id="divisoes_detalhe" style='height: 100px; overflow: scroll;'>
	<table class="tbGrid">
		<thead>
			<tr>
				<td width="40px"></td>
				<td width="40px"></td>
				<td>Nome</td>
				<td>Data Incial</td>
				<td>Data Final</td>
				<td>Data de Lcto Inicial</td>
				<td>Data de Lcto Final</td>
				<td>Formula</td>
			</tr>
		</thead>

<?php
$i = 0;
foreach ( $registros as $registro ) {
	$codigo = $registro ['nCdDivisao'];
	$divisao = $registro ['cDivisao'];
	$dInicialLcto = date ( "d/m/Y", strtotime ( $registro ['dInicioLancamento'] ) );
	$dFinalLcto = date ( "d/m/Y", strtotime ( $registro ['dFimLancamento'] ) );
	$dInicial = date ( "d/m/Y", strtotime ( $registro ['dInicio'] ) );
	$dFinal = date ( "d/m/Y", strtotime ( $registro ['dFim'] ) );
	$formula = $registro ['cFormula'];
	$formulaFalta = $registro ['cFormulaFalta'];
	$lancaNota = $registro ['bLctoNotas'];
	$lancaFalta = $registro ['bLctoDiario'];
	$lancaDiario = $registro ['bLctoFreq'];
	$imprimeFalta = $registro ['bImprimeFalta'];
	
	echo "<tr>
                    <td><a href='#' name=\"btnEditar\" codigo='$codigo' 
                                                       nome='$divisao' 
                                                       dtinicio='$dInicial' 
                                                       dtfim='$dFinal'
                                                       dtinicioLcto='$dInicial'    
                                                       dtfimLcto='$dFinal'
                                                       formula='$formula'
                                                       formulaFalta = '$formulaFalta'
                                                       lanca_Nota = '$lancaNota'
                                                       lanca_Falta = '$lancaFalta'
                                                       lanca_Diario = '$lancaDiario'
                                                       imprimeFalta = '$imprimeFalta'
                                                       
                                                        ><img src=\"/image/icon_edit.png\"></a></td>
                    <td><a href='#' name=\"btnExcluir\" codigo='$codigo'><img src=\"/image/icon_delete.png\"></a></td>
                    <td>$divisao</td>
                    <td>$dInicial</td>
                    <td>$dFinal</td>
                    <td>$dInicialLcto</td>
                    <td>$dFinalLcto</td>
                    <td>$formula</td>";
}
?>
</table>
</div>

