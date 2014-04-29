<?php
include ('easy.curl.class.php');
$curl = new cURL ();
$nb = $_REQUEST ['nb'];
$dn = $_REQUEST ['dn'];

list ( $dia, $mes, $ano ) = explode ( "/", $dn );
$dn = str_replace ( "/", "", $dn );

$nome = $_REQUEST ['nome'];
$cpf = $_REQUEST ['cpf'];
$hoje = $_REQUEST ['hoje'];
$captcha = $_REQUEST ['captcha'];

$parametros = array (
		"nb" => $nb,
		"DataNascimento" => $dn,
		"SIW_Contexto" => "HISCRE",
		"SIW_Transacao_Web" => "EXTRATO",
		"SIW_Window" => "SISBEN",
		"SIW_Layout" => "10,8",
		"at" => "1",
		"DiaNascimento" => $dia,
		"MesNascimento" => $mes,
		"AnoNascimento" => $ano,
		"nome" => $nome,
		"cpf" => $cpf,
		"txtImagem" => $captcha,
		"hoje" => $hoje 
);

$url = "http://www010.dataprev.gov.br/CWS/BIN/concal.asp";
$pagina = $curl->post ( $url, $parametros, array (
		CURLOPT_COOKIEFILE => "inss.txt",
		CURLOPT_REFERER => "http://www010.dataprev.gov.br/cws/contexto/hiscre/hiscrenet2.asp",
		CURLOPT_HTTPHEADER => array (
				"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8" 
		) 
) );

$fullpath = "$nb.html";

if (file_exists ( $fullpath )) {
	unlink ( $fullpath );
}
$fp = fopen ( $fullpath, 'x' );
fwrite ( $fp, $pagina );
fclose ( $fp );

?>
