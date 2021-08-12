<?php 
	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Makineler'));
	$machinff = Adm_GetMachine((int)@$_GET["ID"]);
	if($machinff == false) $page->GoLocation($page->CreatePageLink('Adm_Makineler'));
	$machine = $machinff[(int)@$_GET["ID"]];
	
	if(isset($_POST["ogcp_editmach"])) {
		if(@$_POST["mach_ip"] == "")	$_POST["mach_ip"] = $machine["MachIP"];
		if((int)@$_POST["mach_port"] <= 0 || (int)@$_POST["mach_port"] > 65535)	$_POST["mach_port"] = (int)$machine["MachPort"];
		if(@$_POST["mach_kadi"] == "") 	$_POST["mach_kadi"] = $machine["MachUser"];
		if(@$_POST["mach_pass"] == "") 	$_POST["mach_pass"] = $machine["MachPass"];
		
		if(Adm_UpdateMachine((int)@$_GET["ID"],$_POST["mach_ip"],(int)$_POST["mach_port"],$_POST["mach_kadi"],$_POST["mach_pass"])) {
			$machine["MachIP"] = $_POST["mach_ip"];
			$machine["MachPort"] = $_POST["mach_port"];
			$machine["MachUser"] = $_POST["mach_kadi"];
			$machine["MachPass"] = $_POST["mach_pass"];
			echo "Makine güncellendi!";
		} else {
			echo "Makine güncellenemedi!";
		}
	}
?>