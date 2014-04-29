<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );

$codigo = $_REQUEST ['codigo'];
$conta = $_REQUEST ['conta'];

$query = "UPDATE lancamento set bConciliado = 1, nCdContaContabil = $conta where nCdlancamento = $codigo";

echo $query;
consulta ( "athenas", $query );

?>