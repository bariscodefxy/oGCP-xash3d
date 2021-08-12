<?php

if((int)@$_GET["ID"] == 0) $page->GoLocation($page->CreatePageLink('Admin_Listesi'));

$ssh2 = new ogcp_ssh2();
if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
	$ssh2->SFTP_DownloadFile($serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini',"tmp/".$serverinfo["ServerIP"]."_".(int)$_SESSION["OGCP_UserID"]."_users.ini");
	$filelink = "tmp/".$serverinfo["ServerIP"]."_".(int)$_SESSION["OGCP_UserID"]."_users.ini";
} else { $filelink = ""; }
$oGCP['dosya']['hata'] = 0;
$oGCP['dosya']['adminler'] = $filelink;
$admins = ReadAdmins($filelink);

if(!isset($admins[$_GET["ID"]])) $page->GoLocation($page->CreatePageLink('Admin_Listesi'));

if(isset($_POST['yardir'])) {
		if(@$_POST["nick"] == "") $page->GoLocation($page->CreatePageLink('Admin_Duzenle','ID='.$_GET["ID"]."&Durum=Duzenlenemedi"));

		$text = array(
			intval($_GET["ID"]) => "\"".$_POST["nick"]."\" \"".$_POST["sifre233"]."\" \"".$_POST["yetki2"]."\" \"".$_POST["tur"]."\" //".$_POST["aciklama"]
		);
		if(changeLine($oGCP['dosya']['adminler'],$text) && $ssh2->SFTP_UploadFile($oGCP['dosya']['adminler'],$serverinfo["ServerPath"].'/cstrike/addons/amxmodx/configs/users.ini') ) 
		{
			unlink($oGCP['dosya']['adminler']);
			$ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'amx_reloadadmins'^m\"");
			$page->GoLocation($page->CreatePageLink('Admin_Duzenle','ID='.$_GET["ID"]."&Durum=Duzenlendi"));
		} else {
			unlink($oGCP['dosya']['adminler']);
			$page->GoLocation($page->CreatePageLink('Admin_Duzenle','ID='.$_GET["ID"]."&Durum=Duzenlenemedi"));
		}
}

unlink($filelink);
?>