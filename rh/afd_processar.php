<?php
function cmp($a, $b) {
	return strcmp ( $a->Chave, $b->Chave );
}
$inicio = $_REQUEST ['inicio'];
$fim = $_REQUEST ['fim'];
include ("../Classes/cAFD.class.php");
$filename = "/alfandega/afd.txt";
$AFD = new AFD ();
$AFD->processar_arquivo ( $filename, $inicio, $fim );

echo "Processado!";

/*
 * $a = $AFD->Empregado[0]; usort($AFD-> Empregado,"cmp"); foreach($AFD->Empregado as $emp){ echo "call update_pis(".$emp->PIS.",'".$emp->Nome."');<br/>"; } /* echo "<pre>"; echo "<h1>Cabecalho</h1>"; print_r($AFD->Header); echo "<h1>Empresa</h1>"; print_r($AFD->Empresa); echo "<h1>Empregado</h1>"; print_r($AFD-> Empregado); echo "<h1>Relogio</h1>"; print_r($AFD->Relogio); echo "<h1>Marcacao</h1>"; print_r($AFD->Maracoes); echo "</pre>";
 */

?>
