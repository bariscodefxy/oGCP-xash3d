<?php
$server = new Rcon();
$ssh2 = new ogcp_ssh2();
if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
	$dir = $ssh2->SFTP_FileLink($serverinfo["ServerPath"].'/cstrike/maps/');
	$filelink = $ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike/server.cfg");
} else { 
	$dir = "";
	$filelink = "";
}

$maps = array();

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      if(pathinfo($file, PATHINFO_EXTENSION) == "bsp") $maps[substr($file,0,strlen($file) - 4)] = substr($file,0,strlen($file) - 4);
    }
    closedir($dh);
  }
}

if(isset($maps[@$_GET["map"]])) {
	$rconpass = CFG_GetVariable($filelink,array( 'rcon_password' ));
	$rconpass = @$rconpass['rcon_password'][0][1];

	if($server->Connect($serverinfo["ServerIP"],$serverinfo["ServerPort"],$rconpass)) {
		$komut = "screen -S \"{$serverinfo["Screen"]}\" -X -p0 eval \"stuff 'changelevel {$_GET["map"]}'^m\"";
		$durum = false;
		if(!$durum) {
			$shell = @$ssh2->Exec($komut);
		} else {
			$shell = false;
		}
		if($shell != false) {
			print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> '.$_GET["map"].' haritası açıldı!</div>');
		} else {
			print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> '.$_GET["map"].' haritası açılamadı!</div>');
		}
	}
}

?>