<?php
include ('easy.curl.class.php');
require_once ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "gravar_comunicacao.php";

ini_set ( "display_errors", 1 );

$numero = $_REQUEST ['numero'];
$texto = $_REQUEST ['texto'];
$cpf = $_REQUEST ['cpf'];
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$curl = new cURL ();

$url_login = "http://webapi.comtele.com.br/api/api_fuse_connection.php?fuse=get_id&user=60697&pwd=instathenas";
$id_login = trim ( $curl->get ( $url_login, array (
		CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0" 
) ) );

echo "<pre>";
print_r ( $curl );
echo "</pre>";
/*
 * $msg = urlencode($texto); echo "url_login: ".$url_login."<br/>"; echo "id_login: ".$id_login."<br/>"; $url_msg = "http://webapi.comtele.com.br/api/api_fuse_connection.php?fuse=send_msg&id=$id_login&from=1146512729&msg=$msg&number=$numero"; $id_msg = trim($curl->get($url_msg)); echo "url_msg: '".$url_msg."<br/>"; echo "id_msg: ".$id_msg."<br/>"; if ($id_msg == 'true'){ grava_comunicacao($cpf,$_SESSION['nCdUsuario'],1,"Enviado SMS para $numero. - Mensgem: $texto"); echo "Enviado com sucesso! <br/>"; }else{ echo "Erro no envio. <br/>Erro id = $id_msg"; }
 */
?>      
