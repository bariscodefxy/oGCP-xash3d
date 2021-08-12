<?php 
	$ssh2 = new ogcp_ssh2();
	if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
		$file_link = $ssh2->SFTP_FileLink($serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/amxx.cfg");	
	} else {
		$file_link = "";
	}
	$reklamlar = CFG_GetVariable($file_link,array( "amx_imessage", "amx_scrollmsg" ));
	if( @count($reklamlar['amx_imessage']) <= 0 ) {
		$reklamlar['amx_imessage'][0][1] = "";
		$reklamlar['amx_imessage'][1][1] = "";
		$reklamlar['amx_imessage'][2][1] = "";
		$reklamlar['amx_imessage'][3][1] = "";
		$reklamlar['amx_imessage'][0][3] = "255255255";
		$reklamlar['amx_imessage'][1][3] = "255255255";
		$reklamlar['amx_imessage'][2][3] = "255255255";
		$reklamlar['amx_imessage'][3][3] = "255255255";
	}
	if(@count($reklamlar['amx_scrollmsg']) <= 0) {
		$reklamlar['amx_scrollmsg'][0][1] = "";
		$reklamlar['amx_scrollmsg'][0][2] = 30;
	} else {
		@$reklamlar['amx_scrollmsg'][0][2] = intval($reklamlar['amx_scrollmsg'][0][2]);	
	}
	if( isset($_POST["yardir"]) ) : 
	$mesaj1 = $_POST["reklam1"];
	$mesaj2 = $_POST["reklam2"];
	$mesaj3 = $_POST["reklam3"];
	$mesaj4 = $_POST["reklam4"];
	$mesar1 = $_POST["reklam1_renk"];
	$mesar2 = $_POST["reklam2_renk"];
	$mesar3 = $_POST["reklam3_renk"];
	$mesar4 = $_POST["reklam4_renk"];
	$kayanmesaj = $_POST["kayanyazi"];
	$kayanzaman = $_POST["kayanzaman"];
	$tmp_file = "tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_amxx.cfg";
	if( $ssh2->SFTP_DownloadFile($serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/amxx.cfg",$tmp_file) ) {
		$dosyaa = fopen($tmp_file,"r");
		$icerik = "";
		while(!feof($dosyaa)) $icerik .= fgets($dosyaa,8192);
		fclose($dosyaa);
		$icerik = str_replace("amx_imessage \"".$reklamlar['amx_imessage'][0][1]."\" \"".$reklamlar['amx_imessage'][0][3]."\"","amx_imessage \"".$mesaj1."\" \"".hex2rgb($mesar1)."\"",$icerik,$sayi);
		if($sayi <= 0) $icerik .= "\r\n"."amx_imessage \"".$mesaj1."\" \"".hex2rgb($mesar1)."\"";
		$icerik = str_replace("amx_imessage \"".$reklamlar['amx_imessage'][1][1]."\" \"".$reklamlar['amx_imessage'][1][3]."\"","amx_imessage \"".$mesaj2."\" \"".hex2rgb($mesar2)."\"",$icerik,$sayi);
		if($sayi <= 0) $icerik .= "\r\n"."amx_imessage \"".$mesaj2."\" \"".hex2rgb($mesar2)."\"";
		$icerik = str_replace("amx_imessage \"".$reklamlar['amx_imessage'][2][1]."\" \"".$reklamlar['amx_imessage'][2][3]."\"","amx_imessage \"".$mesaj3."\" \"".hex2rgb($mesar3)."\"",$icerik,$sayi);
		if($sayi <= 0) $icerik .= "\r\n"."amx_imessage \"".$mesaj3."\" \"".hex2rgb($mesar3)."\"";
		$icerik = str_replace("amx_imessage \"".$reklamlar['amx_imessage'][3][1]."\" \"".$reklamlar['amx_imessage'][3][3]."\"","amx_imessage \"".$mesaj4."\" \"".hex2rgb($mesar4)."\"",$icerik,$sayi);
		if($sayi <= 0) $icerik .= "\r\n"."amx_imessage \"".$mesaj4."\" \"".hex2rgb($mesar4)."\"";
		$icerik = str_replace("amx_scrollmsg \"".$reklamlar['amx_scrollmsg'][0][1]."\" ".intval($reklamlar['amx_scrollmsg'][0][2]),"amx_scrollmsg \"".$kayanmesaj."\" ".intval($kayanzaman),$icerik,$sayi);
		if($sayi <= 0) $icerik .= "\r\namx_scrollmsg \"".$kayanmesaj."\" ".intval($kayanzaman);
		$dosyaa = fopen($tmp_file,"w");
		fwrite($dosyaa,$icerik);
		@fclose($dosyaa);
		if($ssh2->SFTP_UploadFile($tmp_file,$serverinfo["ServerPath"]."/cstrike/addons/amxmodx/configs/amxx.cfg")) {
			unlink($tmp_file);
			$page->GoLocation($page->CreatePageLink($cur_page,"Durum=Kaydedildi"));
		} else {
			unlink($tmp_file);
			$page->GoLocation($page->CreatePageLink($cur_page,"Durum=Kaydedilemedi"));
		}
	} 
	else {
		unlink($tmp_file);
		$page->GoLocation($page->CreatePageLink($cur_page,"Durum=Kaydedilemedi"));
	}

	endif; // if( isset($_POST["yardir"]) )
	
	switch(@$_GET["Durum"]) {
	case "Kaydedildi": {
		print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Yapmış olduğunuz değişiklikler kaydedilmiştir!!</div>');
		break;
	}
	case "Kaydedilemedi": {
		print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Yapmış olduğunuz değişiklikler bir hata sonucu kaydedilemedi!!</div>');
		break;
	}
	}
?>