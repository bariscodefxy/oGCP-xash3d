<?php
if(isset($_POST['yardir'])) {
	$ssh2 = new ogcp_ssh2();
	if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
		$ssh2->SFTP_DownloadFile($serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini',"tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_users.ini");
		$filelink = "tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_users.ini";
	} else { $filelink = ""; }
	$oGCP['dosya']['hata'] = 0;
	$oGCP['dosya']['adminler'] = $filelink;
	$admins = ReadAdmins($filelink);
	foreach($admins as $admin) {
		if($admin["name"] == $_POST['nick']) { print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>Lütfen boş alan Bırakmayınız!! </div>'); $oGCP['dosya']['hata']=$oGCP['dosya']['hata']+1; break; }
	}

	if($oGCP['dosya']['hata']==0) {
		$oGCP['dosya']['yaz'] = fopen($oGCP['dosya']['adminler'],"a");
		$oGCP['yeni']['satir'] = "\r\n\"".$_POST["nick"]."\" \"".$_POST["sifre"]."\" \"".$_POST["yetki2"]."\" \"".$_POST["tur"]."\" // ".$_POST["aciklama"];
		if(fwrite($oGCP['dosya']['yaz'],$oGCP['yeni']['satir'])) {
			$_SESSION["OGCP_EklenenNick"] = $_POST["nick"];
			if( $ssh2->SFTP_UploadFile($filelink,$serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini') ) {
				unlink($oGCP['dosya']['adminler']);
				$page->GoLocation($page->CreatePageLink('Admin_Listesi','Durum=Eklendi'));
				$ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'amx_reloadadmins'^m\"");
			} else {
				unlink($oGCP['dosya']['adminler']);
				$page->GoLocation($page->CreatePageLink('Admin_Listesi','Durum=Eklenemedi'));
			}	
		} else {
			unlink($oGCP['dosya']['adminler']);
			$page->GoLocation($page->CreatePageLink('Admin_Listesi','Durum=Eklenemedi'));
		}
		
	}
}
?>