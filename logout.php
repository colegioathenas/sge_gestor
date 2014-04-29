<?php
session_start ();
session_destroy ();
header ( "location:/Acesso/login.php" );
?>