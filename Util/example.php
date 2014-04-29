<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 1 );
require ("../config.php");
include_once "../bd.php";
include_once "gravar_comunicacao.php";

grava_comunicacao ( $_SESSION ['cpf'], $_SESSION ['nCdUsuario'], 1, 'Enviado Boleto por e-mail' );

?>