<?php
	$dosyalar = Adm_GetFilesList();
	if(@$_GET["Islem"] == "Sil" && (int)@$_GET["ID"] != 0 && isset($dosyalar[(int)@$_GET["ID"]]) ) {
		$del_query = $baglan->prepare("DELETE FROM ogcp_files WHERE FileID=".intval($_GET["ID"]));
		$del_query->execute();
		if($del_query->rowCount() > 0) {
			unset($dosyalar[(int)$_GET["ID"]]);
			echo "Dosya Silindi!";
		} else {
			echo "Dosya Silinemedi!";
		}
	}
?>