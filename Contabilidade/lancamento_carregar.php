<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$data = $_REQUEST ['data'];
list ( $dia, $mes, $ano ) = explode ( "/", $data );
$dataSQL = "'$ano-$mes-$dia'";

$query = "select lancamento.*
                       , conta_contabil.cCodConta
                       , centro_custo.cNmCCusto
                       , conta_contabil.cNmConta
                    from lancamento 
                         left join conta_contabil on conta_contabil.nCdContaContabil = lancamento.nCdConta 
                         left join centro_custo on centro_custo.nCdCCusto = lancamento.nCdCCusto
                    where dLancamento = $dataSQL";
$lancamentos = consulta ( 'athenas', $query );
/*
 * $html_conta_contabil = ""; $query = 'select * from conta_contabil order by cCodConta'; $contas = consulta('athenas',$query); $html_conta_contabil = "<select id='conta_contabilxcodigo' class='conta_contabil' style='background-color: Mycolor' codigo='xcodigo'><option value='0'>Selecione</option>"; foreach($contas as $conta){ $lancamento = $conta['bPermiteLancamento']; $codigo = $conta['nCdContaContabil']; $nome = $conta['cCodConta']." - ". $conta['cNmConta']; if ($lancamento == 1){ $html_conta_contabil .= '</optgroup">'; $html_conta_contabil .= "<option values='$codigo' codigo='$codigo' >$nome</option>"; }else{ $html_conta_contabil .= "<optgroup label='$nome'>"; } } $html_conta_contabil .= "</select>"; //echo $html_conta_contabil; $query = "Select lancamento.*,(select count(*) from lancamento x where x.nCdLancamentoPai = lancamento.nCdLancamento) as qtdFilho from lancamento where (nCdContaCorrente = $conta_corrente or $conta_corrente = 0) and (ifnull(bConciliado,0) = $tipo or $tipo = 3) order by ifnull(nCdLancamentoPai,nCdLancamento)"; $lancamentos = consulta('athenas',$query);
 */

foreach ( $lancamentos as $lancamento ) {
	$codigo = $lancamento ['nCdLancamento'];
	$conta = $lancamento ['cCodConta'] . " - " . $lancamento ['cNmConta'];
	$descr = $lancamento ['cDescricao'];
	$valor = $lancamento ['nValor'];
	$cCusto = $lancamento ['cNmCCusto'];
	
	if ($conta [0] == "2") {
		$color_valor = 'red';
	} else {
		if ($conta [0] == "1") {
			$color_valor = 'blue';
		} else {
			$color_valor = 'black';
		}
	}
	
	echo "<tr>
                        <td width='50px'></td>                        
                        <td width='200px'>$descr</td>
                        <td width='50px' style='color:$color_valor;text-align:right;padding-right:15px'>" . number_format ( $valor, 2, ',', '.' ) . "</td>
                        <td width='350px'>$conta</td>
                        <td >$cCusto</td>
                    </tr>\n";
}

?>