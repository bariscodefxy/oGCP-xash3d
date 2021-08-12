<?php
	$announcements = GetAnnouncementsList();
	if(@$_GET["Islem"] == "Sil" && (int)@$_GET["ID"] != 0 && isset($announcements[(int)@$_GET["ID"]]) ) {
		$del_query = $baglan->prepare("DELETE FROM ogcp_announcements WHERE AnnouncementID=".intval($_GET["ID"]));
		$del_query->execute();
		if($del_query->rowCount() > 0) {
			unset($announcements[(int)$_GET["ID"]]);
			echo "Duyuru Silindi!";
		} else {
			echo "Duyuru Silinemedi!";
		}
	}
?>