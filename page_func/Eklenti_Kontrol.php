<?php
	if($serverinfo["ServerPluginCon"] == 1)  {

	$plugin_info = GetPluginList();
	$pluginsnames = array();

	if($plugin_info != false):
		foreach($plugin_info as $plugin) {
			$pluginsnames[] = $plugin["PluginFileName"];
		}
		$ssh2 = new ogcp_ssh2();
		if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
			$plugin_status = Plugin_GetStatus($ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/plugins.ini"),$pluginsnames);
		} else {
			foreach($pluginsnames as $plugname) {
				$plugin_status[$plugname] = 2;
			}
		}
		if((int)@$_GET["Kur"] != 0 && isset($plugin_info[(int)@$_GET["Kur"]]) ) {
			$pluginf = $plugin_info[(int)@$_GET["Kur"]];
			if($plugin_status[$pluginf["PluginFileName"]] == 0) {
				if($ssh2->SFTP_DownloadFile($serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/plugins.ini","tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini")) {
					$durum = Plugin_CopyDir("sistem/plugins/".pathinfo($pluginf["PluginFileName"],PATHINFO_FILENAME),$ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike"));
					$dosya_ac = fopen("tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini","a");
					if( $durum != false && fwrite($dosya_ac,"\r\n".$pluginf["PluginFileName"]."	; ".$pluginf["PluginName"]) && $ssh2->SFTP_UploadFile("tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini",$serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/plugins.ini")) {
						print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Eklenti Kuruldu!</div>');
						$plugin_status[$pluginf["PluginFileName"]] = 1;
					} else {
						print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Eklenti Kurulamadı!</div>');

					}
					@fclose($dosya_ac);
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Eklenti Kurulamadı!</div>');
				}
			}		
		} else if((int)@$_GET["Kaldir"] != 0 && isset($plugin_info[(int)@$_GET["Kaldir"]])) {
			$pluginf = $plugin_info[(int)@$_GET["Kaldir"]];
			if($plugin_status[$pluginf["PluginFileName"]] == 1) {
				if($ssh2->SFTP_DownloadFile($serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/plugins.ini","tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini")) {
					$dosya_ac = fopen("tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini","r");
					$icerik = "";
					while(!feof($dosya_ac)) $icerik .= fgets($dosya_ac,8192);
					@fclose($dosya_ac);
					$icerik = str_replace("\r\n".$pluginf["PluginFileName"]."	; ".$pluginf["PluginName"],"",$icerik);
					$icerik = str_replace($pluginf["PluginFileName"]."	; ".$pluginf["PluginName"]."\r\n","",$icerik);
					$icerik = str_replace("\r\n".$pluginf["PluginFileName"],"",$icerik);
					$icerik = str_replace($pluginf["PluginFileName"]."\r\n","",$icerik);
					$icerik = str_replace($pluginf["PluginFileName"],"",$icerik);
					$dosya_ac = fopen("tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini","w");
					if(fwrite($dosya_ac,$icerik) && $ssh2->SFTP_UploadFile("tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_plugins.ini",$serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/plugins.ini")) {
						print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Eklenti Kaldırıldı!</div>');
						$plugin_status[$pluginf["PluginFileName"]] = 0;
					} else {
						print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Eklenti Kaldırılamadı!</div>');
					}
					@fclose($dosya_ac);
				} else {
					print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Eklenti Kaldırılamadı!</div>');

				}

			}	
		}
	endif;
	} else {
		print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Eklenti Kur/Kaldır\'a girmek için izniniz bulunmamaktadır!</div>');
	}
?>