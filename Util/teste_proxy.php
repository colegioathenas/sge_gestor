<pre>
<?php
$search = array (
		"'<script[^>]*?>.*?</script>'si", // Strip out javascript
		
		"'<[/!]*?[^<>]*?>'si", // Strip out HTML tags
		                       
		// "'([rn])[s]+'", // Strip out white space
		
		"'&(quot|#34);'i", // Replace HTML entities
		
		"'&(amp|#38);'i",
		
		"'&(lt|#60);'i",
		
		"'&(gt|#62);'i",
		
		"'&(nbsp|#160);'i",
		
		"'&(iexcl|#161);'i",
		
		"'&(cent|#162);'i",
		
		"'&(pound|#163);'i",
		
		"'&(copy|#169);'i",
		
		"'&#(d+);'e" 
); // evaluate as php

$replace = array (
		"",
		
		"",
		
		// "\1",
		
		"\"",
		
		"&",
		
		"<",
		
		">",
		
		" ",
		
		chr ( 161 ),
		
		chr ( 162 ),
		
		chr ( 163 ),
		
		chr ( 169 ),
		
		"chr(\1)" 
);
include ("easy.curl.class.php");
include_once ("simple_html_dom.php");

ini_set ( "display_errors", 0 );
/*
 * $fn = "full_list.txt"; $f_contents = file ($fn); srand ((double)microtime()*1000000); $proxy = $f_contents[ array_rand ($f_contents) ]; $proxy = explode(":",$proxy); $proxy_addr = $proxy[0]; $proxy_port = $proxy[1]; $msg = ""; $proxy_addr= ""; $proxy_port = "";
 */

$nb = $_REQUEST ["nb"];

$msglog = date ( "H:i" ) . " - " . $_SERVER ["REMOTE_ADDR"] . " - Solicitada consulta " . $nb;

$ckfile = "/tmp/inss.txt";

$parametros = array (
		"C_1" => "BLR00.11",
		"C_2" => "",
		"C_3" => $nb,
		"layout" => "8,69,10",
		"submit" => "Transmite" 
);
$resultado = "";

$curl = new cURL ();
// socks5
$url = "http://ninjaproxies.com/proxies/api/?key=1371311525326623194137131152513713115254332290&fields=ip+portNum+type+protocol&speed=fast&bandwidth=fast+medium&uptime=71-100&alive=1&protocol=http&limit=1&order=random";
$resultado = $curl->get ( $url );
$proxy = json_decode ( $resultado );

$proxy_ip = $proxy->data [0]->Proxy->ip;
$proxy_port = $proxy->data [0]->Proxy->portNum;
$proxy_prot = $proxy->data [0]->Proxy->protocol;

echo "$proxy_ip:$proxy_port";

$url = "http://www010.dataprev.gov.br/cws/bin/CWS91.asp?COMS_BIN/D.HISCNS";
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
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_PROXY => $proxy_ip,
		CURLOPT_PROXYPORT => $proxy_port 
// , CURLOPT_PROXYTYPE => $proxy_prot == "socks5" ? CURLPROXY_SOCKS5 : CURLPROXY_SOCKS5
) );
echo preg_replace ( $search, $replace, $html );
?>
</pre>