<?php
	if( isset($_POST["ogcp_addannoun"]) ) {
		if(@$_POST["duyuru_baslik"] != "" || @$_POST["duyuru_icerik"] != "") {
			if(Adm_AddAnnouncement($_POST["duyuru_baslik"],$_POST["duyuru_icerik"])) {
				echo "Duyuru Eklendi!";
			} else {
				echo "Duyuru Eklenemedi!";
			}
		}
	}
?>