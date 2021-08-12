<?php
	if( isset($_POST["ogcp_adduser"]) ) {
		if(@$_POST["user_email"] != "" && @$_POST["user_pass"] != "" && @$_POST["user_name"] != "" && @$_POST["user_city"] != "" && @$_POST["user_address"] != "" && @$_POST["user_telephone"] != "" && (int)@$_POST["user_group"] > 0 && (int)@$_POST["user_group"] < 4) {
			if($_POST["user_group"] == 3) {
				$_POST["ShowMachine"] = 1;
				$_POST["ShowServers"] = 1;
				$_POST["ShowUsers"] = 1;
				$_POST["ShowAnnouncements"] = 1;
				$_POST["ShowTickets"] = 1;
				$_POST["ShowPlugins"] = 1;
				$_POST["ShowFiles"] = 1;
			} else if($_POST["user_group"] == 1) {
				$_POST["ShowMachine"] = 0;
				$_POST["ShowServers"] = 0;
				$_POST["ShowUsers"] = 0;
				$_POST["ShowAnnouncements"] = 0;
				$_POST["ShowTickets"] = 0;
				$_POST["ShowPlugins"] = 0;
				$_POST["ShowFiles"] = 0;
			}
			$status = Adm_AddUser($_POST["user_email"],$_POST["bakiye"],$_POST["user_email2"],$_POST["user_comment"],$_POST["user_pass"],$_POST["user_name"],$_POST["user_city"],$_POST["user_address"],$_POST["user_telephone"],$_POST["user_group"],$_POST["ShowMachine"],$_POST["ShowServers"],$_POST["ShowUsers"],$_POST["ShowAnnouncements"],$_POST["ShowTickets"],$_POST["ShowPlugins"],$_POST["ShowFiles"]);
			if($status > 0) {
				$page->GoLocation($page->CreatePageLink('Adm_Kullanici_Duzenle','ID='.$status));
			} else if($status == -1){
				echo "Kullan覺c覺 ad覺 kullan覺l覺yor!";
			} else {
				echo "Kullan�c覺 Eklenemedi!";
			}
		} else {
			echo "Alanlar覺 kontrol ediniz!";
		}
	}
?>