<?php
$hostname = '{imap.gmail.com:993/imap}';
$username = 'antonio@institutoathenas.net';
$password = '125469';

/* try to connect */
$inbox = imap_open ( $hostname, $username, $password ) or die ( 'Cannot connect to Gmail: ' . imap_last_error () );

?>