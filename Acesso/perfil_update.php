<?php
ini_set ( "display_errors", 1 );
setlocale ( LC_ALL, NULL );
setlocale ( LC_ALL, 'pt_BR' );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$perfil = $_REQUEST ['perfil'];
$acesso = $_REQUEST ['acesso'];
$acao = $_REQUEST ['acao'];

if ($acao == "00000") {
	$query = "delete from acesso_perfil where nCdPerfil = $perfil and nCdAcesso = $acesso";
} else {
	$query = "call perfil_acesso_update($acesso,$perfil,$acao[0],$acao[1],$acao[2],$acao[3],$acao[4]);";
}
consulta ( "athenas", $query );
echo $query;
?>
