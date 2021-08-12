<?php
	if( isset($_POST["ogcp_addmach"]) ) {
		if(@$_POST["mach_ip"] != "" || (int)@$_POST["mach_port"] != 0 || @$_POST["mach_kadi"] != "" || @$_POST["mach_pass"] != "") {
			if(Adm_AddMachine($_POST["mach_ip"],$_POST["mach_port"],$_POST["mach_kadi"],$_POST["mach_pass"])) {
				echo "Makine Eklendi!";
			} else {
				echo "Makine eklenemedi!";
			}
		}
	}
?>