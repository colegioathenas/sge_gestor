<?php
function createActionList($server, $username, $secret, $port) {
	$socket = fsockopen ( $server, $port, $errno, $errstr, 1 );
	fputs ( $socket, "Action: Login\r\n" );
	fputs ( $socket, "UserName: $username\r\n" );
	fputs ( $socket, "Secret: $secret\r\n\r\n" );
	fputs ( $socket, "Action: ListCommands\r\n\r\n" );
	fputs ( $socket, "Action: Logoff\r\n\r\n" );
	$count = 0;
	$array;
	while ( ! feof ( $socket ) ) {
		$wrets = fgets ( $socket, 8192 );
		$token = strtok ( $wrets, ':(' );
		$j = 0;
		while ( $token != false & $count >= 5 ) {
			$array [$count] [$j] = $token;
			$j ++;
			$token = strtok ( ':(' );
		}
		$count ++;
		$wrets .= '<br>';
	}
	
	echo '<select name="managersAction">';
	for($i = 5; $i < $count - 4; $i ++) {
		echo '<option value="' . $array [$i] [0] . '">' . $array [$i] [1] . '</option>';
	}
	echo '</select>';
	fclose ( $socket );
}

createActionList ( "192.168.0.106", "admin", "123456", 5038 )?>

