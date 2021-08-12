<?php
	//$sxe_status = array(-2 => 'Bilinmiyor', -1 => "<span style='color:red;'>Kapalı</span>", 0 => "<span style='color:orange;'>Opsiyonel</span>", 1 => "<span style='color:green;'>Açık</span>", "<span style='color:lightgreen;'>Fake sXe</span>");
	$controlstatus = array( '<span style="color:red;">Kapalı</span>','<span style="color:green;">Açık</span>');
	$plugincon = $controlstatus[$serverinfo["ServerPluginCon"]];
	$ftpcon = $controlstatus[$serverinfo["ServerFTPCon"]];
	$server = new Rcon();
	$ssh2 = new ogcp_ssh2();
	if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
		$filelink = $ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike/server.cfg");
	} else {
		$filelink = "";
	}

	$rconpass = CFG_GetVariable($filelink,array( 'rcon_password' ));
	$rconpass = @$rconpass['rcon_password'][0][1];

	if($server->Connect($serverinfo["ServerIP"],$serverinfo["ServerPort"],$rconpass)) {
		if(isset($_POST["ban"])) {
			$shell = $ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'kick \"{$_POST["username"]}\";wait;wait;addip 0 \"{$_POST["address"]}\"'^m\"");
			if($shell != false) {
				print('Ban atildi!');
			} else {
				print('Ban atilamadi!');
			}
		}
		if(isset($_POST["kick"])) {
			$shell = $ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'kick \"{$_POST["username"]}\";'^m\"");
			if($shell != false) {
				print('Kick atildi!');
			} else {
				print('Kick atilamadi!');
			}
		}
		$swinfo  = $server->ServerInfo();
		$players = $server->Players();
		$info["ip"] 		= $swinfo["ip"];
		$info["hostname"] 	= $swinfo["name"];
		$info["map"] 		= $swinfo["map"];
		$info["players"] 	= sizeof($players);
		$info["mplayers"] 	= $swinfo["maxplayers"];
		$info["port"]		= $swinfo["port"];
		if( $swinfo != false) {
			$sxe = $server->GetCvar("__sxei_required");
			$rules['__sxei_required'] = $sxe == "<span style='color:red'>-----</span>"; //  ? $sxe : $sxe_status[$server->GetCvar("__sxei_required")];
			$rules['amx_timeleft'] = $server->GetCvar("amx_timeleft");
			$rules['mp_timelimit'] = $server->GetCvar("mp_timelimit");
			$rules['mp_roundtime'] = $server->GetCvar("mp_roundtime");
			$info['password'] = $server->GetCvar("sv_password");
			//unset($players["ip"],$players["name"],$players["map"],$players["mod"],$players["game"],$players["activeplayers"],$players["maxplayers"]);
		} else {
			$info["ip"]		= $info["ip"].":".$info["port"];
			$info["hostname"] 	= $info["hostname"] == "" ? "<span style='color:red'>Sunucu Kapalı</span>" : @$info["hostname"];
			$info["map"]		= $info["map"] == "" ? "<span style='color:red'>-----</span>" : @$info["map"];
 			$info["mplayers"]	= 0;
			$info["mplayers"]	= $serverinfo["ServerMaxPlayers"];
			$rules['__sxei_required'] = "<span style='color:red'>-----</span>";
			$rules['amx_timeleft'] = "<span style='color:red'>-----</span>";
			$rules['mp_timelimit'] = "<span style='color:red'>-----</span>";
			$rules['mp_roundtime'] = "<span style='color:red'>-----</span>";
			$info['password'] = "";
		}
	}
?>
