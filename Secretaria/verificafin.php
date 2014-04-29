<pre>
<?php
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";
ini_set ( "display_errors", 0 );
// include("../Util/consulta_scpc.php");

$_SESSION ['dados_matricula'] = $_REQUEST;
$url = "matricula_concluir.php";
header ( "location:$url" );
/*
 * $codigo_aluno = $_REQUEST['aluno_codigo']; $codigo_respfin = $_REQUEST['respfin_codigo']; $_SESSION['dados_matricula'] = $_REQUEST; if ($codigo_aluno == ""){$codigo_aluno = 0;} if ($codigo_respfin == ""){ $codigo_respfin = 0; } $query = "call verifica_financeiro_matricula($codigo_aluno,$codigo_respfin);"; $resultado = consulta('athenas',$query); //print_r($resultado); $url = ""; if ( ($resultado[0]['QtdBolAbt'] > 0) || ($resultado[1]['QtdBolAbt'] > 0)){ $url = "procurar_financeiro.php"; if ($resultado[0]['QtdBolAbt'] > 0){ $url .="?param=01"; }else{ $url .="?param=02"; } }else{ $url = "matricula_concluir.php"; } header("location:$url");
 */
?>
</pre>