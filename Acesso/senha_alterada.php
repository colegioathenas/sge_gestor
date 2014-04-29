<?php
ini_set ( "display_errors", 0 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$senha = $_REQUEST ['senha'];
$nova_senha = $_REQUEST ['nova_senha'];
$nCdUsuario = $_SESSION ['nCdUsuario'];

$query = "SELECT cSenha FROM Usuario where nCdUsuario = $nCdUsuario;";

$registro = consulta ( 'athenas', $query );

$senha_atual = $registro [0] ['cSenha'];

if ($senha == $senha_atual) {
	$query = "UPDATE Usuario set cSenha = '$nova_senha', mudarsenha = 0 where nCdUsuario = $nCdUsuario ";
	consulta ( 'athenas', $query );
	echo "Senha Alterada com Sucesso";
} else {
	echo "Senha Atual Invalida";
}

?>