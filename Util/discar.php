<?php
ini_set ( "display_errors", 1 );
// p address that asterisk is on.
$strHost = "192.168.0.106";
$strUser = "admin"; // pecify the asterisk manager username you want to login with
$strSecret = "123456"; // pecify the password for the above user
                       // pecify the channel (extension) you want to receive the call requests with
                       // .g. SIP/XXX, IAX2/XXXX, ZAP/XXXX, etc
$strChannel = "SIP/1010";
// $strChannel = "SIP\\".$_REQUEST['exten'];
$strContext = "from-internal";
// pecify the amount of time you want to try calling the specified channel before hangin up
$strWaitTime = "30";
// pecify the priority you wish to place on making this call
$strPriority = "1";
// pecify the maximum amount of retries
$strMaxRetry = "2";
$number = strtolower ( $_REQUEST ['number'] );
$pos = strpos ( $number, "local" );
if ($number == null) :
	exit ();

endif ;
if ($pos === false) :
	$errno = 0;
	$errstr = 0;
	$strCallerId = "Web Call $number";
	$oSocket = fsockopen ( "192.168.0.106", 5038, &$errno, &$errstr, 20 );
	if (! $oSocket) {
		echo "$errstr ($errno)<br>\n";
	} else {
		fputs ( $oSocket, "Action: login\r\n" );
		fputs ( $oSocket, "Events: off\r\n" );
		fputs ( $oSocket, "Username: $strUser\r\n" );
		fputs ( $oSocket, "Secret: $strSecret\r\n\r\n" );
		fputs ( $oSocket, "Action: originate\r\n" );
		fputs ( $oSocket, "Channel: SIP\\1010\r\n" );
		fputs ( $oSocket, "WaitTime: $strWaitTime\r\n" );
		fputs ( $oSocket, "CallerId: $strCallerId\r\n" );
		fputs ( $oSocket, "Exten: 1146573789\r\n" );
		fputs ( $oSocket, "Context: $strContext\r\n" );
		fputs ( $oSocket, "Priority: $strPriority\r\n\r\n" );
		fputs ( $oSocket, "Action: Logoff\r\n\r\n" );
		sleep ( 2 );
		fclose ( $oSocket );
	}
	echo "Extension $strChannel should be calling $number.";
 else :
	exit ();
endif;
?>