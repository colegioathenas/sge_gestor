<?php
include ('easy.curl.class.php');
require_once ("../config.php");
include_once "../bd.php";
include_once "../geral.php";
include_once "gravar_comunicacao.php";

$numero = $_REQUEST ['numero'];

$query = "insert into asterisk_inbound values(0,now(),'$numero',1);";

consulta ( "athenas", $query );

?>      