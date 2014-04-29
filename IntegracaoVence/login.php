<?php
include ("../verifica_logado.php");
header ( 'Content-Type: text/html; charset=utf-8' );
function logarVence() {
	include_once ('../Util/easy.curl.class.php');
	include_once ('../Util/simple_html_dom.php');
	
	$curl = new cURL ();
	$curl->post ( "http://www.vence.sp.gov.br/remt/av/", array (
			"username" => "ffsilva",
			"password" => "123456",
			"Submit" => "Acessar" 
	), array (
			CURLOPT_COOKIEJAR => "ckvence.txt" 
	) );
}
function verificaLogin($html) {
	include_once ('../Util/simple_html_dom.php');
	$dom = new simple_html_dom ();
	$dom->load ( $html );
	if (count ( $dom->find ( "input[name=username]" ) ) == 0) {
		return true;
	} else {
		return false;
	}
}
?>