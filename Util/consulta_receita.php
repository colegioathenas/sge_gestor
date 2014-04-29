
<?php
ini_set ( "display_errors", 1 );
include ('easy.curl.class.php');
include_once ('simple_html_dom.php');

$fase = $_REQUEST ['fase'];

if ($fase == 1) {
	$curl = new cURL ();
	$html = str_get_html ( $curl->get ( 'https://www.receita.fazenda.gov.br/Aplicacoes/ATCTA/CPF/ConsultaPublica.asp', array (
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_COOKIEJAR => 'cookie.txt' 
	) ) );
	// echo $html;
	
	$resultado = array (
			"img_src" => "https://www.receita.fazenda.gov.br" . str_replace ( "&amp;", "&", $html->find ( 'img[id=imgcaptcha]', 0 )->src ),
			"viewstate" => $html->find ( 'input[id=viewstate]', 0 )->value 
	);
	
	echo json_encode ( $resultado );
}

?>
