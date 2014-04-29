<?php
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";
/*
 * funcionario : $("#codigo").val(), marcacao : $("#apontamento_marcacao").val(), esatual : $("#apontamento_esatual").val(), esnovo : $("#agendamento_es").val(), horario : $("#apontamento_horario").val(), ocorrencia : $("#agendamento_tpOcorrencia").val(), acao : $("#apontamento_acao").val()
 */

$funcionario = $_REQUEST ['funcionario'];
$marcacao = $_REQUEST ['marcacao'];
$esnovo = $_REQUEST ['esnovo'];
$esatual = $_REQUEST ['esatual'];
$horario = $_REQUEST ['horario'];
$ocorrencia = $_REQUEST ['ocorrencia'];
$acao = $_REQUEST ['acao'];
$data = $_REQUEST ['data'];

$campoNovoES = "";
switch ($esnovo) {
	case "E1" :
		$campoNovoES = "dEntrada1";
		break;
	case "E2" :
		$campoNovoES = "dEntrada2";
		break;
	case "E3" :
		$campoNovoES = "dEntrada3";
		break;
	case "S1" :
		$campoNovoES = "dSaida1";
		break;
	case "S2" :
		$campoNovoES = "dSaida2";
		break;
	case "S3" :
		$campoNovoES = "dSaida3";
		break;
}

$campoAtualES = "";
switch ($esatual) {
	case "E1" :
		$campoAtualES = "dEntrada1";
		break;
	case "E2" :
		$campoAtualES = "dEntrada2";
		break;
	case "E3" :
		$campoAtualES = "dEntrada3";
		break;
	case "S1" :
		$campoAtualES = "dSaida1";
		break;
	case "S2" :
		$campoAtualES = "dSaida2";
		break;
	case "S3" :
		$campoAtualES = "dSaida3";
		break;
}

if ($acao == "I") {
	
	if ($marcacao == "0") {
		$query = "insert into marcacao (nCdFuncionario,dMarcacao,$campoAtualES,nCdTpMarcacao$esatual,nCdOcorrencia$esatual) values ($funcionario,'$data','$horario',2,$ocorrencia) ";
	} else {
		$query = "update marcacao set $campoAtualES = '$horario', nCdTpMarcacao$esatual = 2, nCdOcorrencia$esatual = $ocorrencia where nCdMarcacao = $marcacao";
	}
}

if ($acao == "M") {
	$query = "update marcacao set $campoNovoES = $campoAtualES, nCdTpMarcacao$esnovo = nCdTpMarcacao$esatual, nCdOcorrencia$esnovo = nCdOcorrencia$esatual ,
                                      $campoAtualES = null, nCdTpMarcacao$esatual = null, nCdOcorrencia$esnovo = null
                where nCdMarcacao = $marcacao";
}

if ($acao == "D") {
	$query_marcacoes = "select hMarcacao1,hMarcacao2,hMarcacao3,hMarcacao4,hMarcacao5,hMarcacao6,hMarcacao7,hMarcacao8 from marcacao where nCdMarcacao = $marcacao";
	$resultado_marcacoes = consulta ( "athenas", $query_marcacoes );
	$marcacoes = $resultado_marcacoes [0];
	$i = 1;
	while ( $i <= 8 ) {
		if (date ( "H:i", strtotime ( $marcacoes ["hMarcacao$i"] ) ) == $horario) {
			$query_desconsidera_marcacao = ", nCdTpMarcacao$i = 3, nCdOcorrencia$i = $ocorrencia ";
			$i = 9;
		}
		$i ++;
	}
	
	$query = "update marcacao set $campoAtualES = null, nCdTpMarcacao$esatual = null, nCdOcorrencia$esatual = null $query_desconsidera_marcacao where nCdMarcacao = $marcacao";
}
echo $query;
consulta ( "athenas", $query );
?>

