<?php

	if($serverinfo["ServerFTPCon"] == 1) {
			if(@$_SESSION["OGCP_WebFTP_Path"] == "") $_SESSION["OGCP_WebFTP_Path"] = "/";
			if(@$_GET["Klasor"] == "Sifirla") $_SESSION["OGCP_WebFTP_Path"] = "/";
			$path = $serverinfo["ServerPath"]."/cstrike".$_SESSION["OGCP_WebFTP_Path"];
			$ssh2 = new ogcp_ssh2();
			if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
				//echo "Dizin: ".$path;
				$files = ListADirectory($ssh2->SFTP_FileLink($path));
				if(isset($_GET["Klasore_Git"])) {
					if( isset($files[@$_GET["Klasore_Git"]."/"]) ) {
						if(@$_GET["Klasore_Git"] == "..") {
							$tmp = explode("/",$_SESSION["OGCP_WebFTP_Path"]);
							$status = substr($_SESSION["OGCP_WebFTP_Path"],$_SESSION["OGCP_WebFTP_Path"] - 1,1) == "/" ? 2 : 1;
							$count = count($tmp);
							for($i=0; $i < $status; $i++) { $count--; unset($tmp[$count]); }
							$new_path = implode("/",$tmp)."/";
							$_SESSION["OGCP_WebFTP_Path"] = $new_path;
						} else {
							$_SESSION["OGCP_WebFTP_Path"] = $_SESSION["OGCP_WebFTP_Path"].$_GET["Klasore_Git"]."/";
						}
						$path = $serverinfo["ServerPath"]."/cstrike".$_SESSION["OGCP_WebFTP_Path"];
						$files = ListADirectory($ssh2->SFTP_FileLink($path));
					}
				}
				if(isset($_GET["Duzenle"])) {
					if( isset($files[@$_GET["Duzenle"]]) && file_exists( $ssh2->SFTP_FileLink($path.$_GET["Duzenle"]) ) ) {
						if(isset($_POST["yardir"]) && $_SESSION["OGCP_WebFTP_Path"] != "/addons/amxmodx/logs/") {
							$tmp_file = "tmp/tmp_".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_".basename($path.$_GET["Duzenle"]);
							$ssh2->SFTP_DownloadFile($path.$_GET["Duzenle"],$tmp_file);
							$dosya = fopen($tmp_file,"w");
							fwrite($dosya,$_POST["icerikD"]);
							@fclose($dosya);
							if( $ssh2->SFTP_UploadFile($tmp_file,$path.$_GET["Duzenle"]) ) {
								unlink($tmp_file);
								$page->GoLocation($page->CreatePageLink($cur_page,"Duzenle=".@$_GET["Duzenle"]."&Durum=Duzenlendi"));
							} else {
								unlink($tmp_file);
								$page->GoLocation($page->CreatePageLink($cur_page,"Duzenle=".@$_GET["Duzenle"]."&Durum=Duzenlenemedi"));
							}
						}
						$dosya = $files[$_GET["Duzenle"]];
						$dosya["name"] = $_GET["Duzenle"];
						$dosyaac = fopen($ssh2->SFTP_FileLink($path.$_GET["Duzenle"]),'r');
						$dosya["content"] = "";
						while(!feof($dosyaac)) { $dosya["content"] .= fgets($dosyaac,8192); }
					} else {
						$dosya = false;
					}
					if( @$_GET["Durum"] == "Duzenlendi" ) {
						print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Dosya kaydedildi!</div>');
					} else if(@$_GET["Durum"] == "Duzenlenemedi") {
						print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Dosya kaydedilemedi!</div>');
					}
				}
				if(isset($_POST["klasor_olustur"])) {
					if(@$_POST["klasor"] != "") {
						if( mkdir($ssh2->SFTP_FileLink($path.$_POST["klasor"])) ) {
							print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Klasor oluşturuldu!</div>');
							$files = ListADirectory($ssh2->SFTP_FileLink($path));
						} else {
							print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Klasor oluşturulamadı!</div>');
						}
					}
				}
				if(isset($_POST["dosya_sil"])) {
					if(@$_POST["dosya"] != "") {
						//print($serverinfo["ServerPath"] . "/cstrike" . $_SESSION["OGCP_WebFTP_Path"] . $_POST["dosya"]);
						if( file_exists( $ssh2->SFTP_FileLink( $serverinfo["ServerPath"] . "/cstrike" . $_SESSION["OGCP_WebFTP_Path"] . $_POST["dosya"] ) ) ) {
							$durum = $ssh2->SFTP_DeleteFile( $serverinfo["ServerPath"] . "/cstrike" . $_SESSION["OGCP_WebFTP_Path"] . $_POST["dosya"] );
							if( $durum )
							{
								print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Dosya silindi!</div>');
								$files = ListADirectory($ssh2->SFTP_FileLink($path));
							} else {
								print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Dosya silinemedi!</div>');
							}
						}else {
							print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Dosya zaten silinmiş!</div>');
						}
					}
				}
				if(isset($_POST["yukle"]) && isset($_FILES['dosya'])) {
					$count = count($_FILES['dosya']['name']);
					for($i = 0; $i < $count; $i++) {
						if ($_FILES['dosya']['error'][$i] == 0) {
							$ext = pathinfo($_FILES['dosya']['name'][$i], PATHINFO_EXTENSION);
							if (!file_exists($ssh2->SFTP_FileLink($serverinfo["ServerPath"] . "/cstrike" . $_SESSION["OGCP_WebFTP_Path"] . $_FILES['dosya']['name'][$i])) && array_key_exists($ext, $access_ext)) {
								$durum = $ssh2->SFTP_UploadFile($_FILES['dosya']['tmp_name'][$i], $serverinfo["ServerPath"] . "/cstrike" . $_SESSION["OGCP_WebFTP_Path"] . $_FILES['dosya']['name'][$i]);
								if ($durum) {
									//if(!file_exists("/home/panel/dosyalar".$_SESSION["OGCP_WebFTP_Path"].$_FILES['dosya1']['name']))copy($_FILES['dosya1']['tmp_name'],"/home/panel/dosyalar".$_SESSION["OGCP_WebFTP_Path"].$_FILES['dosya1']['name']);
									print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Dosya sunucuya yüklendi!</div>');
									$files = ListADirectory($ssh2->SFTP_FileLink($path));
								} else {
									print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Hata!</strong> Yukleme başarısız! </div>');
								}
							} else {
								print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Hata!</strong> Dosya sunucuda bulunuyor yada dosya uzantısına izin verilmiyor! </div>');
							}
						} else {
							print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Hata!</strong> Yukleme başarısız! </div>');
						}
					}
				}
			} else {
				print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Hata!</strong> Web FTP\'ye erişim izniniz bulunmamaktadır! </div>');
			}
	} else {
		print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Hata!</strong> Web FTP\'ye erişim izniniz bulunmamaktadır! </div>');
	}
?>
