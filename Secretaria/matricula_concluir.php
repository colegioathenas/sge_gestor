<?php
include ("../verifica_logado.php");

require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Pessoa/pessoa_funcoes.php";

$dados_matricula = $_SESSION ['dados_matricula'];
$aluno_codigo = $dados_matricula ['aluno_codigo'];
$respfin_codigo = $dados_matricula ['respfin_codigo'];
$aluno_nome = $dados_matricula ['aluno_nome'];
echo "<pre>";
print_r ( $dados_matricula );
echo "<pre>";
$incluir_aluno = false;
$incluir_respfin = false;
// incluir ou alterar aluno
$rm = $aluno_codigo;
$nBoletos = "";

if (($dados_matricula ['aluno_codigo'] == "") || ($dados_matricula ['aluno_codigo'] == "0")) {
	$query_rm = "call registra_rm ('" . $dados_matricula ['aluno_nome'] . "');";
	$registro_rm = consulta ( "athenas", $query_rm );
	$rm = $registro_rm [0] ['aluno_mat'];
	$aluno_codigo = $rm;
	$incluir_aluno = true;
}
atualiza_pessoa ( $rm, $dados_matricula ['aluno_nome'], $dados_matricula ['aluno_endereco_res'], $dados_matricula ['aluno_endereco_complemento_res'], $dados_matricula ['aluno_cep_res'], $dados_matricula ['aluno_cidade'], $dados_matricula ['aluno_bairro'], $dados_matricula ['aluno_uf'], $dados_matricula ['aluno_rg'], $dados_matricula ['aluno_cpf'], $dados_matricula ['aluno_dt_nasc'], $dados_matricula ['aluno_naturalidade'], $dados_matricula ['aluno_naturalidade_uf'], $dados_matricula ['aluno_nacionalidade'], $dados_matricula ['aluno_email'], $dados_matricula ['aluno_pai'], $dados_matricula ['aluno_mae'], $dados_matricula ['respfin_cpf'], $dados_matricula ['aluno_profissao'], $dados_matricula ['aluno_estcivil'], $dados_matricula ['aluno_cep_com'], $dados_matricula ['aluno_endereco_com'], $dados_matricula ['aluno_bairro_com'], $dados_matricula ['aluno_cidade_com'], $dados_matricula ['aluno_ufcom'], $aluno_codigo, $incluir_aluno );

// incluir ou alterar resp. fin.
if (($dados_matricula ['aluno_cpf'] != $dados_matricula ['respfin_cpf']) && ($dados_matricula ["respfin_oMesmo"] == "0")) {
	if (($dados_matricula ['respfin_codigo'] == "") || ($dados_matricula ['respfin_codigo'] == "0")) {
		$respfin_codigo = $codigo = ereg_replace ( "[^0-9]", "", $dados_matricula ['respfin_cpf'] );
		$incluir_respfin = true;
	}
	atualiza_pessoa ( null, $dados_matricula ['respfin_nome'], $dados_matricula ['respfin_endereco_res'], $dados_matricula ['respfin_endereco_complemento_res'], $dados_matricula ['respfin_cep_res'], $dados_matricula ['respfin_cidade'], $dados_matricula ['respfin_bairro'], $dados_matricula ['respfin_uf'], $dados_matricula ['respfin_rg'], $dados_matricula ['respfin_cpf'], $dados_matricula ['respfin_dt_nasc'], $dados_matricula ['respfin_naturalidade'], $dados_matricula ['respfin_naturalidade_uf'], $dados_matricula ['respfin_nacionalidade'], $dados_matricula ['respfin_email'], $dados_matricula ['respfin_pai'], $dados_matricula ['respfin_mae'], $dados_matricula ['respfin_cpf'], $dados_matricula ['respfin_profissao'], $dados_matricula ['respfin_estcivil'], $dados_matricula ['respfin_cep_com'], $dados_matricula ['respfin_endereco_com'], $dados_matricula ['respfin_bairro_com'], $dados_matricula ['respfin_cidade_com'], $dados_matricula ['respfin_ufcom'], $respfin_codigo, $incluir_respfin );
} else {
	$respfin_codigo = $aluno_codigo;
}

// gerar boletos serv. educacionais
$percentual_desconto = $dados_matricula ['desconto'] / 100;
$mes_inicio = substr ( $dados_matricula ["vcto1"], 0, 2 );
$ano_inicio = substr ( $dados_matricula ["vcto1"], - 4 );

$mes_inicio_mat = substr ( $dados_matricula ["vcto1_mat"], 0, 2 );
$ano_inicio_mat = substr ( $dados_matricula ["vcto1_mat"], - 4 );

$vlr_pmt_anuidade = $dados_matricula ['vlr_anuidade'] / $dados_matricula ['anuidade'];

if ($dados_matricula ['opcoes_boleto_matricula'] != "NG") {
	
	for($pmt_anuidade = 1; $pmt_anuidade <= $dados_matricula ['anuidade']; $pmt_anuidade ++) {
		if ((($dados_matricula ["opcoes_boleto_matricula"] == "D1") && ($pmt_anuidade > 1)) || ($dados_matricula ['opcoes_boleto_matricula'] == "GT")) {
			
			$SeuNum = "1" . str_pad ( $rm, 4, "0", STR_PAD_LEFT ) . $ano_inicio . str_pad ( $pmt_anuidade, 2, "0", STR_PAD_LEFT ) . str_pad ( $dados_matricula ['anuidade'], 2, "0", STR_PAD_LEFT );
			$dVctosql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $pmt_anuidade - 1), $ano_inicio ) );
			$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $pmt_anuidade - 1), $ano_inicio ) );
			$dEmissao = date ( 'Y-m-d' );
			
			$nVlrDescontoSql = 0;
			$nVlrMultaSql = $vlr_pmt_anuidade * 0.02;
			$nVlrJurosSql = $vlr_pmt_anuidade * 0.000333;
			
			$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
			$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
			$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
			
			$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APÓS $dVcto";
			$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
			$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATÉ O VENCIMENTO";
			$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
			$cMensagem5 = "REF: $NmSolicitacao";
			
			$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
					, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
					VALUES ('$respfin_codigo','$SeuNum','$dVctoSql','$dEmissao','$vlr_pmt_anuidade','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
					,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5')";
			
			consulta ( "athenas", $query );
		}
	}
}
// gerar boletos material
$ano_inicio = $ano_inicio_mat;
$mes_inicio = $mes_inicio_mat;

if ($dados_matricula ['opcoes_boleto_material'] != "NG") {
	
	$vlr_pmt_material = $dados_matricula ['vlr_material'] / $dados_matricula ['material'];
	for($pmt_material = 1; $pmt_material <= $dados_matricula ['material']; $pmt_material ++) {
		if ((($dados_matricula ["opcoes_boleto_material"] == "D1") && ($pmt_material > 1)) || ($dados_matricula ['opcoes_boleto_material'] == "GT")) {
			$SeuNum = "2" . str_pad ( $rm, 4, "0", STR_PAD_LEFT ) . $ano_inicio . str_pad ( $pmt_material, 2, "0", STR_PAD_LEFT ) . str_pad ( $dados_matricula ['material'], 2, "0", STR_PAD_LEFT );
			$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio_mat + $pmt_material - 1), $ano_inicio_mat ) );
			$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio_mat + $pmt_material - 1), $ano_inicio_mat ) );
			$dEmissao = date ( 'Y-m-d' );
			
			$nVlrDescontoSql = 0;
			$nVlrMultaSql = $vlr_pmt_material * 0.02;
			$nVlrJurosSql = $vlr_pmt_material * 0.000333;
			
			$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
			$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
			$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
			
			$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APÓS $dVcto";
			$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
			$cMensagem3 = "";
			$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
			$cMensagem5 = "REF: Parcela do Material Didatico (ETAPA) ";
			$cMensagem6 = " Aluno: " . $aluno_nome;
			
			$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
				, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5,cMensagem6)
				VALUES ('$respfin_codigo','$SeuNum','$dVctoSql','$dEmissao','$vlr_pmt_material','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
				,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5','$cMensagem6')";
			
			consulta ( "athenas", $query );
		}
	}
}
// gerar_nosso_numero
$query = "SELECT * FROM Titulos where nCdPessoa = $respfin_codigo and nNossoNumero is null";
$resultado = consulta ( 'athenas', $query );
foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	$nBoletos .= $nosso_numero . ";";
	// echo $nCdBoleto." - ".$nosso_numero."<br/>";
	consulta ( 'athenas', $query );
}

// gerar matricula
$aluno_codigo = $aluno_codigo;
$aluno_turma = $turma;
$contrato_anuidade_parcelas = $dados_matricula ['anuidade'];
$contrato_material_parcelas = $dados_matricula ['material'];
$turma = $dados_matricula ['turma'];
$tipo_contrato = $dados_matricula ['modelo_contrato'];

$query = "call matricular($aluno_codigo,$turma,$contrato_anuidade_parcelas,$contrato_material_parcelas,$tipo_contrato);";
$registro_matricula = consulta ( "athenas", $query );

$_SESSION ["boletos"] = $nBoletos;
$_SESSION ["matricula"] = $registro_matricula [0] ["nCdMatricula"];
header ( "location:matricula_imprimir.php" );
?>