<pre>
<?php
ini_set ( "display_errors", 0 );
include ("../verifica_logado.php");
require ("../config.php");
include_once "../bd.php";

$usuario = $_SESSION ['nCdUsuario'];
$solicitacao = $_REQUEST ['solicitacao'];
$fase_atual = $_REQUEST ['fase_atual'];
$subfase_atual = $_REQUEST ['subfase_atual'];
$observacao = $_REQUEST ['observacao'];
$fase_proxima = $_REQUEST ['fase_proxima'];
$processo = $_REQUEST ['processo'];
$lista = $_REQUEST ['lista'];
$ID = $_REQUEST ['id'];
$subfase_concluido = $_REQUEST ['subfase_concluido'];

$query_esteira = array ();
if ($subfase_concluido == "F") {
	/*
	 * $query_esteira[] = "UPDATE solicitacao_fluxo SET nCdUsuario = $usuario WHERE nCdSolicitacao = $solicitacao AND nCdFase = $fase_atual AND dFluxo = ( SELECT * FROM ( SELECT MAX(dFluxo) FROM solicitacoa_fluxo WHERE nCdSolicitacao = $solicitacao AND nCdFase = $fase_atual ) AS tbx ) ;";
	 */
	$query_esteira [] = "INSERT INTO solicitacao_fluxo VALUES($solicitacao,NOW(),$fase_atual,'F',$usuario,'$observacao');";
} else {
	/*
	 * $query_esteira[] = "UPDATE solicitacao_fluxo SET cObservacao = '$observacao' WHERE nCdSolicitacao = $solicitacao AND nCdFase = $fase_atual AND dFluxo = ( SELECT * FROM ( SELECT MAX(dFluxo) FROM solicitacoa_fluxo WHERE nCdSolicitacao = $solicitacao AND nCdFase = $fase_atual ) AS tbx ) ;";
	 */
}
$query_esteira [] = "INSERT INTO solicitacao_fluxo(nCdSolicitacao,dFluxo,nCdFase,cSubFase,cObservacao,nCdUsuario) VALUES($solicitacao,DATE_ADD( NOW(), INTERVAL 1 SECOND),$fase_proxima,'I','$observacao',$usuario);";

switch ($ID) {
	case "COMPRA" :
		$itens = explode ( ";", $lista );
		foreach ( $itens as $item ) {
			if ($item != "") {
				$cod_qtd = explode ( "|", $item );
				$cod = $cod_qtd [0];
				$qtd = $cod_qtd [1];
				$query_esteira [] = "UPDATE compra SET nQtdApr = CASE WHEN cFase = 'A' THEN $qtd ELSE nQtdApr END , nQtdCpr = CASE WHEN cFase = 'C' THEN $qtd ELSE nQtdCpr END WHERE nCdCompra = $cod;";
			}
		}
		
		break;
}
$query_processo = "";
switch ($processo) {
	case "BloqueiaQtdApr" :
		$query_esteira [] = "update compra set cFase = 'C' where nCdSolicitacao = $solicitacao";
		break;
	case "BloqueiaQtdCpr" :
		$query_esteira [] = "update compra set cFase = 'D' where nCdSolicitacao = $solicitacao";
		break;
}

foreach ( $query_esteira as $query_atualiza ) {
	consulta ( "athenas", $query_atualiza );
}

?>
</pre>