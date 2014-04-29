<?php
ini_set ( "display_errors", 0 );
include ('easy.curl.class.php');
include_once ('simple_html_dom.php');
include ('../geral.php');
function consulta_telein($telefone) {
	$chave = '0909d045b4b51394f6e0';
	$url = "http://consultanumero1.telein.com.br/sistema/consulta_numero.php?numero=$telefone&chave=$chave";
	$curl = new cURL ();
	
	$retorno = $curl->get ( $url );
	
	$retorno = explode ( "#", $retorno );
	$retorno = $retorno [0];
	
	switch ($retorno) {
		case '77' :
			$operador = 'NEXTEL';
			break;
		case '23' :
			$operador = 'TELEMIG';
			break;
		case '12' :
			$operador = 'CTBC';
			break;
		case '14' :
			$operador = 'BRASIL TELECOM';
			break;
		case '20' :
			$operador = 'VIVO';
			break;
		case '21' :
			$operador = 'CLARO';
			break;
		case '31' :
			$operador = 'OI';
			break;
		case '24' :
			$operador = 'AMAZONIA';
			break;
		case '37' :
			$operador = 'UNICEL';
			break;
		case '41' :
			$operador = 'TIM';
			break;
		case '81' :
			$operador = 'DATORA';
			break;
		case '98' :
			$operador = 'FIXO';
			break;
		case '99' :
		case '999' :
		case '995' :
		case '990' :
			$operador = '';
			break;
		
		default :
			
			break;
	}
	
	return $resultado = array (
			'operadora' => $operador 
	);
}

$ddd = $_REQUEST ['ddd'];
$telefone = $_REQUEST ['telefone'];

if ($telefone != "") {
	$telefone = $ddd . $telefone;
	$telefone = str_replace ( "(", "", $telefone );
	$telefone = str_replace ( ")", "", $telefone );
	$telefone = str_replace ( "-", "", $telefone );
	
	$res = consulta_telein ( $telefone );
	
	echo json_encode ( $res );
} else {
	echo "";
}

?>