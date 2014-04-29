<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$serie = $_SESSION ['serie'];
$turma = $_SESSION ['turma'];
$aluno_mat = $_SESSION ['mat'];
$aluno_nome = $_REQUEST ['aluno_nome'];
$aluno_rg = $_REQUEST ['aluno_rg'];
$aluno_dtnasc = $_REQUEST ['aluno_dtnasc'];
list ( $dia, $mes, $ano ) = split ( '/', $aluno_dtnasc );
$aluno_dtnasc_sql = "$ano-$mes-$dia";

$aluno_naturalidade = $_REQUEST ['aluno_naturalidade'];
$aluno_naturalidade_uf = $_REQUEST ['aluno_naturalidade_uf'];
$aluno_nacionalidade = $_REQUEST ['aluno_nacionalidade'];
$aluno_cep = $_REQUEST ['aluno_cep'];

$aluno_endereco = $_REQUEST ['aluno_endereco'];
$aluno_bairro = $_REQUEST ['aluno_bairro'];
$aluno_cidade = $_REQUEST ['aluno_cidade'];
$aluno_uf = $_REQUEST ['aluno_uf'];
$aluno_ddd = $_REQUEST ['aluno_ddd'];
$aluno_telefone = $_REQUES ['aluno_telefone'];
$aluno_email = $_REQUEST ['aluno_email'];
$aluno_pai = $_REQUEST ['aluno_pai'];
$aluno_mae = $_REQUEST ['aluno_mae'];

$resp_nome = $_REQUEST ['resp_nome'];
$resp_parentesco = $_REQUEST ['resp_parentesco'];
$resp_rg = $_REQUEST ['resp_rg'];
$resp_cpf = $_REQUEST ['resp_cpf'];

$resp_profissao = $_REQUEST ['resp_profissao'];
$resp_est_civ = $_REQUEST ['resp_est_civ'];
$resp_dtnasc = $_REQUEST ['resp_dtnasc'];
list ( $dia, $mes, $ano ) = split ( '/', $resp_dtnasc );
$resp_dtnasc_sql = "$ano-$mes-$dia";

$resp_naturalidade = $_REQUEST ['resp_naturalidade'];
$resp_nacionalidade = $_REQUEST ['resp_nacionalidade'];
$resp_end_res_cep = $_REQUEST ['resp_end_res_cep'];
$resp_end_res_end = $_REQUEST ['resp_end_res_end'];
$resp_end_res_bairro = $_REQUEST ['resp_end_res_bairro'];
$resp_end_res_cidade = $_REQUEST ['resp_end_res_cidade'];
$resp_end_res_uf = $_REQUEST ['resp_end_res_uf'];
$resp_end_com_cep = $_REQUEST ['resp_end_com_cep'];
$resp_end_com_end = $_REQUEST ['resp_end_com_end'];
$resp_end_com_bairro = $_REQUEST ['resp_end_com_bairro'];
$resp_end_com_cidade = $_REQUEST ['resp_end_com_cidade'];
$resp_end_com_uf = $_REQUEST ['resp_end_com_uf'];
$resp_res_ddd = $_REQUEST ['resp_res_ddd'];
$resp_res_tel = $_REQUEST ['resp_res_tel'];
$resp_com_ddd = $_REQUEST ['resp_com_ddd'];
$resp_com_tel = $_REQUEST ['resp_com_tel'];
$resp_cel_tel = $_REQUEST ['resp_cel_tel'];
$resp_email = $_REQUEST ['resp_email'];
$resp_cel_operadora = $_REQUEST ['resp_cel_operadora'];

$val_mensalidade = $_REQUEST ['val_mensalidade'];
$val_material = $_REQUEST ['val_material'];
$val_uniforme = $_REQUEST ['val_uniforme'];

$fpg_mensalidade = $_REQUEST ['fpg_mensalidade'];
$fpg_material = $_REQUEST ['fpg_material'];
$fpg_uniforme = $_REQUEST ['fpg_uniforme'];
$mes_inicio = 1; // $_REQUEST['mes_inicio']

$aluno_cep = str_replace ( "-", "", $aluno_endereco );
$resp_cpf = str_replace ( "-", "", $resp_cpf );
$resp_cpf = str_replace ( ".", "", $resp_cpf );
$resp_end_res_cep = str_replace ( "-", "", $resp_end_res_cep );
$resp_end_com_cep = str_replace ( "-", "", $resp_end_com_cep );

$percentual_desconto = 0.05 + floatval ( $_SESSION ['perdesconto'] );

$irmao_mat = $_SESSION ['irmao_mat'];

$tipo = $_SESSION ['tipo'];

if ($tipo == 'matricula') {
	$query = "call registra_rm('$aluno_nome')";
	
	$aluno_mat = consulta ( "athenas", $query );
	
	$aluno_mat = $aluno_mat [0] ['aluno_mat'];
	
	$_SESSION ['mat'] = $aluno_mat;
}

$msg = "Realizado $tipo, Mensalidade em $fpg_mensalidade vezes,  Material em $fpg_material vezes e ";
if ($fpg_material == "") {
	$msg .= "uniformes em $fpg_uniforme vezes";
} else {
	$msg .= " nao foi solicitado uniforme";
}

grava_comunicacao ( $resp_cpf, $_SESSION ['nCdUsuario'], 1, $msg );

$query = "call atualiza_pessoa($resp_cpf,'$resp_nome','$resp_end_res_end',null,null,$resp_end_res_cep
												   ,'$resp_end_res_cidade','$resp_end_res_bairro','$resp_end_res_uf','$resp_rg')";

consulta ( "athenas", $query );

$query = "INSERT INTO matriculado values ('$serie','$aluno_mat','$aluno_nome','$aluno_rg'
	,'$aluno_dtnasc_sql','$aluno_naturalidade','$aluno_naturalidade_uf','$aluno_nacionalidade'
	,'$aluno_cep','$aluno_endereco','$aluno_bairro','$aluno_cidade','$aluno_uf'
	,'$aluno_ddd','$aluno_telefone','$aluno_email','$aluno_pai','$aluno_mae','$resp_nome'
	,'$resp_parentesco','$resp_rg','$resp_cpf','$resp_dtnasc_sql','$resp_profissao','$resp_est_civ','$resp_naturalidade'
	,'$resp_nacionalidade','$resp_end_res_cep','$resp_end_res_end','$resp_end_res_bairro'
	,'$resp_end_res_cidade','$resp_end_res_uf','$resp_end_com_cep','$resp_end_com_end'
	,'$resp_end_com_bairro','$resp_end_com_cidade','$resp_end_com_uf','$resp_res_ddd'
	,'$resp_res_tel','$resp_com_ddd','$resp_com_tel','$resp_cel_tel','$resp_email'
	,'$fpg_mensalidade','$fpg_material','$fpg_uniforme','$val_mensalidade','$val_material','$val_uniforme','$irmao_mat','$resp_cel_operadora',$turma,0);";

// echo $query;
consulta ( "athenas", $query );
$val_mensalidade = $val_mensalidade / $fpg_mensalidade;

for($i = 1; $i <= $fpg_mensalidade; $i ++) {
	
	$SeuNum = "1" . $aluno_mat . "2013" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $fpg_mensalidade, 2, "0", STR_PAD_LEFT );
	$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
	$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
	$dEmissao = date ( 'Y-m-d' );
	
	$nVlrDescontoSql = $val_mensalidade * $percentual_desconto;
	$nVlrMultaSql = $val_mensalidade * 0.1;
	$nVlrJurosSql = $val_mensalidade * 0.0033;
	
	$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
	$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
	$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
	
	$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APÓS $dVcto";
	$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
	$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATÉ $dVcto OU PROXIMO DIA UTIL";
	$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
	$cMensagem5 = "REF: Mensalidade " . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $fpg_mensalidade, 2, "0", STR_PAD_LEFT ) . " Aluno: " . $aluno_nome;
	
	$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
				, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
				VALUES ('$resp_cpf','$SeuNum','$dVctoSql','$dEmissao','$val_mensalidade','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
				,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5')";
	
	// echo $query."<br/>";
	consulta ( "athenas", $query );
}

$val_material = $val_material / $fpg_material;
for($i = 1; $i <= $fpg_material; $i ++) {
	
	$SeuNum = "2" . $aluno_mat . "2013" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $fpg_material, 2, "0", STR_PAD_LEFT );
	
	if ($fpg_material == 1) {
		$nVlrDescontoSql = $val_material * 0.05;
	} else {
		$nVlrDescontoSql = 0;
	}
	
	$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
	$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
	$dEmissao = date ( 'Y-m-d' );
	
	$nVlrMultaSql = $val_material * 0.1;
	$nVlrJurosSql = $val_material * 0.0033;
	
	$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
	$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
	$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
	
	$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APÓS $dVcto";
	$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
	$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATÉ $dVcto OU PROXIMO DIA UTIL";
	$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
	$cMensagem5 = "REF: Material Didatico " . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $fpg_material, 2, "0", STR_PAD_LEFT ) . " Aluno: " . $aluno_nome;
	
	$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
				, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
				VALUES ('$resp_cpf','$SeuNum','$dVctoSql','$dEmissao','$val_material','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
				,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5')";
	
	consulta ( "athenas", $query );
}

$val_uniforme = $val_uniforme / $fpg_uniforme;
for($i = 1; $i <= $fpg_uniforme; $i ++) {
	$mesvcto = $mes_inicio + $i - 1;
	$SeuNum = "3" . $aluno_mat . "2013" . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . str_pad ( $fpg_uniforme, 2, "0", STR_PAD_LEFT );
	$dVctoSql = date ( 'Y-m-d', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
	$dVcto = date ( 'd/m/Y', f5diautil ( ($mes_inicio + $i - 1), 2013 ) );
	$dEmissao = date ( 'Y-m-d' );
	
	$nVlrDescontoSql = 0;
	$nVlrMultaSql = $val_uniforme * 0.1;
	$nVlrJurosSql = $val_uniforme * 0.0033;
	
	$nVlrMulta = number_format ( $nVlrMultaSql, 2, ",", "." );
	$nVlrJuros = number_format ( $nVlrJurosSql, 2, ",", "." );
	$nVlrDesconto = number_format ( $nVlrDescontoSql, 2, ",", "." );
	
	$cMensagem1 = "- MULTA DE  		R$:   $nVlrMulta APÓS $dVcto";
	$cMensagem2 = "- JUROS DE  		R$:   $nVlrJuros AO DIA";
	$cMensagem3 = "- DESCONTO DE    R$    $nVlrDesconto ATÉ $dVcto OU PROXIMO DIA UTIL";
	$cMensagem4 = "NAO RECEBER APOS 30 DIAS DE ATRASO";
	$cMensagem5 = "REF: Uniforme " . str_pad ( $i, 2, "0", STR_PAD_LEFT ) . "/" . str_pad ( $fpg_uniforme, 2, "0", STR_PAD_LEFT ) . " Aluno: " . $aluno_nome;
	;
	
	$query = "INSERT INTO Titulos (nCdPessoa, SeuNum, dVcto, dEmissao, nVlrTitulo, nVlrJuros, dDesconto, nVlrDesconto
				, dMulta, nVlrMulta, cMensagem1, cMensagem2, cMensagem3, cMensagem4,cMensagem5)
				VALUES ('$resp_cpf','$SeuNum','$dVctoSql','$dEmissao','$val_uniforme','$nVlrJurosSql','$dVctoSql','$nVlrDescontoSql'
				,'$dVctoSql','$nVlrMultaSql','$cMensagem1','$cMensagem2','$cMensagem3','$cMensagem4','$cMensagem5')";
	
	consulta ( "athenas", $query );
}

// rotina para atualizar NossoNumero
$query = "SELECT * FROM Titulos where nCdPessoa = $resp_cpf and nNossoNumero is null";
$resultado = consulta ( 'athenas', $query );
foreach ( $resultado as $registro ) {
	$nCdBoleto = $registro ['nCdBoleto'];
	$nosso_numero = gerarNossoNumero ( $nCdBoleto );
	
	$query = "UPDATE Titulos set nNossoNumero = '$nosso_numero' where nCdBoleto = $nCdBoleto";
	
	// echo $nCdBoleto." - ".$nosso_numero."<br/>";
	consulta ( 'athenas', $query );
}
header ( "location:rematricula5.php" );
?>
