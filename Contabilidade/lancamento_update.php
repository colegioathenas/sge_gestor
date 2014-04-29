<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$conta = $_REQUEST ['conta'];
$data = $_REQUEST ['data'];
$descricao = $_REQUEST ['descricao'];
$ccusto = $_REQUEST ['ccusto'];
$valor = $_REQUEST ['valor'];
list ( $dia, $mes, $ano ) = explode ( "/", $data );
$dataSQL = "'$ano-$mes-$dia'";
$valor = str_replace ( ",", ".", str_replace ( ".", "", $valor ) );
$query = "insert into lancamento values (0,$conta,$dataSQL,'$descricao',$valor,$ccusto);";
consulta ( "athenas", $query );

echo $query;
/*
 * To change this template, choose Tools | Templates and open the template in the editor.
 */
?>
