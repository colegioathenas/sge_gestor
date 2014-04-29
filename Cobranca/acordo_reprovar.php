<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";
include_once "../Util/gravar_comunicacao.php";

$cpf = $_SESSION ['cpf'];

$acordo = $_REQUEST ['acordo'];
$motivo = $_REQUEST ['motivo'];
$motivo = str_replace ( "'", "\"", $motivo );

$query = "UPDATE acordo set nCdStatus = 99 where nCdAcordo = $acordo";

consulta ( "athenas", $query );

grava_comunicacao ( $cpf, $_SESSION ['nCdUsuario'], 2, "Acordo $acordo Reprovado.<br/>Motivo:$motivo<br/> Detalhes <a href=\"../Cobranca/acordo_detalhe.php?acordo=$acordo\"><u>clique aqui</u></a>" );
?>