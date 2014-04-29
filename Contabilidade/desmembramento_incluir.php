<?php
include ("../verifica_logado.php");
ini_set ( "display_errors", 0 );
require ("../config.php");
include_once "../bd.php";

$descricao = $_REQUEST ['descricao'];
$valor = $_REQUEST ['valor'];
$lancamento_pai = $_REQUEST ['lancamento'];

$query = "SELECT nCdContaCorrente,dLancamento from lancamento where nCdLancamento = $lancamento_pai";

$resultado = consulta ( "athenas", $query );

$conta = $resultado [0] ['nCdContaCorrente'];
$data = date ( "Y-m-d", strtotime ( $resultado [0] ['dLancamento'] ) );

$query = "INSERT INTO lancamento(nCdContaCorrente,dLancamento,cDescricao,nValor,nCdLancamentoPai) 
			 VALUES ($conta,'$data','$descricao',$valor,$lancamento_pai)";

consulta ( "athenas", $query );

echo "<td>$descricao</td><td>$valor</td>";

?>