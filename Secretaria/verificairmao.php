<?php
include ("../verifica_logado.php");
if ($_REQUEST ['irmaomat'] == 1) {
	header ( "location:rematricula3.php" );
} else {
	header ( "location:rematricula4.php" );
}
?>