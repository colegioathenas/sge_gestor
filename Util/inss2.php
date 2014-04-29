<?php

/* Ler captcha */
require ('api/ccproto_client.php');

define ( 'HOST', "api.de-captcher.com" ); // YOUR HOST
define ( 'PORT', 8801 ); // YOUR PORT
define ( 'USERNAME', "overcrash" ); // YOUR LOGIN
define ( 'PASSWORD', "hw9zznixxqh0c" ); // YOUR PASSWORD

define ( 'PIC_FILE_NAME', "inss.jpg" );

$ccp = new ccproto ();
$ccp->init ();
$ccp->login ( HOST, PORT, USERNAME, PASSWORD );
$ccp->system_load ( $system_load );
$pict = file_get_contents ( PIC_FILE_NAME );
$pict_to = ptoDEFAULT;
$pict_type = ptUNSPECIFIED;
$res = $ccp->picture2 ( $pict, $pict_to, $pict_type, $text, $major_id, $minor_id );
$ccp->close ();

echo $text;

?>
