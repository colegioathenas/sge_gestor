<?php
function gravar_log($msg) {
	$filename = date ( "Ymd" ) . ".txt";
	$pagina = basename ( $_SERVER ['PHP_SELF'] );
	$fp = fopen ( "/log/$filename", "a" );
	
	// Escreve "exemplo de escrita" no bloco1.txt
	$escreve = fwrite ( $fp, date ( "d/m/Y h:i:s" ) . " - " . $pagina . "\n" );
	$escreve = fwrite ( $fp, $msg );
	
	// Fecha o arquivo
	fclose ( $fp );
}
?>