<?php
session_start ();
if (! isset ( $_SESSION ['username'] )) {
	header ( "location:/Acesso/login.php" );
}
?>