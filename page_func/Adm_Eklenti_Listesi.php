<?php
	$plugin_info = Adm_GetPluginList();
	
	if(@$_GET["Islem"] == "Sil" && (int)@$_GET["ID"] != 0 && isset($plugin_info[(int)@$_GET["ID"]]) ) {
		$del_query = $baglan->prepare("DELETE FROM ogcp_plugins WHERE PluginID=".intval($_GET["ID"]));
		$del_query->execute();
		if($del_query->rowCount() > 0) {
			unset($plugin_info[(int)$_GET["ID"]]);
			echo "Eklenti Silindi!";
		} else {
			echo "Eklenti Silinemedi!";
		}
	}
?>