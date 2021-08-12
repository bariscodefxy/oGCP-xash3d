<?php 
	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Sunucular'));
	$machinff = Adm_GetServer((int)@$_GET["ID"]);
	if($machinff == false) $page->GoLocation($page->CreatePageLink('Adm_Sunucular'));
	$server = $machinff[(int)@$_GET["ID"]];
	$machines = Adm_GetMachineList();
	$packets = Adm_GetPacketList();
	$users = Adm_GetServerUsers((int)@$_GET["ID"]);
	
	if(isset($_POST["ogcp_editserver"])) {
		if(@$_POST["server_ip"] == "")	$_POST["server_ip"] = $server["ServerIP"];
		if((int)@$_POST["server_port"] <= 0 || (int)@$_POST["server_port"] > 65535)	$_POST["server_port"] = (int)$machine["ServerPort"];
		if((int)@$_POST["server_mach"] <= 0) 	$_POST["server_mach"] = $server["ServerMachID"];
		if((int)@$_POST["server_packet"] <= 0) 	$_POST["server_packet"] = $server["ServerPacket"];
		if(@$_POST["server_map"] == "")	$_POST["server_map"] = $server["ServerMap"];
		if((int)@$_POST["server_maxslot"] <= 9) 	$_POST["server_maxslot"] = $server["ServerMaxPlayers"];
		if(@$_POST["server_path"] == "")	$_POST["server_path"] = $server["ServerPath"];
		
		if(Adm_UpdateServer((int)@$_GET["ID"],addslashes($_POST["server_ip"]),(int)$_POST["server_port"],(int)$_POST["server_mach"],(int)$_POST["server_packet"],addslashes($_POST["server_map"]),(int)$_POST["server_maxslot"],addslashes($_POST["server_path"]))) {
			$server["ServerIP"] = $_POST["server_ip"];
			$server["ServerPort"] = $_POST["server_port"];
			$server["ServerMachID"] = $_POST["server_mach"];
			$server["ServerPacket"] = $_POST["server_packet"];
			$server["ServerMap"] = $_POST["server_map"];
			$server["ServerMaxPlayers"] = $_POST["server_maxslot"];
			$server["ServerPath"] = $_POST["server_path"];
			echo "Sunucu güncellendi!";
		} else {
			echo "Sunucu güncellenemedi!";
		}
	}
	
		if(isset($_GET["Islem"])) {
			$bul = array(
				"Screen", "Ip", "Port", "Map", "Maxslot"
			);
			$degistir = array(
				$server["Screen"], $server["ServerIP"], $server["ServerPort"], $server["ServerMap"], $server["ServerMaxPlayers"]
			);
			$serverinfo["QStart"] = str_replace($bul,$degistir,$server["QStart"]);
			$serverinfo["QStop"] = str_replace($bul,$degistir,$server["QStop"]);
		$ssh2 = new ogcp_ssh2();
		if($ssh2->ConnectwAuth($server["MachIP"],$server["MachPort"],$server["MachUser"],$server["MachPass"])) {
		switch($_GET["Islem"]) {
			case "Sunucu_Calistir": {
				$shell = $ssh2->Exec('cd '.$server["ServerPath"].'; '.$serverinfo["QStop"].'; '.$serverinfo["QStart"]);
				if($shell != false) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Sunucu başlatıldı!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Sunucu başlatılamadı!</div>');
				}
				@fclose($shell);
				break;
			}
			case "Sunucu_YenidenCalistir": {
				$shell = $ssh2->Exec('cd '.$server["ServerPath"].'; '.$serverinfo["QStop"].'; '.$serverinfo["QStart"]);
				if($shell != false) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Sunucu yeniden başlatıldı!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Sunucu yeniden başlatılamadı!</div>');
				}
				@fclose($shell);
				break;
			}
			case "Sunucu_Durdur": {
				$shell = $ssh2->Exec($serverinfo["QStop"]);
				if($shell != false) {
					print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Sunucu durduruldu!</div>');
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Sunucu durduruldu!</div>');
				}
				@fclose($shell);
				break;
			}
			case "Sunucu_Yonet": {
				$_SESSION["OGCP_SelectedServer"] = (int)$_GET["ID"];
				$page->GoLocation($page->CreatePageLink('Adm_Anasayfa'));
			}
		}
		} else {
			print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> SSH2 bağlantısı kurulamadı!</div>');
		}
		if(@$_GET["Islem"] == "SunucuSil" && isset($users[(int)@$_GET["SID"]])) {
			$del_query = $baglan->prepare("DELETE FROM ogcp_userservers WHERE UserServerID=".intval($_GET["SID"])."; DELETE FROM ogcp_tickets WHERE TicketServerID = ".intval($_GET["SID"]));
			$del_query->execute();
			if($del_query->rowCount() > 0) {
				unset($users[(int)$_GET["SID"]]);
				echo "Kullanıcıdan Sunucu Silindi!";
			} else {
				echo "Kullanıcıdan Sunucu Silinemedi!";
			}
		}
	}
?>