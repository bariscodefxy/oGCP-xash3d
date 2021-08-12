<?php
	$ssh2 = new ogcp_ssh2();
	if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
		$icerik = stream_get_contents($ssh2->Exec('cd '.$serverinfo["ServerPath"].'; tail -15 screenlog.0'));
	} else {
		$icerik = "";
	}
	if(isset($_POST["yardir"])) {
		$_POST["komut"] = strip_tags(htmlspecialchars(addslashes($_POST["komut"])));
		$durum = false;
		$bad_commands = array(
		"screen","-dr","-X","quit","shutdown","exit",";","sv_password","sv_password","sv_downloadurl","hostname","rcon_password","sv_contact","sv_maxrate","sv_minrate","sv_maxupdaterate","sv_minupdaterate","sys_ticrate","fps_max","fps_modem"
		);
		for($i=0; $i < count($bad_commands); $i++) {
			if(strpos($_POST["komut"],$bad_commands[$i]) !== false) { $durum = true; break; }
		}
		$komut = "screen -S \"{$serverinfo["Screen"]}\" -X -p0 eval \"stuff '{$_POST["komut"]}'^m\"";
		if(!$durum) {
			$shell = @$ssh2->Exec($komut);
		} else {
			$shell = false;
		}
		if($shell != false) {
			print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> '.$_POST["komut"].' komutu gonderildi!</div>');
			$icerik = stream_get_contents(@$ssh2->Exec('cd '.$serverinfo["ServerPath"].'; tail -15 screenlog.0'));
		} else {
			print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> '.$_POST["komut"].' komutu gonderilemedi!</div>');
		}
	}
?>