<?php
session_start ();
require_once ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
ini_set ( "display_errors", 0 );
function grava_comunicacao($cpf, $usuario, $tipo, $mensagem) {
	$query = "INSERT INTO Pessoa_Contato (nCdPessoa, nCdUsuario, dContato, nCdTpContato, cMensagem) VALUES($cpf,$usuario,NOW(),$tipo,'$mensagem');";
	consulta ( "athenas", $query );
	echo $query;
}

if ($_REQUEST ['tipo'] != '') {
	
	grava_comunicacao ( $_SESSION ['cpf'], $_SESSION ['nCdUsuario'], $_REQUEST ['tipo'], $_REQUEST ['mensagem'] );
	
	echo "Comunicacao Incluida com Sucesso!";
}

?>