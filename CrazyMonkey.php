<?php

/*
This is an IRC Bot made by ZacHack
DO NOT Sell this product
DO NOT claim this product is yours
*/

//EDIT THIS PART
echo "Running CrazyMonkey version 1.0.0";
$config = array(
	"Server" => "irc.freenode.net",
	"RealName" => "Fred",
	"User" => "<Username>",
	"Nick" => "<Nickname>",
	"Pass" => "password",
	"Channel" => "#channel",
	"WolframAPI" => "<API key>",
	);
	$admins = ("<InsertAdminHere>", "InsertAdminHere");
$settings = array(
	"AROK" => "on",
	//AROK Stands for Auto Rejoin On Kick
	);
//STOP EDITING HERE
$server = $config['Server'];
$realname = $config['RealName'];
$user = $config['User'];
$nick = $config['Nick'];
$pass = $conifg['Pass'];
$channel = $config['Channel'];
$apikey = $config['WolframAPI'];
set_time_limit(0);
ini_set('display_errors', 'on');
sleep(5);
$socket = fsockopen($server, 6667);
fputs($socket, "USER ".$user." localhost ".$user." :".$realname."\r\n");
fputs($socket, "NICK ".$nick."\r\n");
fputs($socket, "JOIN :".$channel."\r\n");
fputs($socket, "PASS ".$pass."\r\n");
while(1){
	while($data = fgets($socket, 128)){
		echo $data;
		flush();
		$ex = explode(' ', $data);
		if($ex[0] == "PING"){
			fputs($socket, "PONG ".$ex[1]."\r\n");
		}
		if($settings['AROK'] == "on"){
			if($ex[1] == "KICK"){
				if($ex[3] == $nick){
					fputs($socket, "JOIN :".$ex[2]."\r\n");
					break;
				}
			}
		}
		$cmd = str_replace(array(chr(10), chr(13)), '', $ex[3]);
		if($cmd == ":!op"){
			if($ex[0] == ":".$admins[0]."" or $ex[0] == ":".$admins[1].""){
				fputs($socket, "MODE ".$ex[2]." +o ".$ex[4]."\r\n"):
				fputs($socket, "PRIVMSG ".$ex[2]." :Opped ".$ex[4]."\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		if($cmd == ":!deop"){
			if($ex[0] == ":".$admins[0]."" or ":".$admins[1].""){
				fputs($socket, "MODE ".$ex[2]." +o ".$ex[4]."\r\n");
				fputs($socket, "PRIVMSG ".$ex[2]." :Deopped ".$ex[4]."\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!shutdown"){
			if($ex[0] == $admins[0] or $ex[0] == $admins[1]){
				fputs($socket, "QUIT ".$quitmessage."\r\n");
				die("Terminated");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!join"){
			if($ex[0] == $admins[0] or $ex[0] == $admins[1]){
				fputs($socket, "JOIN ".$ex[4]."\r\n");
				fputs($socket, "PIVMSG ".$ex[2]." :Joined ".$ex[4]."\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!say"){
			$check = $ex[4];
			if($check[0] == "#"){
				$args = NULL; for ($i = 5; $i < count($ex); $i++) { $args .= $ex[$i] . ' '; }
				fputs($socket, "PRIVMSG ".$ex[4]." :".$args."\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :".$args."\r\n");
				break;
			}
		}
		if($cmd == ":!rage"){
			fputs($socket, "PRIVMSG ".$ex[2]." :(ノಠ益ಠ)ノ彡┻━┻ ┌( ಠ_ಠ)┘\r\n");
			break;
		}
		if($cmd == ":!kick"){
			if($ex[0] == $admins[0] or $ex[0] == $admins[1]){
				fputs($socket, "KICK ".$ex[2]." ".$ex[4]." :".$ex[4]."\r\n");
				fputs($socket, "PRIVMSG ".$ex[2]." :Kicked ".$ex[4]."\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!commands"){
			if($ex[0] == $admins[0] or $admins[1]){
				fputs($socket, "PRIVMSG ".$ex[2]." :Commands: !op, !deop, !kick, !join, !say, !kickbut, !shoot, !commands, !ban, !unban, !leave, !server, !wa, !lmgtfy\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :Commands: !say, !rage, !shoot, !commands, !server, !lmgtfy\r\n");
				break;
			}
		}
		if($cmd == ":!leave"){
			if($ex[0] == $admins[0] or $ex[0] == $admins[1]){
				if(isset($ex[4])){
					fputs($socket, "PART ".$ex[4]." :Bye!\r\n");
					fputs($socket, "PRIVMSG ".$ex[2]." :Left ".$ex[4]."\r\n");
					break;
				}else{
					fputs($socket, "PART ".$ex[2]." :Bye\r\n");
					break;
				}
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!ban"){
			if($ex[0] == $admins[0] or $ex[0] == $admins[1]){
				fputs($socket, "MODE ".$ex[2]." +b ".$ex[4]."\r\n");
				fputs($socket, "PRIVMSG ".$ex[2]." :".$ex[4]." you have been banned!\r\n");
				sleep(5);
				fputs($socket, "KICK".$ex[2]." ".$ex[4]." :".$ex[4]."\r\n");
				break;
			}else{
				fputs($socker, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!unban"){
			if($ex[0] == $admins[0] or $admins[1]){
				fputs($socket, "MODE ".$ex[2]." -b  ".$ex[4]."\r\n");
				break;
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!wolframalpha" or $cmd == ":!wa"){
			$args = NULL; for ($i = 4; $i < count($ex); $i++) { $args .= $ex[$i] . ' '; }
			if($ex[0] == $admins[0] or $ex[0] == $admins[1]){
				if($apikey == "<API key>"){
					fputs($socket, "PRIVMSG ".$ex[2]." :You have not put a WolframAlpha API key in\r\n");
					break;
				}
				fputs($socket, "PRIVMSG ".$ex[2]." :Checking on Wolfram Alpha for ".$args."\r\n");
				include_once "wa_wrapper/WolframAlphaEngine.php";
				$request = $args;
				$engine = new WolframAlphaEngine($apikey);
				$response = $engine->getResults($request);
				$pod = $response->getPods();
				$pod = $pod[1];
				if($response->isError){
					fputs($socket, "PRIVMSG ".$ex[2]." :There was an error\r\n");
					break;
				}
				foreach($pod->getSubpods() as $subpod){
					if($subpod->plaintext){
						$plaintext = $subpod->plaintext;
					}else{
						fputs($socket, "PRIVMSG ".$ex[2]." :The answer had no text\r\n");
						break;
					}
					$result = substr($plaintext, 0,strlen($plaintext)-3);
					fputs($socket, "PRIVMSG ".$ex[2]." :Results: ".$result."\r\n");
					break;
				}
			}else{
				fputs($socket, "PRIVMSG ".$ex[2]." :You cannot use this command\r\n");
				break;
			}
		}
		if($cmd == ":!server" or $cmd == ":!sv"){
			$ip = $ex[4];
			if(!isset($ex[5])){
				$port = "19132";
			}else{
				$port = $ex[5];
			}
			include_once "MinecraftQuery.class.php";
			$query = new MinecraftQuery();
			try{
				$query->connect($ip, $port);
				$info = $query->GetInfo();
				fputs($socket, "PRIVMSG ".$ex[2]." :[".$info['HostName']."] is ONLINE with ".$info['Players']."/".$info['MaxPlayers']." players on minexraft version ".$info['Version']."\r\n");
				break;
			}
			catch(MinecraftQueryExpection $e){
				fputs($socket, "PRIVMSG ".$ex[2]." :The server is offline\r\n");
				break;
			}
		break;
		}
		if($cmd == ":!lmgtfy"){
			$args = NULL; for ($i = 4; $i < count($ex); $i++) { $args .= $ex[$i] . ' '; }
			$text = str_replace(" ", "+", $args);
			fputs($socket, "PTIVMSG ".$ex[2]." :Link http://lmgtfy.com/?q=".$text."\r\n");
			break;
		}
	}
}
