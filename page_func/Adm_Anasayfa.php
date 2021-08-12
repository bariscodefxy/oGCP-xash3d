<?php 
	$stats = Adm_GetSystemStats();
	$maxslot = Adm_GetServersMaxSlot();
	
	if(@$_GET["Islem"] != "" && $userinf["UserGroup"] > 2) {
		switch(@$_GET["Islem"]) {
			case "Sunuculari_Durdur": {
				echo "<pre>";
				Adm_StopAllServers();
				echo "</pre>";
				break;
			}
			case "Sunuculari_Calistir": {
				echo "<pre>";
				Adm_StartAllServers();
				echo "</pre>";
				break;
			}
			case "Sunuculari_YenidenBaslat": {
				echo "<pre>";
				Adm_ReStartAllServers();
				echo "</pre>";
				break;
			}
		}
	}
?>