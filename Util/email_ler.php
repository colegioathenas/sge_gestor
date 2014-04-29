<pre>
<?php
$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = 'atendimento@colegioathenas.com.br';
$password = 'senha123';

/* try to connect */
$inbox = imap_open ( $hostname, $username, $password ) or die ( 'Cannot connect to Gmail: ' . imap_last_error () );

/* grab emails */
$emails = imap_search ( $inbox, 'UNSEEN', 1 );

if ($emails) {
	
	/* begin output var */
	$output = '';
	
	/* put the newest emails on top */
	rsort ( $emails );
	
	/* for every email... */
	foreach ( $emails as $email_number ) {
		
		/* get information specific to this email */
		$overview = imap_fetch_overview ( $inbox, $email_number, 0 );
		$message = imap_fetchbody ( $inbox, $email_number, 2 );
		
		print_r ( $overview );
		print_r ( $message );
	}
	
	echo $output;
}

/* close the connection */
imap_close ( $inbox );
?>
</pre>