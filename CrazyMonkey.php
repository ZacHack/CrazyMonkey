<?php
/* 
This is an IRC Bot made by ZacHack
DO NOT Sell this product
DO NOT claim this product is yours
*/
set_time_limit(0);
ini_set('display_errors', 'on');
$socket = fsockopen('irc.rizon.net', 6668);
fputs($socket, "USER CrazyMonkey localhost CrazyMonkey :Billy");
fputs($socket, "NICK CrazyMonkey");
fputs($socket, "JOIN :#ZacHackbotesting");
fputs($socket, "PASS cmhq");
while(1){
	while($data = fgets($socket, 128)){
		echo $data;
		flush();
		$ex = explode(' ', $data);
		if($ex[0] == "PING"){
			fputs($socket, "PONG ".$ex[1]."");
		}
		$cmd = str_replace(array(chr(10), chr(13)), '', $ex[3]);
		if($cmd == ":!sayit"){
			fputs($socket, "PRIVMSG ".$ex[2]." it works");
		}
	}
}
