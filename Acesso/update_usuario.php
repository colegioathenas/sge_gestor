<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$codigo = $_REQUEST ['usuario_codigo'];
$login = $_REQUEST ['usuario_login'];
$nome = $_REQUEST ['usuario_nome'];
$senha = $_REQUEST ['usuario_senha'];
$perfil = $_REQUEST ['usuario_perfil'];

if ($codigo == 0) {
	$query = "INSERT INTO Usuario (cLogin,cNmUsuario,cSenha,nCdPerfil) VALUES ('$login','$nome','$senha',$perfil)";
} else {
	$query = "UPDATE Usuario SET cLogin = '$login', cNmUsuario = '$nome', nCdPerfil = $perfil ";
	if ($senha != "") {
		$query .= ", cSenha = '$senha' ";
	}
	$query .= "WHERE nCdUsuario = $codigo";
}

consulta ( 'athenas', $query );
header ( "location:../index.php" );
?>
