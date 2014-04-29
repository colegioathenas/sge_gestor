<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Pessoa/pessoa_funcoes.php";

$professor_codigo = $_REQUEST ['idchange'];
if ($professor_codigo == "1") {
	$incluir_professor = true;
}
$professor_codigo = ereg_replace ( "[^0-9]", "", $_REQUEST ['professor_cpf'] );
atualiza_pessoa ( null, $_REQUEST ['professor_nome'], $_REQUEST ['professor_endereco_res'], $_REQUEST ['professor_endereco_complemento_res'], $_REQUEST ['professor_cep_res'], $_REQUEST ['professor_cidade'], $_REQUEST ['professor_bairro'], $_REQUEST ['professor_uf'], $_REQUEST ['professor_rg'], $_REQUEST ['professor_cpf'], $_REQUEST ['professor_dt_nasc'], $_REQUEST ['professor_naturalidade'], $_REQUEST ['professor_naturalidade_uf'], $_REQUEST ['professor_nacionalidade'], $_REQUEST ['professor_email'], $_REQUEST ['professor_pai'], $_REQUEST ['professor_mae'], $_REQUEST ['professor_cpf'], $_REQUEST ['professor_profissao'], $_REQUEST ['professor_estcivil'], $_REQUEST ['professor_cep_com'], $_REQUEST ['professor_endereco_com'], $_REQUEST ['professor_bairro_com'], $_REQUEST ['professor_cidade_com'], $_REQUEST ['professor_uf_com'], $professor_codigo, $incluir_professor );

$catEI = getRequest ( "catEI", "0" );
$catF1 = getRequest ( "catF1", "0" );
$catF2 = getRequest ( "catF2", "0" );
$catEM = getRequest ( "catEM", "0" );
$catTC = getRequest ( "catTC", "0" );

$query_verifica_professor = "SELECT * FROM professor WHERE nCPF = $professor_codigo";
if (count ( consulta ( "athenas", $query_verifica_professor ) ) == 0) {
	$query_atualiza_professor = "INSERT INTO professor(nCPF,bTecnico,bInfantil,bFundI,bFundII,bMedio) VALUES ($professor_codigo,$catTC,$catEI,$catF1,$catF2,$catEM)";
} else {
	$query_atualiza_professor = "UPDATE professor
										SET bTecnico = $catTC
										  , bInfantil = $catEI
										  , bFundI = $catF1
										  , bFundII = $catF2
										  , bMedio = $catEM
									  WHERE nCPf = $professor_codigo";
}

consulta ( "athenas", $query_atualiza_professor );

?>