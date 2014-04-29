<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$tipo = $_REQUEST ['tipo'];
$conta_corrente = $_REQUEST ['conta'];

$html_conta_contabil = "";

$query = 'select * from conta_contabil order by cCodConta';

$contas = consulta ( 'athenas', $query );

$html_conta_contabil = "<select id='conta_contabilxcodigo' class='conta_contabil' style='background-color: Mycolor' codigo='xcodigo'><option value='0'>Selecione</option>";

foreach ( $contas as $conta ) {
	$lancamento = $conta ['bPermiteLancamento'];
	$codigo = $conta ['nCdContaContabil'];
	$nome = $conta ['cCodConta'] . " - " . $conta ['cNmConta'];
	
	if ($lancamento == 1) {
		$html_conta_contabil .= '</optgroup">';
		$html_conta_contabil .= "<option values='$codigo' codigo='$codigo' >$nome</option>";
	} else {
		$html_conta_contabil .= "<optgroup label='$nome'>";
	}
}
$html_conta_contabil .= "</select>";

// echo $html_conta_contabil;

$query = "Select lancamento.*,(select count(*) from lancamento x where x.nCdLancamentoPai = lancamento.nCdLancamento) as qtdFilho 
				from lancamento 
			   where (nCdContaCorrente = $conta_corrente or $conta_corrente = 0) 
			     and (ifnull(bConciliado,0) = $tipo or $tipo = 3)
			   order by ifnull(nCdLancamentoPai,nCdLancamento)";

$lancamentos = consulta ( 'athenas', $query );

echo "<table>";
$i = 0;
foreach ( $lancamentos as $lancamento ) {
	$i ++;
	if ($i % 2 == 0) {
		$color = '#BBBBBB';
	} else {
		$color = '#EEEEEE';
	}
	$codigo = $lancamento ['nCdLancamento'];
	$contacontabil = $lancamento ['nCdContaContabil'];
	$data = date ( 'd/m/Y', strtotime ( $lancamento ['dLancamento'] ) );
	$descr = $lancamento ['cDescricao'];
	$valor = $lancamento ['nValor'];
	$html_combo = str_replace ( "Mycolor", $color, $html_conta_contabil );
	$html_combo = str_replace ( "xcodigo", $codigo, $html_combo );
	$html_combo = str_replace ( "<option values='$contacontabil' ", "<option values='$contacontabil' selected ", $html_combo );
	$codigo = $lancamento ['nCdLancamento'];
	if ($valor >= 0) {
		$color_valor = 'blue';
	} else {
		$color_valor = 'red';
	}
	echo "<tr style='background-color: $color'>
				<td width='100'>";
	if ($lancamento ['nCdLancamentoPai'] == "") {
		echo "<a href='' name='desmembrar_btn' codigo='$codigo'>Desmembrar</a></td>";
	}
	echo "</td><td width='80'>$data</td>
				<td width='300'>$descr</td>
				<td width='80' style='color:$color_valor;text-align:right;padding-right:15px'>" . number_format ( $valor, 2, ',', '.' ) . "</td>
						
				<td style=''>";
	if ($lancamento ['qtdFilho'] == "0") {
		echo $html_combo;
	}
	
	echo "</tr>";
}
echo "</table>";
?>