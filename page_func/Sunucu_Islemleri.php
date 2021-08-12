<?php 
	$bul = array(
		"Screen", "Ip", "Port", "Map", "Maxslot"
	);

	$degistir = array(
		$serverinfo["Screen"], $serverinfo["ServerIP"], $serverinfo["ServerPort"], $serverinfo["ServerMap"], $serverinfo["ServerMaxPlayers"]
	);

	$serverinfo["QStart"] = str_replace($bul,$degistir,$serverinfo["QStart"]);
	$serverinfo["QStop"] = str_replace($bul,$degistir,$serverinfo["QStop"]);
	if(isset($_GET["Islem"])) {
		$ssh2 = new ogcp_ssh2();
		if($ssh2->ConnectwAuth($serverinfo["MachIP"],$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
		switch($_GET["Islem"]) {
			case "IP_Temizle": {
				if( unlink($ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike/listip.cfg")) ) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Yasaklanmış IP\'ler temizlendi!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Yasaklanmış IP\'ler temizlenemedi!</div>');
				}		
				break;
			}
			case "ID_Temizle": {
				if( unlink($ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike/banned.cfg")) ) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Yasaklanmış ID\'ler temizlendi!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Yasaklanmış ID\'ler temizlenemedi!</div>');
				}
				break;
			}
			case "Sunucu_Restart": {
				$shell = $ssh2->Exec('cd '.$serverinfo["ServerPath"].'; '.$serverinfo["QStop"].'; '.$serverinfo["QStart"]);
				if($shell != false) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Sunucunuz yeniden başlatıldı!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Sunucunuz yeniden başlatılamadı!</div>');
				}
				@fclose($shell);
				break;
			}
			case "Admin_Yenile": {
				$shell = $ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'amx_reloadadmins'^m\"");
				if($shell != false) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Adminler yenilendi!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Adminler yenilenemedi!</div>');
				}
				break;
			}
			case "Reset_Top15": {
				$shell = $ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'csstats_reset 1; changelevel {$serverinfo["ServerMap"]};'^m\"");
				if($shell != false) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> TOP15 sıfırlandı!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> TOP15 sıfırlanamadı!</div>');
				}
				break;
			}

		}
		}
	}
?>