<?php
	if( isset($_POST["ogcp_addfile"]) ) {
		if(@$_POST["file_name"] != "" || @$_POST["file_path"] != "") {
			$_POST["file_path"] = substr($_POST["file_path"],0,1) != "/" ? "/".$_POST["file_path"] : "".$_POST["file_path"];
			if(Adm_AddFile($_POST["file_name"],$_POST["file_path"])) {
				echo "Dosya Eklendi!";
			} else {
				echo "Dosya Eklenemedi!";
			}
		}
	}
?>