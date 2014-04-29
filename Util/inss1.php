
<?php
function save_image($img, $fullpath) {
	$ch = curl_init ( $img );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			"Accept: image/png,image/*;q=0.8,*/*;q=0.5",
			"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0",
			"Accept-Language: en-US,en;q=0.5",
			// "Accept-Encoding: gzip, deflate"
			"Connection: keep-alive" 
	) );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_BINARYTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_REFERER, "https://www8.dataprev.gov.br/SipaINSS/pages/hiscre/hiscreInicio.xhtml" );
	curl_setopt ( $ch, CURLOPT_COOKIEFILE, "inss.txt" );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
	
	$proxy = '192.168.0.128:8888';
	$proxyauth = 'ftg.4245843922:12546987';
	
	curl_setopt ( $ch, CURLOPT_PROXY, $proxy );
	// url_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
	
	$rawdata = curl_exec ( $ch );
	curl_close ( $ch );
	if (file_exists ( $fullpath )) {
		unlink ( $fullpath );
	}
	$fp = fopen ( $fullpath, 'x' );
	fwrite ( $fp, $rawdata );
	fclose ( $fp );
}
?>
<?php

ini_set ( "display_errors", 1 );
include ('easy.curl.class.php');
include_once ("simple_html_dom.php");

$img = "inss.jpg";
$proxy = '192.168.0.128:8888';
$curl = new cURL ();

$url = "https://www8.dataprev.gov.br/SipaINSS/pages/hiscre/hiscreInicio.xhtml";
$html = $curl->get ( $url, array (
		CURLOPT_COOKIEJAR => "inss.txt",
		CURLOPT_PROXY => $proxy,
		// , CURLOPT_PROXYUSERPWD => $proxyauth
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_HTTPHEADER => array (
				"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0",
				"Accept: text/html",
				"Accept-Language: en-US,en;q=0.5",
				"Accept-Encoding: identity",
				"Connection: keep-alive" 
		) 
) );

echo "<pre>";
print_r ( $curl );
$dom = str_get_html ( $html );
$DTPINFRA_TOKEN = $dom->find ( "input[name=DTPINFRA_TOKEN]", 0 )->value;
$ViewState = $dom->find ( "input[name=javax.faces.ViewState]", 0 )->value;
$url = "https://www8.dataprev.gov.br" . $dom->find ( "img[id=captcha]", 0 )->src;
$coockie = file_get_contents ( "inss.txt" );
echo $html;
echo "DTPINFRA_TOKEN = $DTPINFRA_TOKEN<br/>ViewState = $ViewState<br/>Cookie=$coockie";
echo "</pre>";

// $url = "https://www8.dataprev.gov.br/SipaINSS/faces/resource/$DTPINFRA_TOKEN/CAPTCHA.xhtml?rsrc=captcha";
save_image ( $url, $img );
$coockie = file_get_contents ( "inss.txt" );
echo "<pre>";
echo "$url<br/><img src='inss.jpg'/><br/>Cookie=$coockie";
echo "</pre>";

/*
 * require( 'api/ccproto_client.php' ); define( 'HOST',		"api.de-captcher.com"	);	// YOUR HOST define( 'PORT',		8801		);	// YOUR PORT define( 'USERNAME',	"overcrash"	);	// YOUR LOGIN define( 'PASSWORD',	"hw9zznixxqh0c");	// YOUR PASSWORD define( 'PIC_FILE_NAME',	"inss.jpg"	); $ccp = new ccproto(); $ccp->init(); $ccp->login( HOST, PORT, USERNAME, PASSWORD ); $ccp->system_load( $system_load ); $pict = file_get_contents( PIC_FILE_NAME ); $pict_to	= ptoDEFAULT; $pict_type	= ptUNSPECIFIED; $res = $ccp->picture2( $pict, $pict_to, $pict_type, $text, $major_id, $minor_id ); $ccp->close();
 */
$text = 'abcde';

$url = "https://www8.dataprev.gov.br/SipaINSS/pages/hiscre/hiscreResultado.xhtml";
echo "<br/>" . $text;

$nb = "0000001430";
$dia = "27";
$mes = "10";
$ano = "1945";
$nome = "MATILDE MADALENA SCHAEFFER";
$cpf = "14371634834";
$captcha = $text;
$parametros = array (
		"formPrincipal" => "formPrincipal",
		"DTPINFRA_TOKEN" => $DTPINFRA_TOKEN,
		"nb" => $nb,
		"dia" => $dia,
		"mes" => $mes,
		"ano" => $ano,
		"nome" => $nome,
		"cpf" => $cpf,
		"captchaId" => $captcha,
		"botaoConfirmar" => "Visualizar",
		"javax.faces.ViewState" => $ViewState 
);

$pagina = $curl->post ( $url, $parametros, array (
		CURLOPT_COOKIEJAR => "inss.txt",
		CURLOPT_PROXY => $proxy,
		CURLOPT_REFERER => "https://www8.dataprev.gov.br/SipaINSS/pages/hiscre/hiscreInicio.xhtml",
		CURLOPT_HTTPHEADER => array (
				"User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:26.0) Gecko/20100101 Firefox/26.0",
				"Accept: text/html,application/xhtml+xml",
				"Accept-Language: en-US,en;q=0.5",
				// , "Accept-Encoding: gzip, deflate"
				"Connection: keep-alive" 
		),
		CURLOPT_SSL_VERIFYPEER => false 
) );

echo "<pre>";
$coockie = file_get_contents ( "inss.txt" );
print_r ( $curl );
print_r ( $curl->options );
echo "<br/>Cookie Depois=$coockie";
echo "</pre>";
echo "<h1>Resultado</h1>";
echo $pagina;

?>



