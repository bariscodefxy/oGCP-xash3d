<?php	
	$yetkiler = array(
		"a"	=> "Nick",
		"b"	=> "Nick",
		"ab"	=> "Nick",
		"c"	=> "SteamID",
		"ce"	=> "SteamID",
		"d"	=> "IP",
		"de"	=> "IP"
	);	
	
	$ssh2 = new ogcp_ssh2();
	if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
		$filelink = $ssh2->SFTP_FileLink($serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini');
	} else { $filelink = ""; }

	$admins = ReadAdmins($filelink);
	if((int)@$_GET["ID"] != 0 && isset($admins[(int)@$_GET["ID"]])) {
		if(@$_GET["Islem"] == "Sil") {
		$ssh2->SFTP_DownloadFile($serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini',"tmp/".$serverinfo["ServerIP"]."_".(int)$_SESSION["OGCP_UserID"]."_users.ini");
		if( deleteLine("tmp/".$serverinfo["ServerIP"]."_".(int)$_SESSION["OGCP_UserID"]."_users.ini",(int)$_GET["ID"]) ) {
			$copy = $ssh2->SFTP_UploadFile("tmp/".$serverinfo["ServerIP"]."_".(int)$_SESSION["OGCP_UserID"]."_users.ini",$serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini');
 			unlink("tmp/".$serverinfo["ServerIP"]."_".(int)$_SESSION["OGCP_UserID"]."_users.ini");
			if($copy) {
				print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$admins[(int)@$_GET["ID"]]["name"].'</strong> adlı admin silindi! </div>');
				$admins = ReadAdmins($filelink);
			} else {
				print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$admins[(int)@$_GET["ID"]]["name"].'</strong> adlı admin silinemedi! </div>');
			}
			
		} else {
			echo "Admin Silinemedi";
		}
		} else if(@$_GET["Islem"] == "Duzenle") {
			$page->GoLocation($page->CreatePageLink('Admin_Duzenle','ID='.@$_GET["ID"]));
		}
	}
	if($admins == false) { $admincount = 0; }
	else {
		$admincount = $admins["count"];
		unset($admins["count"]);
	}
	$ssh2->Disconnect();

	if(@$_GET["Durum"] == "Eklendi") {
		print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$_SESSION["OGCP_EklenenNick"].'</strong> adlı admin eklendi!</div>');
	} else if(@$_GET["Durum"] == "Eklenemedi") {
		print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.$_SESSION["OGCP_EklenenNick"].'</strong> adlı admin eklenemedi!</div>');
	}
	if(isset($_SESSION["OGCP_EklenenNick"])) unset($_SESSION["OGCP_EklenenNick"]);
?>