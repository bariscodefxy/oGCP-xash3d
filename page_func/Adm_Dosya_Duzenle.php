<?php 
	if( (int)@$_GET["ID"] <= 0 ) $page->GoLocation($page->CreatePageLink('Adm_Dosyalar'));
	$machinff = Adm_GetFile((int)@$_GET["ID"]);
	if($machinff == false) $page->GoLocation($page->CreatePageLink('Adm_Dosyalar'));
	$file = $machinff[(int)@$_GET["ID"]];
	
	if(isset($_POST["ogcp_updatefile"])) {
		if(@$_POST["file_name"] == "")	$_POST["file_name"] = $file["FileName"];
		if(@$_POST["file_path"] == "") 	$_POST["file_path"] = $file["FilePath"];
		$_POST["file_path"] = substr($_POST["file_path"],0,1) != "/" ? "/".$_POST["file_path"] : "".$_POST["file_path"];
		if(Adm_UpdateFile((int)@$_GET["ID"],$_POST["file_name"],$_POST["file_path"])) {
			$file["FileName"] = $_POST["file_name"];
			$file["FilePath"] = $_POST["file_path"];
			echo "Dosya güncellendi!";
		} else {
			echo "Dosya güncellenemedi!";
		}
	}
?>