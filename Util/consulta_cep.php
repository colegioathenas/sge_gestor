<?php
ini_set ( "display_errors", 0 );
include ('easy.curl.class.php');
include_once ('simple_html_dom.php');
include ('../geral.php');
session_start ();
function busca_cep_republica($cep) {
	$cep = str_replace ( ".", "", $cep );
	$cep = str_replace ( "-", "", $cep );
	
	$curl = new cURL ();
	
	$url = "http://www.republicavirtual.com.br/web_cep.php?formato=json&cep=$cep";
	
	return $curl->get ( $url );
}
function consulta_cep_correios($parametro) {
	$curl = new cURL ();
	$url = "http://www.buscacep.correios.com.br/servicos/dnec/index.do";
	$curl->get ( $url, array (
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_COOKIEJAR => "$usuario.txt" 
	) );
	
	$url = 'http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do';
	
	$html = str_get_html ( $curl->post ( $url, $parametro, array (
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_COOKIEFILE => "$usuario.txt" 
	) ) );
	
	$url = "http://www.buscacep.correios.com.br/servicos/dnec/detalheCEPAction.do";
	$parametro = array (
			'Metodo' => 'detalhe',
			'Posicao' => '1',
			'TipoCep' => '2',
			'CEP' => '' 
	);
	$html = str_get_html ( $curl->post ( $url, $parametro, array (
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_COOKIEFILE => "$usuario.txt" 
	) ) );
	
	/*
	 * $url = "file:///Users/antonio/Downloads/consulta_cep.php.html"; $html = str_get_html( $curl->get($url, array (CURLOPT_SSL_VERIFYPEER => false,CURLOPT_COOKIEJAR => 'cookie.txt' )));
	 */
	
	$logradouro = $html->find ( 'table', 1 )->find ( 'td', 1 )->plaintext;
	$bairro = $html->find ( 'table', 1 )->find ( 'td', 3 )->plaintext;
	$cidade_uf = $html->find ( 'table', 1 )->find ( 'td', 5 )->plaintext;
	$cep_f = $html->find ( 'table', 1 )->find ( 'td', 7 )->plaintext;
	
	$cidade_uf_array = explode ( "/", $cidade_uf );
	$cidade = $cidade_uf_array [0];
	$uf = $cidade_uf_array [1];
	$cep = str_replace ( "-", "", $cep_f );
	
	$resultado = array (
			'logradouro' => converte ( $logradouro ),
			'bairro' => converte ( $bairro ),
			'cidade' => converte ( $cidade ),
			'uf' => converte ( $uf ),
			'cidade_uf' => converte ( $cidade_uf ),
			'cep' => converte ( $cep ) 
	);
}

$usuario = $_SESSION ['username'];

$cep = $_REQUEST ['cep'];

$cidade = $_REQUEST ['cidade'];
$logradouro = $_REQUEST ['logradouro'];

// if ($fase == 1){

if ($cep == "") {
	$parametro = array (
			'UF' => 'SP',
			'Localidade' => $cidade,
			'Tipo' => '',
			'Logradouro' => $logradouro,
			'Numero' => '',
			'cfm' => 1,
			'Metodo' => 'listaLogradouro',
			'TipoConsulta' => 'logradouro',
			'StartRow' => '1',
			'EndRow' => '10' 
	);
	$resultado = consulta_cep_correios ( $parametro );
	echo json_encode ( $resultado );
} else {
	$parametro = array (
			'CEP' => $cep,
			'Metodo' => 'listaLogradouro',
			'TipoConsulta' => 'cep',
			'StartRow' => '1',
			'EndRow' => '10' 
	);
	$resultado_busca = busca_cep_republica ( $cep );
	
	$res = json_decode ( $resultado_busca, true );
	
	$cod_res = $res ['resultado'];
	
	switch ($cod_res) {
		case '1' :
		case '2' :
			echo $resultado_busca;
			break;
		
		default :
			$resultado = consulta_cep_correios ( $parametro );
			echo json_encode ( $resultado );
			break;
	}
}

// }

?>
