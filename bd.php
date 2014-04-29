<?php
function gravar_log($msg) {
	$filename = date ( "Ymd" ) . ".txt";
	$pagina = basename ( $_SERVER ['PHP_SELF'] );
	$fp = fopen ( "/log/$filename", "w" );
	
	// Escreve "exemplo de escrita" no bloco1.txt
	$escreve = fwrite ( $fp, "-- " . date ( "d/m/Y h:i:s" ) . " - " . $pagina . "\n" );
	$escreve = fwrite ( $fp, $msg . "\n" );
	
	// Fecha o arquivo
	fclose ( $fp );
}
function consulta($database, $sql, $debug = false) {
	ini_set ( "display_errors", 1 );
	include 'config.php';
	
	$file_debug = true;
	
	$database = strtolower ( $database );
	
	$mysqli = new mysqli ( $BD_SERVIDOR, $BD_USUARIO, $BD_SENHA, $database );
	
	$mysqli->query ( "SET NAMES 'utf8'" );
	$mysqli->query ( 'SET character_set_connection=utf8' );
	$mysqli->query ( 'SET character_set_client=utf8' );
	$mysqli->query ( 'SET character_set_results=utf8' );
	
	if ($debug) {
		print_r ( $sql );
	}
	if ($debug) {
	}
	if ($file_debug) {
		gravar_log ( $sql );
	}
	// ni_set( "display_errors", 1);
	// cho "<pre>";print_r($sql);echo "</pre>";#/*
	
	if ($query = $mysqli->query ( $sql )) {
		while ( $row = mysqli_fetch_assoc ( $query ) ) {
			$rows [] = $row;
		}
		// rint_r($mysqli);
		if ($debug) {
			print_r ( $mysqli );
		}
		$mysqli->close ();
	}
	// rint_r($query);
	if ($debug) {
		print_r ( $query );
	}
	return $rows;
}

?>
