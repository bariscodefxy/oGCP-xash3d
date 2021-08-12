<?php
/* oGCP - Oynucaz Game Control Panel
 * Version: 1.0
 * Dosya: "fonksiyon.php"
 * Yapımcı: Oynucaz Dev Team
*/

$bankalar = array(
	0 => "Belirtilmedi",
	1 => "Akbank",
	2 => "Paypal",
	3 => "PTT Bank",
	4 => "Türkiye İş Bankası",
	5 => "Mobil Ödeme",
	6 => "Bakiye İle Alındı"
);

$usercolor = array(
	'black',
	'black',
	'green',
	'red'
);

$yetkiler = array(
	0 => "Yasaklı",
	1 => "Müşteri",
	2 => "Personel",
	3 => "Yönetici"
);

$bildirim_durum = array(
	0 => "Yanıt Bekliyor",
	1 => "Kapatıldı",
	2 => "Cevaplandı",
	3 => "<span style='color:green'>Yönetici Cevapladı</span>",
	4 => "<span style='color:orange'>Müşteri Cevapladı</span>"
);

$bildirim_acil = array(
	1 => "Düşük",
	"Orta",
	"Yüksek"
);

function LoginUser($username,$md5_pass) {
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_users WHERE UserEmail='".addslashes($username)."' and UserPassword='".md5(md5($md5_pass))."' and UserGroup != 0 LIMIT 0,1";
	$sql_query = $baglan->query($sql_query);
	$fetch = $sql_query->fetch(PDO::FETCH_ASSOC);
	if($fetch != "") {
		$_SESSION["OGCP_UserID"] = (int)$fetch["UserID"];
		$_SESSION["OGCP_UserName"] = addslashes($username);
 		$_SESSION["OGCP_UserPass"] = md5(md5($md5_pass));
		$_SESSION["OGCP_UserLogged"] = true;
		$durum = (int)$fetch["UserLastLogin"] != 0 ? ", UserLastLogin2 = ".(int)$fetch["UserLastLogin"] : "";
		$baglan->query("UPDATE ogcp_users SET UserLastLogin = ".time().$durum." WHERE UserID = ".$fetch["UserID"]);
		return true;
	}

	return false;
}

function ChangePassword($newpassword) {
	if($newpassword == "") return false;
	global $baglan;
	$sql_query = "UPDATE ogcp_users SET UserPassword='$newpassword' WHERE UserEmail='".$_SESSION["OGCP_UserName"]."' and UserPassword='".$_SESSION["OGCP_UserPass"]."' and UserGroup != 0";
	$sql_query2 = $baglan->query($sql_query);
	$sql_query2->execute();
	$_SESSION["OGCP_UserPass"] = $newpassword;
	return true;
}

function ControlUser() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_users WHERE UserEmail='".$_SESSION["OGCP_UserName"]."' and UserPassword='".$_SESSION["OGCP_UserPass"]."' and UserGroup != 0 LIMIT 0,1";
	$sql_query = $baglan->query($sql_query);
	$fetch = $sql_query->fetch(PDO::FETCH_ASSOC);
	if($fetch != "") {
		return $fetch;
	} else {
		session_destroy();
		return false;
	}
}

function Adm_GetAnnouncementsList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT AnnouncementID,AnnouncementTT,AnnouncementCont,AnnouncementCreate,UserName FROM ogcp_announcements JOIN ogcp_users ON ogcp_announcements.AnnouncementUserID = ogcp_users.UserID WHERE 1 ORDER BY AnnouncementCreate DESC";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$ticket["AnnouncementCreate"] = date('d/m/Y - H:i:s',strtotime($ticket["AnnouncementCreate"]));
		$tickets[$ticket["AnnouncementID"]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetUserList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan,$yetkiler;
	$sql_query = "SELECT UserID,UserName,UserEmail,UserCity,UserTelephone,UserCreateTime,UserGroup FROM ogcp_users WHERE ogcp_users.UserID != 0 GROUP BY ogcp_users.UserID ORDER BY UserGroup DESC";
	$sql_query = $baglan->query($sql_query);
	$array = array();
	if(!$sql_query) return false;
	foreach($sql_query as $user) {
		$reg_date = date("d-m-Y",strtotime($user["UserCreateTime"]));
		$usergroup = @$yetkiler[$user["UserGroup"]] == "" ? "Bilinmiyor" : $yetkiler[$user["UserGroup"]];
		$user[5] = $reg_date;
		$user[6] = $usergroup;
		$user["UserCreateTime"] = $reg_date;
		$user["UserGroup"] = $usergroup;
		$array[$user["UserID"]] = $user;
	}
	if(count($array) > 0) return $array; else return false;
}

function Adm_GetUserServers($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0) return false;
	global $baglan;
	$sql_query = "SELECT UserServerID,ServerFTPCon,ServerPluginCon,UserServerPrice,UserServerPriceTime,ServerIP,ServerPort,ServerMaxPlayers,ServerMap,ServerPath,MachIP,MachPort,MachUser,MachPass,PacketName as ServerPacket,PacketStart as QStart,PacketStop as QStop,UserServerBank FROM ogcp_userservers JOIN ogcp_servers ON ogcp_servers.ServerID = ogcp_userservers.ServerID JOIN ogcp_machines ON ogcp_servers.ServerMachID = ogcp_machines.MachID JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID WHERE ogcp_userservers.UserID = ".$ID;
	$info = array();
	foreach($baglan->query($sql_query) as $infos) {
		$info[$infos["UserServerID"]] = $infos;
		$info[$infos["UserServerID"]]["Screen"] = strtolower($infos["ServerPacket"])."-".str_replace('.','',$infos["ServerIP"])."-".$infos["ServerPort"];
	}
	if(count($info) > 0) return $info; else return false;
}

function Adm_GetServerUsers($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0) return false;
	global $baglan;
	$sql_query = "SELECT UserServerID,ogcp_userservers.UserID,UserName,UserEmail,UserEmail2,UserServerPrice,UserServerPriceTime,UserServerBank FROM ogcp_userservers JOIN ogcp_users ON ogcp_userservers.UserID = ogcp_users.UserID WHERE ogcp_userservers.ServerID = ".$ID;	$info = array();
	foreach($baglan->query($sql_query) as $infos) {
		$info[$infos["UserServerID"]] = $infos;
	}
	if(count($info) > 0) return $info; else return false;
}
function Adm_GetTicketList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT TicketID,TicketTitle,TicketCreateTime,TicketStatus,TicketPriority,UserName,ServerIP,ServerPort FROM ogcp_tickets JOIN ogcp_users ON ogcp_tickets.TicketUserID = ogcp_users.UserID JOIN ogcp_userservers ON ogcp_tickets.TicketServerID = ogcp_userservers.UserServerID JOIN ogcp_servers ON ogcp_userservers.ServerID = ogcp_servers.ServerID WHERE 1 ORDER BY TicketStatus ASC,TicketCreateTime DESC";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket["TicketID"]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetPluginList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_plugins WHERE 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetMachineList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_machines WHERE 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetMachine($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_machines WHERE MachID = ".$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetFile($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_files WHERE FileID = ".$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetUserServer($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT UserServerID,ogcp_users.UserID,UserName,ServerID,UserServerStatus,ServerPluginCon,ServerFTPCon,UserServerPrice,UserServerPriceTime,UserServerBank FROM ogcp_userservers LEFT JOIN ogcp_users ON ogcp_userservers.UserID = ogcp_users.UserID WHERE UserServerID = ".$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetAnnouncement($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT AnnouncementID,UserName,AnnouncementTT,AnnouncementCont,AnnouncementCreate,AnnouncementUserID FROM ogcp_announcements JOIN ogcp_users ON ogcp_announcements.AnnouncementUserID = ogcp_users.UserID WHERE ogcp_announcements.AnnouncementID = ".$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetPlugin($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_plugins WHERE PluginID = ".$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetUser($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_users WHERE UserID = ".$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetServer($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || (int)$ID <= 0 ) return false;
	global $baglan;
	$sql_query = "SELECT ServerID,ServerIP,ServerPort,ServerPath,ServerMap,ServerMaxPlayers,ServerMachID,ServerPacket,PacketStart,MachIP,MachPass,MachPort,MachUser,PacketStart as QStart, PacketStop as QStop, PacketName FROM ogcp_servers LEFT JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID LEFT JOIN ogcp_machines ON ogcp_servers.ServerMachID = ogcp_machines.MachID WHERE ServerID = ".(int)$ID." LIMIT 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$ticket["Screen"] = strtolower($ticket["PacketName"])."-".str_replace('.','',$ticket["ServerIP"])."-".$ticket["ServerPort"];
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetTicket($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || @$ID == 0) return false;
	global $baglan,$usercolor,$page;
	$sql_query = "SELECT TicketTitle,TicketCreateTime,TicketPriority,TicketStatus,ServerIP,ServerPort,UserName FROM ogcp_tickets JOIN ogcp_userservers ON ogcp_tickets.TicketServerID = ogcp_userservers.UserServerID JOIN ogcp_servers ON ogcp_userservers.ServerID = ogcp_servers.ServerID JOIN ogcp_users ON ogcp_tickets.TicketUserID = ogcp_users.UserID WHERE ogcp_tickets.TicketID = {$ID} ORDER BY TicketStatus DESC LIMIT 0,1";
	$ticket = array();
	$sql_query = $baglan->query($sql_query);
	foreach($sql_query as $ticket2) {
		$ticket = $ticket2;
		$ticket["TicketCreateTime"] = date('d/m/Y - H:i:s',strtotime($ticket["TicketCreateTime"]));
		$sql_query = "SELECT MessageID,MessageUserID,MessageContent,MessageCreateT,UserName,UserGroup,UserPrefix FROM ogcp_ticketmessages JOIN ogcp_users ON ogcp_ticketmessages.MessageUserID = ogcp_users.UserID WHERE ogcp_ticketmessages.MessageTicketID = ".intval($ID)." ORDER BY MessageCreateT ASC";
		foreach($baglan->query($sql_query) as $ticket3) {
			$ticket3["UserName"] = $ticket3["UserGroup"] > 1 ? ("<a href=\"".$page->CreatePageLink('Adm_Kullanici_Duzenle','ID='.$ticket3["MessageUserID"])."\" style='color:black'><font style='color:{$usercolor[$ticket3["UserGroup"]]}'>[".$ticket3["UserPrefix"]."]</font> ".$ticket3["UserName"]."</a>") : ("<a href=\"".$page->CreatePageLink('Adm_Kullanici_Duzenle','ID='.$ticket3["MessageUserID"])."\" style='color:black'>".$ticket3["UserName"]."</a>");
			$ticket["messages"][$ticket3["MessageID"]] = $ticket3;
			$ticket["messages"][$ticket3["MessageID"]]["MessageCreateT"] = date('d/m/Y - H:i:s',strtotime($ticket["messages"][$ticket3["MessageID"]]["MessageCreateT"]));
		}
	}
	if(count($ticket) > 0) return $ticket; else return false;
}

function Adm_GetServerList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT ogcp_servers.ServerID,ServerIP,ServerMachID,ServerPort,ServerMaxPlayers,ServerMap,ServerPath,ogcp_packets.PacketName as ServerPacket,MachIP, COUNT(ogcp_userservers.UserID) as UserCount FROM ogcp_servers JOIN ogcp_machines ON ogcp_servers.ServerMachID = ogcp_machines.MachID JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID LEFT JOIN ogcp_userservers ON ogcp_servers.ServerID = ogcp_userservers.ServerID WHERE 1 GROUP BY ogcp_servers.ServerID ORDER BY ogcp_servers.ServerID";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function CounterMerkezi_KiralikIP() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT ogcp_servers.ServerID,ServerIP,ServerMachID,ServerPort,ServerMaxPlayers,ServerMap,ServerPath,ogcp_packets.PacketName as ServerPacket,MachIP,PacketFiyat, COUNT(ogcp_userservers.UserID) as UserCount FROM ogcp_servers JOIN ogcp_machines ON ogcp_servers.ServerMachID = ogcp_machines.MachID JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID LEFT JOIN ogcp_userservers ON ogcp_servers.ServerID = ogcp_userservers.ServerID WHERE 1 GROUP BY ogcp_servers.ServerID ORDER BY ogcp_servers.ServerID";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function Adm_GetServersSum() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT COUNT(distinct ogcp_servers.ServerID) as ServerSayisi, SUM(ogcp_servers.ServerMaxPlayers) as MaxSlot, SUM(ogcp_userservers.UserServerPrice) as ToplamPara  FROM `ogcp_servers` JOIN ogcp_userservers ON ogcp_servers.ServerID = ogcp_userservers.ServerID WHERE 1";
	$sql_query = $baglan->query($sql_query);
	$fetch = $sql_query->fetch(PDO::FETCH_ASSOC);
	if($fetch != "") {
		return $fetch;
	} else {
		$fetch["ServerSayisi"] = 0;
		$fetch["ToplamPara"] = 0;
		return $fetch;
	}
}

function Adm_GetServersMaxSlot() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT SUM(ogcp_servers.ServerMaxPlayers) as ServerMaxSlot FROM `ogcp_servers` WHERE 1";
	$sql_query = $baglan->query($sql_query);
	$fetch = $sql_query->fetch(PDO::FETCH_ASSOC);
	if($fetch != "") {
		return (int)$fetch["ServerMaxSlot"];
	} else {
		return 0;
	}
}

function Adm_GetFilesList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_files WHERE 1";
	$files = array();
	foreach($baglan->query($sql_query) as $file) {
		$files[$file["FileID"]] = $file;
	}
	if(count($files) > 0) return $files; else return false;
}

function Adm_GetPacketList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_packets WHERE 1";
	$files = array();
	foreach($baglan->query($sql_query) as $file) {
		$files[$file["PacketID"]] = $file;
	}
	if(count($files) > 0) return $files; else return false;
}

function Adm_GetSystemStats() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT COUNT(distinct ogcp_servers.ServerID) as ServerSayisi,COUNT(distinct ogcp_machines.MachID) as MakineSayisi FROM ogcp_machines LEFT JOIN ogcp_servers ON 1 WHERE 1";
	$sql_query2 = "SELECT COUNT(distinct ogcp_packets.PacketID) as PaketSayisi, COUNT(distinct ogcp_tickets.TicketID) as TicketSayisi, COUNT(distinct ogcp_announcements.AnnouncementID) as DuyuruSayisi,COUNT(distinct ogcp_plugins.PluginID) as PluginSayisi FROM ogcp_packets LEFT JOIN ogcp_tickets ON 1 LEFT JOIN ogcp_announcements ON 1 LEFT JOIN ogcp_plugins ON 1 WHERE 1";
	$sql_query3 = "SELECT COUNT(distinct ogcp_users.UserID) as KullaniciSayisi,COUNT(distinct ogcp_files.FileID) as AyarSayisi FROM ogcp_users LEFT JOIN ogcp_files ON 1 WHERE 1";
	$sql_query = $baglan->query($sql_query);
	$fetch = $sql_query->fetch(PDO::FETCH_ASSOC);
	if(!$fetch) {
		$fetch["ServerSayisi"] = 0;
		$fetch["MakineSayisi"] = 0;
	}
	$sql_query2 = $baglan->query($sql_query2);
	$fetch2 = $sql_query2->fetch(PDO::FETCH_ASSOC);
	if($fetch2) {
		$fetch["TicketSayisi"] = $fetch2["TicketSayisi"];
		$fetch["PaketSayisi"] = $fetch2["PaketSayisi"];
		$fetch["DuyuruSayisi"] = $fetch2["DuyuruSayisi"];
		$fetch["PluginSayisi"] = $fetch2["PluginSayisi"];
	} else {
		$fetch["TicketSayisi"] = 0;
		$fetch["PaketSayisi"]  = 0;
		$fetch["DuyuruSayisi"] = 0;
		$fetch["PluginSayisi"] = 0;
	}
	$sql_query4 = $baglan->query($sql_query3);
	$fetch3 = @$sql_query4->fetch(PDO::FETCH_ASSOC);
	if($fetch3) {
		$fetch["KullaniciSayisi"] = $fetch3["KullaniciSayisi"] - 1;
		$fetch["AyarSayisi"] = $fetch3["AyarSayisi"];
	} else {
		$fetch["KullaniciSayisi"] = 0;
		$fetch["AyarSayisi"]  = 0;
	}
	return $fetch;
}

function Adm_SendTicketMessage($ID,$Message,$Status) {
	if( (int)@$ID == 0  || $Status <= 0) return false;

	if(Adm_GetTicket($ID) == false) return false;
	global $baglan;
	$Message == "" ? $query1 = "" : $query1 = "INSERT INTO `ogcp_ticketmessages`(`MessageContent`, `MessageUserID`, `MessageTicketID`) VALUES ('".addslashes($Message)."','".$_SESSION["OGCP_UserID"]."','".intval($ID)."');";
	($Status == 1 && $Message == "") || ($Status >= 2 && $Status <= 4)  ? $query2 = "UPDATE ogcp_tickets SET TicketStatus = '".intval($Status)."' WHERE TicketID = '".intval($ID)."'" : $query2 = "";
	$sql_query = $baglan->query($query1.$query2);
	if($sql_query == false) return false; else return true;
}

function Adm_StopAllServers() {
	$machines = Adm_GetMachineList();
	$ssh2 = new ogcp_ssh2();
	foreach($machines as $machine) {
		if ( $ssh2->ConnectwAuth($machine["MachIP"],$machine["MachPort"],$machine["MachUser"],$machine["MachPass"]) ) {
			$ssh2->Exec('killall hlds_run');
			echo "Makine #".$machine["MachID"].": ".$machine["MachIP"]." IP'li makinesinin sunucuları kapatıldı<br/>";
		}
	}
}

function Adm_StartAllServers() {
	$machines = Adm_GetMachineList();
	$ssh2 = new ogcp_ssh2();
	global $baglan;
	$bul = array(
		"Screen", "Ip", "Port", "Map", "Maxslot"
	);

	foreach($machines as $machine) {
		if ( $ssh2->ConnectwAuth($machine["MachIP"],$machine["MachPort"],$machine["MachUser"],$machine["MachPass"]) ) {
			$ssh2->Exec('killall hlds_run');
			$exec = "";
			$sql_query = "SELECT ServerIP,ServerPort,ServerMap,ServerMaxPlayers,ServerPath,PacketStart as QStart,PacketName as ServerPacket FROM ogcp_servers JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID  WHERE ServerMachID = ".$machine["MachID"];
			foreach( @$baglan->query($sql_query) as $infos ) {
				$infos["Screen"] = strtolower($infos["ServerPacket"])."-".str_replace('.','',$infos["ServerIP"])."-".$infos["ServerPort"];
				$degistir = array(
					$infos["Screen"], $infos["ServerIP"], $infos["ServerPort"], $infos["ServerMap"], $infos["ServerMaxPlayers"]
				);
				$exec .= "cd ".$infos["ServerPath"]."; ".str_replace($bul,$degistir,$infos["QStart"])."; ";
			}
			$ssh2->Exec($exec);
			echo "Makine #".$machine["MachID"].": ".$machine["MachIP"]." IP'li makinesinin sunucuları çalıştırıldı!<br/>";
		}
	}
}

function Adm_ReStartAllServers() {
	$machines = Adm_GetMachineList();
	$ssh2 = new ogcp_ssh2();
	global $baglan;
	$bul = array(
		"Screen", "Ip", "Port", "Map", "Maxslot"
	);

	foreach($machines as $machine) {
		if ( $ssh2->ConnectwAuth($machine["MachIP"],$machine["MachPort"],$machine["MachUser"],$machine["MachPass"]) ) {
			$ssh2->Exec('killall hlds_run');
			$exec = "";
			$sql_query = "SELECT ServerIP,ServerPort,ServerMap,ServerMaxPlayers,ServerPath,PacketStart as QStart,PacketName as ServerPacket FROM ogcp_servers JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID  WHERE ServerMachID = ".$machine["MachID"];
			foreach( @$baglan->query($sql_query) as $infos ) {
				$infos["Screen"] = strtolower($infos["ServerPacket"])."-".str_replace('.','',$infos["ServerIP"])."-".$infos["ServerPort"];
				$degistir = array(
					$infos["Screen"], $infos["ServerIP"], $infos["ServerPort"], $infos["ServerMap"], $infos["ServerMaxPlayers"]
				);
				$exec .= "cd ".$infos["ServerPath"]."; ".str_replace($bul,$degistir,$infos["QStart"])."; ";
			}
			$ssh2->Exec($exec);
			echo "Makine #".$machine["MachID"].": ".$machine["MachIP"]." IP'li makinesinin sunucuları yeniden başlatıldı!<br/>";
		}
	}
}

function Adm_GetContServer() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT ServerID,ServerIP,ServerPort,ServerMaxPlayers,ServerMap,ServerPath,MachIP,MachPort,MachUser,MachPass,PacketName as ServerPacket,PacketStart as QStart,PacketStop as QStop FROM ogcp_servers JOIN ogcp_machines ON ogcp_servers.ServerMachID = ogcp_machines.MachID JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID WHERE ogcp_servers.ServerID = ".$_SESSION["OGCP_SelectedServer"]." LIMIT 1";
	$info = array();
	foreach($baglan->query($sql_query) as $infos) {
		$infos["ServerFTPCon"] 		= 1;
		$infos["ServerPluginCon"] 	= 1;
		$infos["UserServerPrice"] 	= 0;
		$infos["UserServerBank"] 	= 0;
		$infos["UserServerPriceTime"] 	= time() + (3600*24);
		$info[$infos["ServerID"]] = $infos;
		$info[$infos["ServerID"]]["Screen"] = strtolower($infos["ServerPacket"])."-".str_replace('.','',$infos["ServerIP"])."-".$infos["ServerPort"];
	}
	if(count($info) > 0) return $info; else return false;
}

function Adm_AddMachine($IP,$Port,$User,$Pass) {
	if( $IP == "" || (int)@$Port == 0 || $User == "" || $Pass == "" ) return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_machines` (`MachIP`, `MachPort`, `MachUser`, `MachPass`) VALUES ('".addslashes($IP)."','".intval($Port)."','".addslashes($User)."', '".addslashes($Pass)."');");
	if($sql_query == false) return false; else return true;
}

function Adm_AddUserServer($UserID,$ServerID,$Status = 1,$FTPCon = 1,$PluginCon = 1,$Time,$Price,$Bank) {
	if( (int)$UserID <= 0 || (int)$ServerID <= 0 || $Bank > 5 || $Bank < 0 || $FTPCon > 1 || $FTPCon < 0 || $PluginCon > 1 || $PluginCon < 0 ) return false;
	global $baglan;
	if( Adm_GetServer((int)$ServerID) == false ) return false;
	$sql_query = $baglan->query("INSERT INTO `ogcp_userservers` (`UserID`, `ServerID`, `UserServerStatus`, `ServerFTPCon`, `ServerPluginCon`, `UserServerPrice`, `UserServerPriceTime`, `UserServerBank`) VALUES ('".(int)$UserID."','".(int)$ServerID."','".(int)$Status."', '".(int)$FTPCon."', '".(int)$PluginCon."', '".(int)$Price."', '".(int)$Time."','".(int)$Bank."');");
	if($sql_query == false) return false; else return true;
}


function Adm_UpdateUserServer($ID,$ServerID,$Status = 1,$FTPCon = 1,$PluginCon = 1,$Time,$Price,$Bank) {
	if( (int)$ID <= 0 || (int)$ServerID <= 0 || $Bank > 5 || $Bank < 0 || $FTPCon > 1 || $FTPCon < 0 || $PluginCon > 1 || $PluginCon < 0 ) return false;
	global $baglan;
	if( Adm_GetServer((int)$ServerID) == false ) return false;
	$sql_query = $baglan->query("UPDATE ogcp_userservers SET ServerID = '".(int)$ServerID."', UserServerStatus = '".(int)$Status."', ServerFTPCon = '".(int)$FTPCon."', ServerPluginCon = '".(int)$PluginCon."', UserServerPriceTime = '".(int)$Time."', UserServerPrice = '".(int)$Price."', UserServerBank = '".(int)$Bank."' WHERE UserServerID = '".(int)$ID."'");
	if($sql_query == false || @$sql_query->rowCount() <= 0) return false; else return true;
}

function Adm_AddPlugin($PName,$PDesc,$PFile,$PShow) {
	if( $PName == "" || $PDesc == "" || $PFile == "" || $PShow == "" ) return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_plugins` (`PluginName`, `PluginDesc`, `PluginFileName`, `PluginShow`) VALUES ('".addslashes($PName)."','".addslashes($PDesc)."','".addslashes($PFile)."', '".intval($PShow)."');");
	if($sql_query == false) return false; else return true;
}

function Adm_AddFile($FName,$FPath) {
	if( $FName == "" || $FPath == "") return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_files` (`FileName`, `FilePath`) VALUES ('".addslashes($FName)."','".addslashes($FPath)."');");
	if($sql_query == false) return false; else return true;
}

function Adm_ControlUserEmail($UserEmail) {
		global $baglan;
		$sql="SELECT COUNT(*) as Sayi FROM ogcp_users WHERE UserEmail = '".addslashes($UserEmail)."'";
		$result = $baglan->query($sql);
		$row = $result->fetch(PDO::FETCH_NUM);
		if($row[0] > 0) return true; else return false;
}

function Adm_AddUser($Email,$bakiye,$Email2,$Comment,$Pass,$Name,$City,$Address,$Telephone,$Group,$Machine,$Servers,$Users,$Announ,$Tickets,$Plugins,$Files) {
	if( $Email == "" || $Pass == "" || $Name == "" || $City == "" || $Address == "" || $Telephone == "" || (int)$Group <= 0 || (int)$Group > 3 ) return false;
	global $baglan;
	if( Adm_ControlUserEmail($Email) === true) return -1;
	$sql_query = "INSERT INTO `ogcp_users` (`UserEmail`, `bakiye`, `UserPassword`, `UserEmail2` , `UserComment`,`UserName`, `UserCity`, `UserAddress`, `UserTelephone`, `UserGroup`, `UserLastLogin`, `ShowMachine`, `ShowServers`, `ShowUsers`, `ShowAnnouncements`, `ShowTickets`, `ShowPlugins`, `ShowFiles`) VALUES ('".addslashes($Email)."','".(int)$bakiye."','".md5(md5($Pass))."', '".addslashes($Email2)."', '".addslashes($Comment)."', '".addslashes($Name)."', '".addslashes($City)."', '".addslashes($Address)."', '".addslashes($Telephone)."', '".(int)$Group."', 0, '".(int)$Machine."','".(int)$Servers."','".(int)$Users."','".(int)$Announ."','".(int)$Tickets."','".(int)$Plugins."','".(int)$Files."')";
	$sql_query = $baglan->query($sql_query);
	if($sql_query == false) return 0; else return $baglan->lastInsertId();
}

function Adm_UpdateUser($ID,$Email,$bakiye,$emailstatus,$Password,$email2,$comment,$Name,$City,$Address,$Telephone,$Group,$Machine,$Servers,$Users,$Announ,$Tickets,$Plugins,$Files,$Prefix) {
	if( (int)$ID <= 0 || $Email == "" || $Name == "" || $City == "" || $Address == "" || $Telephone == "" || (int)$Group <= 0 || (int)$Group > 3 ) return false;
	global $baglan;
	$sql_query = "UPDATE ogcp_users SET UserEmail = '".addslashes($Email)."', bakiye = '".$bakiye."', UserName = '".addslashes($Name)."',UserPassword = '".$Password."', UserEmail2 = '".addslashes($email2)."', UserComment = '".addslashes($comment)."', UserCity = '".addslashes($City)."', UserAddress = '".addslashes($Address)."', UserTelephone = '".addslashes($Telephone)."', UserGroup = '".(int)$Group."', UserPrefix = '".addslashes($Prefix)."', ShowMachine = '".(int)$Machine."', ShowServers = '".(int)$Servers."', ShowUsers = '".(int)$Users."', ShowAnnouncements = '".(int)$Announ."', ShowTickets = '".(int)$Tickets."', ShowPlugins = '".(int)$Plugins."', ShowFiles = '".(int)$Files."' WHERE UserID = '".(int)$ID."'";
	if( Adm_ControlUserEmail($Email) === true && $emailstatus == 1) return -1;
	$sql_query = $baglan->query($sql_query);
	if($sql_query == false) return 0; else return 1;
}

function Adm_AddAnnouncement($AnnounTitle,$Content) {
	if( $AnnounTitle == "" || $Content == "") return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_announcements` (`AnnouncementTT`, `AnnouncementCont`, `AnnouncementUserID`) VALUES ('".addslashes($AnnounTitle)."','".addslashes($Content)."', '".(int)$_SESSION["OGCP_UserID"]."');");
	if($sql_query == false || @$sql_query->rowCount() <= 0) return false; else return true;
}

function Adm_UpdatePlugin($ID,$PName,$PDesc,$PFile,$PShow) {
	if( (int)@$ID <= 0 || $PName == "" || $PDesc == "" || $PFile == "" ) return false;
	global $baglan;
	$sql_query = $baglan->prepare("UPDATE `ogcp_plugins` SET `PluginName` = '".addslashes($PName)."', `PluginDesc` = '".addslashes($PDesc)."' , `PluginFileName` = '".addslashes($PFile)."', `PluginShow` = '".intval($PShow)."' WHERE PluginID = '".$ID."'");
	$sql_query->execute();
	if($sql_query == false) return false; else return true;
}

function Adm_UpdateFile($ID,$FName,$FPath) {
	if( (int)@$ID <= 0 || $FName == "" || $FPath == "" ) return false;
	global $baglan;
	$sql_query = $baglan->prepare("UPDATE `ogcp_files` SET `FileName` = '".addslashes($FName)."', `FilePath` = '".addslashes($FPath)."' WHERE FileID = '".$ID."'");
	$sql_query->execute();
	if($sql_query == false) return false; else return true;
}

function Adm_UpdateAnnouncement($ID,$AnnounTitle,$Content) {
	if( (int)@$ID <= 0 || $AnnounTitle == "" || $Content == "" ) return false;
	global $baglan;
	$sql_query = $baglan->prepare("UPDATE `ogcp_announcements` SET `AnnouncementTT` = '".addslashes($AnnounTitle)."', `AnnouncementCont` = '".addslashes($Content)."' WHERE AnnouncementID = '".$ID."'");
	$sql_query->execute();
	if($sql_query == false || @$sql_query->rowCount() <= 0) return false; else return true;
}

function Adm_UpdateMachine($ID,$IP,$Port,$User,$Pass) {
	if( $IP == "" || (int)@$Port <= 0 || (int)@$ID <= 0 || $User == "" || $Pass == "" ) return false;
	global $baglan;
	$sql_query = $baglan->prepare("UPDATE `ogcp_machines` SET `MachIP` = '".addslashes($IP)."', `MachPort` = '".addslashes($Port)."' , `MachUser` = '".addslashes($User)."', `MachPass` = '".addslashes($Pass)."' WHERE MachID = ".$ID);
	$sql_query->execute();
	if($sql_query == false) return false; else return true;
}

function Adm_UpdateServer($ID,$IP,$Port,$Machid,$Packetid,$map,$slot,$path) {
	if( $IP == "" || (int)@$Port <= 0 || (int)@$Machid <= 0 || (int)@$Packetid <= 0 || $map == "" || $slot == "" || $path == "") return false;
	global $baglan;
	$sql_query = $baglan->prepare("UPDATE `ogcp_servers` SET `ServerIP` = '".addslashes($IP)."', `ServerPort` = '".intval($Port)."' , `ServerMachID` = '".intval($Machid)."', `ServerPacket` = '".intval($Packetid)."', `ServerMap` = '".addslashes($map)."', `ServerMaxPlayers` = '".intval($slot)."', `ServerPath` = '".addslashes($path)."' WHERE ServerID = ".$ID);
	$sql_query->execute();
	if($sql_query == false) return false; else return true;
}

function Adm_AddServer($IP,$Port,$Machid,$Packetid,$Map,$Slot,$Path) {
	if( $IP == "" || (int)@$Port == 0 || (int)@$Machid == "" || (int)@$Packetid == "" || @$Map == "" || (int)@$Slot <= 0 || $Path == "") return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_servers`(`ServerMachID`, `ServerIP`, `ServerPort`, `ServerMaxPlayers`, `ServerMap`, `ServerPath`, `ServerPacket`) VALUES ('".intval($Machid)."','".addslashes($IP)."','".intval($Port)."','".intval($Slot)."','".addslashes($Map)."','".addslashes($Path)."','".intval($Packetid)."')");
	if($sql_query == false) return false; else return true;
}

function GetServerFiles() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_files WHERE 1 ORDER BY FileName ASC";
	$files = array();
	foreach($baglan->query($sql_query) as $file) {
		$files[$file["FileID"]] = $file;
	}
	if(count($files) > 0) return $files; else return false;
}

function GetTicketList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_tickets WHERE TicketUserID = ".$_SESSION["OGCP_UserID"]." ORDER BY TicketCreateTime DESC";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket["TicketID"]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function GetAnnouncementsList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT AnnouncementID,AnnouncementTT,AnnouncementCont,AnnouncementCreate,UserName FROM ogcp_announcements JOIN ogcp_users ON ogcp_announcements.AnnouncementUserID = ogcp_users.UserID WHERE 1 ORDER BY AnnouncementCreate DESC";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$ticket["AnnouncementCreate"] = date('d/m/Y - H:i:s',strtotime($ticket["AnnouncementCreate"]));
		$tickets[$ticket["AnnouncementID"]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}

function GetTicket($ID) {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "" || @$ID == 0) return false;
	global $baglan,$usercolor,$page;
	$sql_query = "SELECT TicketTitle,TicketCreateTime,TicketPriority,TicketStatus,ServerIP,ServerPort,UserName FROM ogcp_tickets JOIN ogcp_userservers ON ogcp_tickets.TicketServerID = ogcp_userservers.UserServerID JOIN ogcp_servers ON ogcp_userservers.ServerID = ogcp_servers.ServerID JOIN ogcp_users ON ogcp_tickets.TicketUserID = ogcp_users.UserID WHERE ogcp_tickets.TicketID = {$ID} and TicketUserID = {$_SESSION["OGCP_UserID"]} ORDER BY TicketStatus DESC LIMIT 0,1";
	$ticket = array();
	$sql_query = $baglan->query($sql_query);
	foreach($sql_query as $ticket2) {
		$ticket = $ticket2;
		$ticket["TicketCreateTime"] = date('d/m/Y - H:i:s',strtotime($ticket["TicketCreateTime"]));
		$sql_query = "SELECT MessageID,MessageContent,MessageCreateT,UserName,UserPrefix,UserGroup FROM ogcp_ticketmessages JOIN ogcp_users ON ogcp_ticketmessages.MessageUserID = ogcp_users.UserID WHERE ogcp_ticketmessages.MessageTicketID = ".intval($ID)." ORDER BY MessageCreateT ASC";
		foreach($baglan->query($sql_query) as $ticket3) {
			$ticket3["UserName"] = ($ticket3["UserGroup"] > 1) ? "<span style='color:{$usercolor[$ticket3["UserGroup"]]}'>[".$ticket3["UserPrefix"]."] <font style='color:black'>".$ticket3["UserName"]."</font></span>" : "<font style='color:black'>".$ticket3["UserName"]."</font>";
			$ticket["messages"][$ticket3["MessageID"]] = $ticket3;
			$ticket["messages"][$ticket3["MessageID"]]["MessageCreateT"] = date('d/m/Y - H:i:s',strtotime($ticket["messages"][$ticket3["MessageID"]]["MessageCreateT"]));
		}
	}
	if(count($ticket) > 0) return $ticket; else return false;
}

function SendTicketMessage($ID,$Message) {
	if( (int)@$ID == 0 && $Message == "" ) return false;

	if(GetTicket($ID) == false) return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_ticketmessages`(`MessageContent`, `MessageUserID`, `MessageTicketID`) VALUES ('".addslashes($Message)."','".$_SESSION["OGCP_UserID"]."','".intval($ID)."');");
	if($sql_query == false) return false; else return true;
}

function SendTicket($Title,$Message,$serverid,$priority) {
	if( $Title == "" && $Message == "" && (int)$priority == 0) return false;
	global $baglan;
	$sql_query = $baglan->query("INSERT INTO `ogcp_tickets` (`TicketUserID`, `TicketTitle`, `TicketServerID`, `TicketMessageID`, `TicketStatus`, `TicketPriority`) VALUES ('".$_SESSION["OGCP_UserID"]."','".$Title."','".$serverid."','0','0','".$priority."');");
	if($sql_query == false) return false;
	$ticketid = $baglan->lastInsertId();
	if(@$ticketid == 0) return false;
	$sql_query = $baglan->query("INSERT INTO `ogcp_ticketmessages`(`MessageContent`, `MessageUserID`, `MessageTicketID`) VALUES ('".addslashes($Message)."','".$_SESSION["OGCP_UserID"]."', $ticketid);");
	if($sql_query == false) return false;

	return true;
}

function GetUserServers() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT UserServerID,ServerFTPCon,ServerPluginCon,UserServerPrice,UserServerPriceTime,ServerIP,ServerPort,ServerMaxPlayers,ServerMap,ServerPath,MachIP,MachPort,MachUser,MachPass,PacketName as ServerPacket,PacketStart as QStart,PacketStop as QStop,UserServerBank FROM ogcp_userservers JOIN ogcp_servers ON ogcp_servers.ServerID = ogcp_userservers.ServerID JOIN ogcp_machines ON ogcp_servers.ServerMachID = ogcp_machines.MachID JOIN ogcp_packets ON ogcp_servers.ServerPacket = ogcp_packets.PacketID WHERE ogcp_userservers.UserID = ".$_SESSION["OGCP_UserID"];
	$info = array();
	foreach($baglan->query($sql_query) as $infos) {
		$info[$infos["UserServerID"]] = $infos;
		$info[$infos["UserServerID"]]["Screen"] = strtolower($infos["ServerPacket"])."-".str_replace('.','',$infos["ServerIP"])."-".$infos["ServerPort"];
	}
	if(count($info) > 0) return $info; else return false;
}

function ContSunucuSecPage() {
	if( @$_GET["Page"] != "Cikis" && @$_GET["Page"] != "Sunucu_Sec" && @$_GET["Page"] != "Profil" && @$_GET["Page"] != "Sifre_Degistir" ) return true;
	return false;
}

function LogoutUser() {
	global $page;
	session_destroy();
}

// Admin User Functions
function IsUserAdmin($userstatus) {
	if($userstatus > 1) return true;
	else return false;
}
// Admin User Functions - End

function ReadAdmins($file="users.ini") {
	if($file == "" || !file_exists($file) ) return false;

	$openfile = fopen($file,"r");
	$admins = array();
	$line = 1;
	$admincount = 0;
	while(!feof($openfile)) {
		$buffer = fgets($openfile,1024);
		if(substr($buffer,0,1) != ";") {
			$buffer = trim($buffer);
			$buffer = explode('"',$buffer);
			if(isset($buffer[7])) {
				$admin["name"]	= $buffer[1];
				$admin["password"]	= $buffer[3];
				$admin["flags"]	= $buffer[5];
				$admin["flags2"]	= $buffer[7];
				$admin["comment"]	= trim(str_replace(array(';','//'),'',@$buffer[8]));
				$admins[$line] = $admin;
				$admincount++;
			}
		}
		$line++;
	}
	$admins["count"] = $admincount;
	return $admins;
}

function CFG_GetVariable($file,$variable) {
	if(!file_exists($file)) return false;

	$dosyaac = fopen($file,"r");
	$variables = array();
	while(!feof($dosyaac)) {
		$satir = fgets($dosyaac,8192);
		foreach( $variable as $var) {
			if(substr($satir,0,strlen($var)) == $var) {
				$thisvar = explode('"',$satir);
				unset($thisvar[0]);
				$variables[$var][] = @$thisvar;
			}
		}
	}
	if(@count($variables) > 0) return $variables; else return false;
}

// Eklenti Kontrol

$eklenti_status = array(
	"Pasif","Aktif","Bilinmiyor"
);

function Plugin_GetStatus($path,$pluginnames) {
	if( count($pluginnames) <= 0 || !file_exists($path)) return false;

	$dosyaac = fopen($path,"r");
	$variables = array();
	while(!feof($dosyaac)) {
		$satir = fgets($dosyaac,8192);
		foreach( $pluginnames as $pluginname) {
			if(@$variables[$pluginname] == 1) continue;
			if(trim(substr($satir,0,strlen($pluginname))) == $pluginname) {
				$variables[$pluginname] = 1;
			} else {
				$variables[$pluginname] = 0;
			}
		}
	}
	if(@count($variables) > 0) return $variables; else return false;
}

function Plugin_CopyDir($src,$dst) {
    @mkdir($dst);
    if(!file_exists($src)) return false;
    $files = scandir($src);
    foreach($files as $file) {
        if(( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                Plugin_CopyDir($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    return true;
}

function GetPluginList() {
	if(@$_SESSION["OGCP_UserName"] == "" || $_SESSION["OGCP_UserPass"] == "") return false;
	global $baglan;
	$sql_query = "SELECT * FROM ogcp_plugins WHERE PluginShow = 1";
	$tickets = array();
	foreach($baglan->query($sql_query) as $ticket) {
		$tickets[$ticket[0]] = $ticket;
	}
	if(count($tickets) > 0) return $tickets; else return false;
}
// Eklenti Kontrol - End

// Sunucu Reklamları

function rgb2hex($rgb) {
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex;
}

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));

   }
   if($r < 100 && $r > 10) { $r = "0".$r; }
   if($g < 100 && $g > 10) { $g = "0".$g; }
   if($b < 100 && $b > 10) { $b = "0".$b; }
   if($r < 10) { $r = "00".$r; }
   if($g < 10) { $g = "00".$g; }
   if($b < 10) { $b = "00".$b; }
   $rgb = $r.$g.$b;
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
// Sunucu Reklamları - End

function deleteLine($fileName, $lineNum){
	if(!is_writable($fileName))
	{
		return 0;
	}
	else
	{
		$arr = file($fileName);
	}
	$lineToDelete = $lineNum-1;

	if($lineToDelete > sizeof($arr))
	{
		return 2;
	}

	unset($arr["$lineToDelete"]);

	if (!$fp = fopen($fileName, 'w+'))
	{
		return 3;
	}

	if($fp)
	{
		foreach($arr as $line) { fwrite($fp,$line); }
		fclose($fp);
	}

	return 1;
}
function changeLine($file, $new_lines) {
        $response = 0;

        $tab = chr(9);
        $lbreak = chr(13) . chr(10);
        $lines = file($file);

        foreach ($new_lines as $key => $value) {
            $lines[--$key] = $value . $lbreak;
        }
        $new_content = implode('', $lines);

        if ($h = fopen($file, 'w')) {
            if (fwrite($h, $new_content)) {
                $response = 1;
            }
            fclose($h);
        }
        return $response;
}

function serverkalanzaman($simdi,$sonra) {
	$fark = $sonra-$simdi;
	$d = 0;
	if($fark <= 0) {
		$d = '<span style="color:yellow">0</span> gün';
	}
	else if($fark>0&&$fark<=86400) {
 		$fark = intval($fark/3600);
 		$d= '<span style="color:#00FF00">'.$fark.'</span> saat';
	} elseif($fark>86400) {
		$fark = intval($fark/86400);
 		$d= '<span style="color:#00FF00">'.$fark.'</span> gün';
	} return $d;
}

// WebFTP Functions
function cmp($a, $b)
{
	return strnatcasecmp($a, $b);
}

$restricted_files = array(
	"server.cfg" => 1,
	"guvenlik.cfg" => 1,
	"plugins-guvenlik.ini" => 1,
	"commandmenu.txt" => 1,
	"config.cfg" => 1,
	"autobuy.txt" => 1,
	"listenserver.cfg" => 1,
	"spectatormenu.txt" => 1,
	"spectcammenu.txt" => 1,
	"steam_appid.txt" => 1,
	"sxe_local_ban.cfg" => 1,
	"titles.txt"	=> 1,
	"upatch.cfg"	=> 1,
	"sayi.ini"	=> 1,
	"sunucu.ini"	=> 1,
	"rebuy.txt"	=> 1,
	"readme.txt"	=> 1,
	"cvars.ini"	=> 1
);
$restricted_dirs = array(
	".ssh" => 1,
	"antidlfile" => 1,
	"dproto" => 1,
	"metamod" => 1,
	"sxei" => 1,
	"upatch" => 1,
	"scripting" => 1,
	"dlls" => 1,
	"cl_dlls" => 1,
	"modules" => 1,
	"AdBlocker" => 1
);

$exts = array(
	".."		=> "",
	"dir"		=> "Klasor",
	"ext_ini" 	=> "Ayar Dosyası",
	"ext_cfg" 	=> "Ayar Dosyası",
	"ext_res"	=> "Resource Ayar Dosyası",
	"ext_txt" 	=> "Metin Belgesi",
	"ext_log"	=> "Sunucu Log Dosyası"
);

$ext_process = array(
	"dir" 		=> 2,
	"ext_ini" 	=> 1,
	"ext_res"	=> 1,
	"ext_cfg" 	=> 1,
	"ext_txt" 	=> 1,
	"ext_log"	=> 1
);

$access_ext = array(
	"tga"  => 1,
	"ini"  => 1,
	"cfg"  => 1,
	"txt"  => 1,
	"bsp"  => 1,
	"res"  => 1,
	"mdl"  => 1,
	"wav"  => 1,
	"mp3"  => 1,
	"amxx" => 1,
	"spr"  => 1,
	"dat"  => 1
);

$ext_process_name = array(
	1 => "Duzenle",
	2 => "Klasore Git"
);

function FTPCon_RestrictedPath($path) {
	if($path=="") return true;
	global $restricted_dirs,$restricted_files;
	if(!is_dir($path)) {
		$file = pathinfo($path."",PATHINFO_FILENAME).".".pathinfo($path,PATHINFO_EXTENSION);
		if( !isset($restricted_files[$file]) ) return false; else return true;
	} else {
		$tmp_klasor = explode("/",$path);
		if( !isset($restricted_dirs[$tmp_klasor[count($tmp_klasor) - 1]]) ) return false; else return true;
	}
}

function ListADirectory($path) {
	global $exts,$ext_process;
	if(!is_dir($path)) return false;
	$files = @scandir($path);
	if(@count($files) == 0) return false;
 	$files2 = array();
	$files3 = array();
	foreach($files as $file) {
		if($file == "." || FTPCon_RestrictedPath($path.$file) || ($file == ".." && $_SESSION["OGCP_WebFTP_Path"] == "/") ) continue;
		$filep = $path.$file;
		if(is_dir($filep)) {
			$file2["type"] = $file == ".." ? $exts[".."] : $exts["dir"];
			$file2["type2"] = $file == ".." ? ".." : "dir";
			$file2["size"] = "";
			$file2["link"] = "Klasore_Git=".$file;
			$files2[$file."/"] = $file2;
		} else {
			$ext = pathinfo($path.$file,PATHINFO_EXTENSION);
			$file2["type"] = $ext == "" ? "Dosya" : ( isset($exts[strtolower("ext_".$ext)]) ? "<b>".$exts[strtolower("ext_".$ext)]."</b>" : strtoupper($ext)." Dosyasi" );
			$file2["type2"] = strtolower("ext_".$ext);
			$file2["size"] = AdvFileSize($filep);
			$file2["link"] = @$ext_process[strtolower("ext_".$ext)] == 1 ? "Duzenle=".$file : "#";
			$files3[$file] = $file2;
		}
	}
	uksort($files2, "cmp");
	uksort($files3, "cmp");
	$files = array_merge($files2,$files3);
	return $files;
}

function AdvFileSize($file) {
	$size = filesize($file);
	if( $size < 1099511627776 && $size > 1073741824 ) {
		$size = "<span style='font-weight:bold;color:red'>".intval($size / 1048576)."G</span>";
	} else if( $size < 1099511627776 && $size > 1048576 ) {
		$size = "<span style='font-weight:bold;color:orange'>".intval($size / 1048576)."M</span>";
	} else if( $size < 1048576 && $size > 1024) {
		$size = "<span style='font-weight:bold;color:blue'>".intval($size / 1024)."K</span>";
	} else if( $size < 1024) {
		$size = "<span style='font-weight:bold;color:green'>".intval($size)."B</span>";
	} else {
		$size = "Unknown";
	}
	return $size;
}
?>
