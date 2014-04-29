<?
session_start ();
/* Insira aqui a pasta que deseja salvar o arquivo */
$uploaddir = "/tmp/";

$uploadfile = $uploaddir . $_FILES ['arquivo'] ['name'];
$_SESSION ["filename"] = $uploadfile;

if (move_uploaded_file ( $_FILES ['arquivo'] ['tmp_name'], $uploadfile )) {
	header ( "location:processar_retorno.php" );
} else {
}

?>
