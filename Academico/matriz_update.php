<?php
require ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "../Util/gravar_comunicacao.php";
ini_set ( "display_errors", 0 );
session_start ();

$codigo = $_REQUEST ["codigo"];
$nome = $_REQUEST ["nome"];
$curso = $_REQUEST ["curso"];
$validade = $_REQUEST ["validade"];

list ( $dia, $mes, $ano ) = explode ( "/", $validade );

$validadeSQL = "$ano-$mes-$dia";

$query = "call matriz_update($codigo,'$nome',$curso,'$validadeSQL');";

$retorno = consulta ( 'athenas', $query );

echo $retorno [0] ['codigo'];
?>