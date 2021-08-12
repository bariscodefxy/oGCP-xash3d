<?php
	$machines = Adm_GetMachineList();
	if(@$_GET["Islem"] == "Sil" && (int)@$_GET["ID"] != 0 && isset($machines[(int)@$_GET["ID"]]) ) {
		$del_query = $baglan->prepare("DELETE FROM ogcp_machines WHERE MachID=".intval($_GET["ID"]));
		$del_query->execute();
		if($del_query->rowCount() > 0) {
			unset($machines[(int)$_GET["ID"]]);
			echo "Makine Silindi!";
		} else {
			echo "Makine Silinemedi!";
		}
	}
?>