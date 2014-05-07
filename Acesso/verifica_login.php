<?php
ini_set ( "display_errors", 1 );
#include_once ("../config.php");
include_once "../bd.php";

$useragent = $_SERVER ['HTTP_USER_AGENT'];

if (preg_match ( '|MSIE ([0-9].[0-9]{1,2})|', $useragent, $matched )) {
	$browser_version = $matched [1];
	$browser = 'IE';
} elseif (preg_match ( '|Opera/([0-9].[0-9]{1,2})|', $useragent, $matched )) {
	$browser_version = $matched [1];
	$browser = 'Opera';
} elseif (preg_match ( '|Firefox/([0-9\.]+)|', $useragent, $matched )) {
	$browser_version = $matched [1];
	$browser = 'Firefox';
} elseif (preg_match ( '|Chrome/([0-9\.]+)|', $useragent, $matched )) {
	$browser_version = $matched [1];
	$browser = 'Chrome';
} elseif (preg_match ( '|Safari/([0-9\.]+)|', $useragent, $matched )) {
	$browser_version = $matched [1];
	$browser = 'Safari';
} else {
	// browser not recognized!
	$browser_version = 0;
	$browser = 'other';
}

if (($browser == 'Firefox') || ($browser == 'Chrome')) {
	
	session_start ();
	$login = $_REQUEST ['login'];
	$senha = $_REQUEST ['senha'];
	
	$query = "call valida_usuario('$login','$senha')";
	
	$resultado = consulta ( 'athenas', $query,true );
	
	if (count ( $resultado ) == 0) {
		# header ( "location:login.php?msg=err" );
	} else {
		$_SESSION ['nCdUsuario'] = $resultado [0] ['nCdUsuario'];
		$_SESSION ['usuario_nome'] = $resultado [0] ['cNmUsuario'];
		$_SESSION ['nCdGrupo'] = $resultado [0] ['nCdGrupo'];
		foreach ( $resultado as $registro ) {
			$_SESSION [$registro ['cId']] = $registro ['bVisualizar'] . $registro ['bEditar'] . $registro ['bIncluir'] . $registro ['bExcluir'] . $registro ['bAcessar'];
		}
		$_SESSION ['username'] = $login;
		if ($resultado [0] ['mudarsenha'] == "1") {
			header ( "location:alterar_senha.php" );
		} else {
			header ( "location:../index.php" );
		}
	}
} else {
	header ( "location:login.php?msg=nav" );
}
?>
