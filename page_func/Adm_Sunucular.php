<?php
	$servers = Adm_GetServerList();
	if(@$_GET["Islem"] == "Sil" && (int)@$_GET["ID"] != 0 && isset($servers[(int)@$_GET["ID"]]) ) {
		$del_query = $baglan->prepare("DELETE FROM ogcp_servers WHERE ServerID=".intval($_GET["ID"])."; DELETE FROM ogcp_userservers WHERE ServerID=".intval($_GET["ID"]));
		$del_query->execute();
		if($del_query->rowCount() > 0) {
			unset($servers[(int)$_GET["ID"]]);
			echo "Sunucu Silindi!";
		} else {
			echo "Sunucu Silinemedi!";
		}
	}
?>