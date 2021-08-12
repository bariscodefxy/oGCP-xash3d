<?php
	$machines = Adm_GetMachineList();
	$packets = Adm_GetPacketList();
	if( isset($_POST["ogcp_addserver"]) ) {
		if( @$_POST["server_ip"] != "" && intval(@$_POST["server_port"]) > 0 && intval(@$_POST["server_port"]) < 65536 && isset($machines[@$_POST["server_mach"]]) && isset($packets[$_POST["server_packet"]]) && @$_POST["server_map"] != "" && (int)@$_POST["server_maxslot"] > 0 && (int)@$_POST["server_maxslot"] < 33 && @$_POST["server_path"] != "") {
			if( Adm_AddServer($_POST["server_ip"],$_POST["server_port"],$_POST["server_mach"],$_POST["server_packet"],$_POST["server_map"],$_POST["server_maxslot"],$_POST["server_path"]) )
			echo "Sunucu Eklendi!";
		} else {
			echo "Sunucu eklenemedi! Alanlarý kontrol ediniz!";
		}
	}
?>