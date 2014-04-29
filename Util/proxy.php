<pre>
<?php
ini_set ( "display_errors", "On" );
include ('easy.curl.class.php');
include_once ('simple_html_dom.php');

$curl = new cURL ();

$url = "http://ninjaproxies.com/proxies/api/?key=1371311525326623194137131152513713115254332290&fields=ip+portNum+type+protocol&speed=fast&bandwidth=fast+medium&uptime=71-100&alive=1&protocol=http+socks5&limit=1&order=random";
$resultado = $curl->get ( $url );
$proxy = json_decode ( $resultado );
print_r ( $proxy->data [0]->Proxy->ip );
?>
</pre>