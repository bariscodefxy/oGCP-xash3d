<?php 
	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Duyurular'));
	$machinff = Adm_GetAnnouncement((int)@$_GET["ID"]);
	if($machinff == false) $page->GoLocation($page->CreatePageLink('Adm_Duyurular'));
	$duyuru = $machinff[(int)@$_GET["ID"]];
	
	if(isset($_POST["ogcp_updateannoun"])) {
		if(@$_POST["duyuru_baslik"] == "")	$_POST["duyuru_baslik"] = $duyuru["AnnouncementTT"];
		if(@$_POST["duyuru_icerik"] == "") 	$_POST["duyuru_icerik"] = $duyuru["AnnouncementContent"];
		
		if(Adm_UpdateAnnouncement((int)@$_GET["ID"],$_POST["duyuru_baslik"],$_POST["duyuru_icerik"])) {
			$duyuru["AnnouncementTT"] = $_POST["duyuru_baslik"];
			$duyuru["AnnouncementCont"] = $_POST["duyuru_icerik"];
			echo "Duyuru güncellendi!";
		} else {
			echo "Duyuru güncellenemedi!";
		}
	}
?>