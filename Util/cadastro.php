<?php
include ("../geral.php");
require ("../config.php");
include_once "../bd.php";
include ("../Util/easy.curl.class.php");
include_once ("../Util/simple_html_dom.php");
ini_set ( "display_errors", 1 );

$parametros = array (
		"C_1" => "BLH00.12",
		"C_2" => "",
		"C_3" => "1430",
		"layout" => "8,69,10",
		"submit" => "Transmite" 
);
$header = array (
		"User-Agent: Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2",
		"Accept: text/html",
		"Origin: http://www3.dataprev.gov.br",
		"Referer: http://www3.dataprev.gov.br/cws/bin/cws91.asp",
		"Accept-Language: pt-BR",
		// ,"Accept-Encoding: gzip, deflate"
		"Pragma: no-cache",
		"Connection: keep-alive" 
);

$url = "http://www3.dataprev.gov.br/cws/bin/cws91.asp?COMS_BIN/HELP";
$curl = new cURL ();

$html = $curl->get ( $url, 

array (
		CURLOPT_COOKIEJAR => "/tmp/hiscon",
		CURLOPT_HTTPHEADER => $header,
		CURLOPT_PROXY => "60.222.224.135:8888",
		CURLOPT_SSL_VERIFYPEER => false 
) );
echo $html;

/*
 * $curl = new cURL(); $parametros = array( "C_1" => "STP05.01" , "C_2" => "BLH01.12" , "C_3" => str_pad($pagina - 1,2,"0",STR_PAD_LEFT) , "C_4" => "" , "C_5" => str_pad($nb,10,"0",STR_PAD_LEFT) , "C_6" => str_pad($pagina,2,"0",STR_PAD_LEFT) , "C_7" => "" , "layout" => "8,8,2,69,10,2,1" , "submit" => "Transmite" ); $header = array("User-Agent: Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2" ,"Accept: text/html" ,"Origin: http://www010.dataprev.gov.br" ,"Referer: http://www010.dataprev.gov.br/cws/bin/imagem91.asp" ,"Accept-Language: pt-BR" //,"Accept-Encoding: gzip, deflate" ,"Pragma: no-cache" ,"Connection: keep-alive" ,"Connection: keep-alive"); $html = $curl->post( $url , $parametros , array( CURLOPT_COOKIEFILE => "/tmp/hiscon" , CURLOPT_REFERER => $url , CURLOPT_HTTPHEADER => $header ) ); echo $html;
 */
?>