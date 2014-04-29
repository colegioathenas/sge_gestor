<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include "email_enviar.php";
function geraSenha() {
	
	// caracteres que serão usados na senha randomica
	$chars = 'abcdxyswzABCDZYWSZ0123456789';
	// ve o tamnha maximo que a senha pode ter
	$max = strlen ( $chars ) - 1;
	// declara $senha
	$senha = null;
	
	// loop que gerará a senha de 8 caracteres
	for($i = 0; $i < 8; $i ++) {
		
		$senha .= $chars {mt_rand ( 0, $max )};
	}
	return $senha;
}

$codigo = $_REQUEST ['codigo'];
$senha = geraSenha ();

$query = "update pessoa set cSenha = '$senha', mudarsenha = 1 where nCdPessoa = $codigo;";
consulta ( "athenas", $query );

$query = "select cNome,cEmail,CASE WHEN IFNULL(nCpf,0) = 0 THEN rm ELSE nCPF END AS usuario from pessoa where nCdPessoa = $codigo";
$registros = consulta ( "athenas", $query );

$email = $registros [0] ["cEmail"];
$assunto = "Acesso ao Sistema";
$cpf = $codigo;
$cpf = preg_replace ( '#[^0-9]#', '', $cpf );
$comunicacao = "Senha enviada por e-mail";
$mensagem = "Acesso ao SGE - Sistema de Gestão Escolar.
			link: http://www.colegioathenas.com.br
		    Usuario: $cpf
		    Senha: $senha";

echo envia_email ( $email, $assunto, $mensagem, $cpf, $comunicacao );

?>