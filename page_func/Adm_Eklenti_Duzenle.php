<?php 
	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Eklenti_Listesi'));
	$machinff = Adm_GetPlugin((int)@$_GET["ID"]);
	if($machinff == false) $page->GoLocation($page->CreatePageLink('Adm_Eklenti_Listesi'));
	$plugin = $machinff[(int)@$_GET["ID"]];
	
	if(isset($_POST["ogcp_editplugin"])) {
		if(@$_POST["plugin_name"] == "") $_POST["plugin_name"] = $plugin["PluginName"];
		if(@$_POST["plugin_desc"] == "") $_POST["plugin_desc"] = $plugin["PluginDesc"];
		if(@$_POST["plugin_file"] == "") $_POST["plugin_file"] = $plugin["PluginFileName"];
		if(@$_POST["plugin_show"] == "") $_POST["plugin_show"] = 0; else if($_POST["plugin_show"] == "on") $_POST["plugin_show"] = (int)$_POST["plugin_show"] == "on" ? 1 : 0;
		
		if(Adm_UpdatePlugin((int)@$_GET["ID"],$_POST["plugin_name"],$_POST["plugin_desc"],$_POST["plugin_file"],$_POST["plugin_show"]) != false) {
			$plugin["PluginName"] 		= $_POST["plugin_name"];
			$plugin["PluginDesc"] 		= $_POST["plugin_desc"];
			$plugin["PluginFileName"]	= $_POST["plugin_file"];
			$plugin["PluginShow"] 		= $_POST["plugin_show"];
			echo "Eklenti güncellendi!";
		} else {
			echo "Eklenti güncellenemedi!";
		}
	}
?>