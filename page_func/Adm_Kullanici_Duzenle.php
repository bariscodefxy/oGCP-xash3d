<?php 	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Kullanicilar'));	$machinff = Adm_GetUser((int)@$_GET["ID"]);	if($machinff == false || ($machinff[(int)@$_GET["ID"]]["UserGroup"] > 1 && $userinf["UserGroup"] < 3)) $page->GoLocation($page->CreatePageLink('Adm_Kullanicilar'));	$user = $machinff[(int)@$_GET["ID"]];	$servers = Adm_GetUserServers((int)@$_GET["ID"]);	if(isset($_POST["ogcp_edituser"])) {		if(@$_POST["user_email"] == "") $_POST["user_email"] = $user["UserEmail"];		if(@$_POST["bakiye"] == "") $_POST["bakiye"] = $user["bakiye"];		if(@$_POST["user_email2"] == "") $_POST["user_email2"] = $user["UserEmail2"];		if(@$_POST["user_password"] == "") $_POST["user_password"] = $user["UserPassword"]; else $_POST["user_password"] = md5(md5($_POST["user_password"]));		if(@$_POST["user_comment"] == "") $_POST["user_comment"] = $user["UserComment"];		if(@$_POST["user_name"] == "") $_POST["user_email"] = $user["UserName"];		if(@$_POST["user_city"] == "") $_POST["user_email"] = $user["UserCity"];		if(@$_POST["user_telephone"] == "") $_POST["user_telephone"] = $user["UserTelephone"];		if(@$_POST["user_address"] == "") $_POST["user_address"] = $user["UserAddress"];		if((int)@$_POST["user_group"] < 0 || (int)@$_POST["user_group"] > 3) $_POST["user_group"] = (int)$user["UserGroup"];				if($_POST["user_group"] == 3) {			$_POST["ShowMachine"] = 1;			$_POST["ShowServers"] = 1;			$_POST["ShowUsers"] = 1;			$_POST["ShowAnnouncements"] = 1;			$_POST["ShowTickets"] = 1;			$_POST["ShowPlugins"] = 1;			$_POST["ShowFiles"] = 1;		} else if($_POST["user_group"] == 1) {			$_POST["ShowMachine"] = 0;			$_POST["ShowServers"] = 0;			$_POST["ShowUsers"] = 0;			$_POST["ShowAnnouncements"] = 0;			$_POST["ShowTickets"] = 0;			$_POST["ShowPlugins"] = 0;			$_POST["ShowFiles"] = 0;		}		$status = Adm_UpdateUser((int)@$_GET["ID"],$_POST["user_email"],$_POST["bakiye"],$_POST["user_email"] == $user["UserEmail"] ? 0 : 1,$_POST["user_password"],$_POST["user_email2"],$_POST["user_comment"],$_POST["user_name"],$_POST["user_city"],$_POST["user_address"],$_POST["user_telephone"],$_POST["user_group"],$_POST["ShowMachine"],$_POST["ShowServers"],$_POST["ShowUsers"],$_POST["ShowAnnouncements"],$_POST["ShowTickets"],$_POST["ShowPlugins"],$_POST["ShowFiles"],@$_POST["user_prefix"]);		if($status == -1){			echo "Kullanıcı adı kullanılıyor!";		} else if($status == 1) {			if($_GET["ID"] == $_SESSION["OGCP_UserID"]) {				$_SESSION["OGCP_UserName"] = $_POST["user_email"];				$_SESSION["OGCP_UserPass"] = md5(md5($_POST["user_password"]));			}			$user["UserEmail"] 		= $_POST["user_email"];			$user["bakiye"] 	    = $_POST["bakiye"];			$user["UserEmail2"] 	= $_POST["user_email2"];			$user["UserComment"] 	= $_POST["user_comment"];			$user["UserName"] 		= $_POST["user_name"];			$user["UserCity"] 		= $_POST["user_city"];			$user["UserAddress"] 	= $_POST["user_address"];			$user["UserTelephone"] 	= $_POST["user_telephone"];			$user["UserGroup"] 		= $_POST["user_group"];			$user["ShowMachine"]	= $_POST["ShowMachine"];			$user["ShowServers"]	= $_POST["ShowServers"];			$user["ShowUsers"]		= $_POST["ShowUsers"];			$user["ShowAnnouncements"]	= $_POST["ShowAnnouncements"];			$user["ShowTickets"]	= $_POST["ShowTickets"];			$user["ShowPlugins"]	= $_POST["ShowPlugins"];			$user["ShowFiles"]		= $_POST["ShowFiles"];			$user["UserPrefix"]		= @$_POST["user_prefix"];			echo "Kullanıcı güncellendi!";		} else {			echo "Kullanıcı güncellenemedi!";		}	}	if(@$_GET["Islem"] == "SunucuSil" && isset($servers[(int)@$_GET["SID"]])) {		$del_query = $baglan->prepare("DELETE FROM ogcp_userservers WHERE UserServerID=".intval($_GET["SID"])."; DELETE FROM ogcp_tickets WHERE TicketServerID = ".intval($_GET["SID"]));		$del_query->execute();		if($del_query->rowCount() > 0) {			unset($servers[(int)$_GET["SID"]]);			echo "Kullanıcıdan Sunucu Silindi!";		} else {			echo "Kullanıcıdan Sunucu Silinemedi!";		}	}	?>