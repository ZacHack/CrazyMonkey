<?php
/*
	CrazyMonkey is an IRCBot made by ZacHack
*/
set_time_limit(0);
ini_set('display_errors', 'on');
$config = array(
	'server' => 'irc.freenode.net',
	'port' => '6667',
	'nick' => 'CrazyMonkey',
	'name' => 'Rob',
	'pass' => 'cmhq',
	);
class CrazyMonkey{
	var $socket;
	var $ex = array();
	function __construct($config){
		$this->socket = fsockopen($config['server'], $config['port']);
		$this->login($config);
		$this->main();
		$this->send_data('JOIN', '#chat');
	}
	function login($config){
		$this->send_data('USER', $config['nick'].' google.com'.$config['nick'].' :'.$config['name']);
		$this->send_data('NICK', $config['nick']);
	}
	function main(){
		$data = fgets($this->socket, 128);
		echo nl2br($data);
		flush();
		$this->ex = explode(' ', $data);
		if($this->ex[0] == 'PING'){
			$this->send_data('PONG', $this->ex[1];
		}
		$command = str_replace(array(chr(10), chr(13)), '', $this->ex[3]);
		switch($command){
			case ':!join':
				$this->join_channel($this->ex[4]);
				break;
			case ':!quit':
				$this->send_data('QUIT', 'Disconnected');
				break;
			case ':!op':
				$this->op_user();
				break;
			case ':!deop':
				$this->op_user('','',false);
				break;
			case ':!speak'
				fputs($socket, "PRIVMSG It works!\n");
				break;
		}
		$this->main;
	}
