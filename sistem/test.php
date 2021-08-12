<?php 
	require_once('cs16_query.php');
	$server = new CS16_Query();
	$microtime = time();
	if($server->Connect("95.173.172.2",27015)) {
		echo "<pre>";
		$info = $server->Info(); 
		$players = $server->Players(); 
		$rules = $server->Rules(); 
		echo "</pre>";
		echo str_replace('\r','<br/>',$rcon);
		$server->RconPassword('170290');
		$players = $server->ServerInfo();
		$info["ip"] 		= $players["ip"];
		$info["hostname"] 	= $players["name"];
		$info["map"] 		= $players["map"];
		$info["players"] 	= $players["activeplayers"];
		$info["mplayers"] 	= $players["maxplayers"];
		unset($players["ip"],$players["name"],$players["map"],$players["mod"],$players["game"],$players["activeplayers"],$players["maxplayers"]);
		$tmp = $server->RconCommand("__sxei_required");
		$tmp = explode('"',$tmp);
		$rules['__sxei_required'] = @$tmp[3];
		$tmp2 = $server->RconCommand("amx_timeleft");
		$tmp2 = explode('"',$tmp2);
		$rules['amx_timeleft'] = @$tmp2[3];
		$tmp3 = $server->RconCommand("mp_timelimit");
		$tmp3 = explode('"',$tmp3);
		$rules['mp_timelimit'] = @$tmp3[3];
		$tmp4 = $server->RconCommand("mp_roundtime");
		$tmp4 = explode('"',$tmp4);
		$rules['mp_roundtime'] = @$tmp4[3];
		$tmp4 = $server->RconCommand("sv_password");
		$tmp4 = explode('"',$tmp4);
		if($info != false) print_r($info);
		if($players != false) print_r($players);
		if($rules != false) print_r($rules);
	} else { print("Sunucuya baglanilamadi!"); exit; }
	
	$microtime2 = time();
	
	echo ("<br/><br/>Total Time: ");
	print((float)$microtime2." - ".(float)$microtime);
?>