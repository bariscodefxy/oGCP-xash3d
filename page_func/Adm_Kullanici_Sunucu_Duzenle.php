<?php 
	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Kullanicilar'));
	$machinff = Adm_GetUserServer((int)@$_GET["ID"]);
	if($machinff == false) $page->GoLocation($page->CreatePageLink('Adm_Kullanicilar'));
	$userserver = $machinff[(int)@$_GET["ID"]];
	$servers = Adm_GetServerList();
	
	if(isset($_POST["ogcp_edituserserver"])) {
		if(@$_POST["sunucu_sec"] <= 0) $_POST["sunucu_sec"] = $userserver["ServerID"];
		if(@$_POST["server_status"] < 0) $_POST["server_status"] = $userserver["UserServerStatus"];
		if(@$_POST["plugin_cont"] < 0) $_POST["plugin_cont"] = $userserver["ServerPluginCon"];
		if(@$_POST["ftp_cont"] < 0) $_POST["ftp_cont"] = $userserver["ServerFTPCon"];
		if(@$_POST["server_price"] < 0) $_POST["server_price"] = $userserver["UserServerPrice"];
		if(@$_POST["bank_type"] < 0) $_POST["bank_type"] = $userserver["UserServerBank"];
		if(@$_POST["server_time"] == "") $_POST["server_time"] = date('d-m-Y',$userserver["UserServerPriceTime"]);
		
		$_POST["server_time"] = str_replace(array('/','.'),'-',$_POST["server_time"]);
		$date = DateTime::createFromFormat('d-m-Y', $_POST["server_time"]);
		$_POST["server_time"] = $date->getTimestamp();
		
		if(Adm_UpdateUserServer((int)@$_GET["ID"],$_POST["sunucu_sec"],$_POST["server_status"],$_POST["ftp_cont"],$_POST["plugin_cont"],$_POST["server_time"],$_POST["server_price"],$_POST["bank_type"]) != false) {
			$userserver["ServerID"] = $_POST["sunucu_sec"];
			$userserver["UserServerStatus"] = $_POST["server_status"];
			$userserver["ServerPluginCon"] = $_POST["plugin_cont"];
			$userserver["ServerFTPCon"] = $_POST["ftp_cont"];
			$userserver["UserServerPriceTime"] = $_POST["server_time"];
			$userserver["UserServerPrice"] = $_POST["server_price"];
			$userserver["UserServerBank"] = $_POST["bank_type"];
			echo "Sunucu güncellendi!";
		} else {
			echo "Sunucu güncellenemedi!";
		}
	}
?>