<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";

ini_set ( "display_errors", 0 );
function atualiza_pessoa($rm, $nome, $endereco, $complemento, $cep, $cidade, $bairro, $uf, $rg, $cpf, $datanascimento, $naturalidade, $naturalidadeUF, $nacionalidade, $email, $pai, $mae, $respfin, $profissao, $estadocivil, $cepcom, $endcom, $bairrocom, $cidadecom, $ufcom, $codigo, $incluir = false) {
	if (trim ( $rm ) == "") {
		$rm = "0";
	}
	
	if (trim ( $datanascimento ) == "") {
		$datanascimento = "null";
	} else {
		$datanascimento = str_replace ( "/", "", $datanascimento );
		$datanascimento = "'" . substr ( $datanascimento, 4, 4 ) . "-" . substr ( $datanascimento, 2, 2 ) . "-" . substr ( $datanascimento, 0, 2 ) . "'";
	}
	
	if (trim ( $respfin ) == "") {
		$respfin = 'null';
	} else {
		$respfin = str_replace ( ".", "", $respfin );
		$respfin = str_replace ( "-", "", $respfin );
	}
	
	if (trim ( $cpf ) == "") {
		$cpf = 'null';
	} else {
		$cpf = str_replace ( ".", "", $cpf );
		$cpf = str_replace ( "-", "", $cpf );
	}
	
	if (trim ( $cep ) == "") {
		$cep = null;
	} else {
		$cep = str_replace ( "-", "", $cep );
	}
	if (trim ( $cepcom ) == "") {
		$cepcom = 'null';
	} else {
		$cepcom = str_replace ( "-", "", $cepcom );
	}
	$codigo = ereg_replace ( "[^0-9]", "", $codigo );
	if (! $incluir) {
		$query = "
		UPDATE `athenas`.`pessoa`
		SET
		rm = $rm,
		`cNome` = '$nome',
		`cLogradouro` = '$endereco',
		`cComplelemnto` = '$complemento',
		`nCEP` = $cep,
		`cCidade` = '$cidade',
		`cBairro` = '$bairro',
		`cUF` = '$uf',
		`cRG` = '$rg',
		`nCPF` = $cpf,
		`dNasc` = $datanascimento,
		`cNaturalidade` = '$naturalidade',
		`cNaturalidadeUf` = '$naturalidadeUF',
		`cNacionalidade` = '$nacionalidade',
		`cEmail` = '$email',
		`cFiliacaoPai` = '$pai',
		`cFiliacaoMae` = '$mae',
		`nCdRespFin` = $respfin,
		`cProfissao` = '$profissao',
		`nCdEstadoCivil` = '$estadocivil',
		`cEnd_com_cep` = $cepcom,
		`cEnd_com_end` = '$endcom',
		`cEnd_com_bairro` = '$bairrocom',
		`cEnd_com_cidade` = '$cidadecom',
		`cEnd_com_uf` = '$ufcom'	
		WHERE nCdPessoa='$codigo';
		";
	} else {
		$query = "INSERT INTO `athenas`.`pessoa`
	            (`nCdPessoa`,
	             `cNome`,
	             `cLogradouro`,
	             `cComplelemnto`,
	             `nCEP`,
	             `cCidade`,
	             `cBairro`,
	             `cUF`,
	             `cRG`,
	             `nCPF`,
	             `dNasc`,
	             `cNaturalidade`,
	             `cNaturalidadeUf`,
	             `cNacionalidade`,
	             `cEmail`,
	             `cFiliacaoPai`,
	             `cFiliacaoMae`,
	             `nCdRespFin`,
	             `cProfissao`,
	             `nCdEstadoCivil`,
	             `cEnd_com_cep`,
	             `cEnd_com_end`,
	             `cEnd_com_bairro`,
	             `cEnd_com_cidade`,
	             `cEnd_com_uf`,rm)
	VALUES ('$codigo',
	        '$nome',
	        '$endereco',
	        '$complemento',
	        '$cep',
	        '$cidade',
	        '$bairro',
	        '$uf',
	        '$rg',
	        '$cpf',
	        $datanascimento,
	        '$naturalidade',
	        '$naturalidadeUF',
	        '$nacionalidade',
	        '$email',
	        '$pai',
	        '$mae',
	        '$respfin',
	        '$profissao',
	        '$estadocivil',
	        '$cepcom',
	        '$endcom',
	        '$bairrocom',
	        '$cidadecom',
	        '$ufcom', '$rm'
		);";
	}
	
	consulta ( "athenas", $query );
}
?>


