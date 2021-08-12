<?php
	$dosyalar = GetServerFiles();

	if(@$_GET["ID"] != 0) {
		$id = @$_GET["ID"];
		if( !isset($dosyalar[$id]) ) $page->GoLocation($page->CreatePageLink($cur_page));
		$ssh2 = new ogcp_ssh2();
		if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
			$file_link = $ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike".$dosyalar[$id]["FilePath"]);
		} else {
			$file_link = "";
		}
		if(!file_exists($file_link)) {
			$icerik = "";
		} else {
			$icerik = "";
			$dosyaac = fopen($file_link,"r");
			while(!feof($dosyaac)) $icerik .= fgets($dosyaac,8192);
			@fclose($dosyaac);
			$dosya = $dosyalar[$id];
			$dosya["FileContent"] = $icerik;
		}

		if(isset($_POST["yardir"])) {
			$tmp_file = "tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_".basename($file_link);
			$ssh2->SFTP_DownloadFile($serverinfo["ServerPath"]."/cstrike".$dosyalar[$id]["FilePath"],$tmp_file);
			file_put_contents($tmp_file,$_POST["icerikD"]);
			//unlink($file_link);
			if( $ssh2->SFTP_UploadFile($tmp_file,$serverinfo["ServerPath"]."/cstrike".$dosyalar[$id]["FilePath"]) ) {
				unlink($tmp_file);
				$page->GoLocation($page->CreatePageLink($cur_page,"ID=".$_GET["ID"]."&Durum=Duzenlendi"));
			} else {
				unlink($tmp_file);
				$page->GoLocation($page->CreatePageLink($cur_page,"ID=".$_GET["ID"]."&Durum=Duzenlenemedi"));
			}
		}
		if( @$_GET["Durum"] == "Duzenlendi" ) {
			print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Dosya kaydedildi!</div>');
		} else if(@$_GET["Durum"] == "Duzenlenemedi") {
			print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Dosya kaydedilemedi!</div>');
		}
	}
?>