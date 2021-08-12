<?php
	if( isset($_POST["ogcp_addplugin"]) ) {
		if(@$_POST["plugin_name"] != "" || @$_POST["plugin_desc"] != "" || @$_POST["plugin_"] != "" || (@$_POST["plugin_show"] != "on" && @$_POST["plugin_show"] != "off") || @$_POST["plugin_file"] != "") {
			if(Adm_AddPlugin($_POST["plugin_name"],$_POST["plugin_desc"],$_POST["plugin_file"],$_POST["plugin_show"] == "on" ? 1 : 0)) {
				echo "Eklenti Eklendi!";
			} else {
				echo "Eklenti Eklenemedi!";
			}
		}
	}
?>