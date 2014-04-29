<?php
include ("easy.curl.class.php");
include_once ("simple_html_dom.php");

ini_set ( "display_errors", 0 );

$fn = "full_list.txt";
$f_contents = file ( $fn );
srand ( ( double ) microtime () * 1000000 );
$proxy = $f_contents [array_rand ( $f_contents )];

$proxy = explode ( ":", $proxy );
$proxy_addr = $proxy [0];
$proxy_port = $proxy [1];
$msg = "";
$proxy_addr = "";
$proxy_port = "";

$nb = $_REQUEST ["nb"];

$msglog = date ( "H:i" ) . " - " . $_SERVER ["REMOTE_ADDR"] . " - Solicitada consulta " . $nb;

$ckfile = "/tmp/inss.txt";

$parametros = array (
		"C_1" => "BAT00.33",
		"C_2" => "",
		"C_3" => $nb,
		// ,"C_4" => " (A-APS I-INTERNET) "
		// ,"C_5" => ""
		"layout" => "8,69,10",
		"submit" => "Transmite" 
);
$resultado = "";
$url = "http://www010.dataprev.gov.br/cws/bin/CWS91.asp?COMS_BIN/D.HISCNS";
$curl = new cURL ();
$html = $curl->post ( $url, $parametros, 

array (
		CURLOPT_PROXY => $proxy_addr,
		CURLOPT_PROXYPORT => $proxy_port,
		CURLOPT_COOKIEJAR => $ckfile,
		CURLOPT_HTTPHEADER => array (
				"User-Agent: Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2",
				"Origin: http://www010.dataprev.gov.br",
				"Referer: http://www010.dataprev.gov.br/cws/bin/CWS91.asp?COMS_BIN/D.HISCNS",
				"Connection: keep-alive" 
		),
		CURLOPT_SSL_VERIFYPEER => false 
) );
echo $html;
?>


