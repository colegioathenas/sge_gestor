<?php
session_start ();
if (! isset ( $_SESSION ['username'] )) {
	header ( "location:/acesso/login.php" );
}
?>