<?php
	session_start();
	require_once('sistem/baglan.php');
	require_once('sistem/fonksiyon.php');
	require_once('sistem/page_class.php');
	require_once('sistem/cs16_query.php');
	require_once('sistem/cs16_rcon.php');
	require_once('sistem/ogcp_ssh2.php');
	require_once('sistem/phprcon.php');

	$pages = Array(
		"Giris"				=> Array("Name" => "Giriş", "URL" => "Giris", "Header" => 0, "Status" => 0),
		"Cikis"				=> Array("Name" => "Çıkış", "URL" => "Cikis", "Header" => 0, "Status" => 1),
		"Sifre_Degistir"	=> Array("Name" => "Şifre Değiştir", "URL" => "Sifre_Degistir", "Header" => 1, "Status" => 1),
		"Profil"			=> Array("Name" => "Profil Bilgileri", "URL" => "Profil", "Header" => 1, "Status" => 1),
		"404"				=> Array("Name" => "404 - Sayfa Bulunamadı", "URL" => "404", "Header" => 0, "Status" => 2),
		"Sunucu_Ayarlari"	=> Array("Name" => "Sunucu Ayarları", "URL" => "Sunucu_Ayarlari", "Header" => 1, "Status" => 1),
		"Harita_Listesi"	=> Array("Name" => "Harita Listesi", "URL" => "Harita_Listesi", "Header" => 1, "Status" => 1),
		"Sunucu_Islemleri"	=> Array("Name" => "Sunucu İşlemleri", "URL" => "Sunucu_Islemleri", "Header" => 1, "Status" => 1),
		"Sunucu_Reklamlari"	=> Array("Name" => "Sunucu Reklamları", "URL" => "Sunucu_Reklamlari", "Header" => 1, "Status" => 1),
		"Komut_Gonder"		=> Array("Name" => "Komut Gönder", "URL" => "Komut_Gonder", "Header" => 1, "Status" => 1),
		"Web_TOP15"			=> Array("Name" => "Web TOP15", "URL" => "Web_TOP15", "Header" => 1, "Status" => 1),
		"Duyurular"			=> Array("Name" => "Duyurular", "URL" => "Duyurular", "Header" => 1, "Status" => 1),
		"Web_FTP"			=> Array("Name" => "Web FTP", "URL" => "Web_FTP", "Header" => 1, "Status" => 1),
		"Eklenti_Kontrol"	=> Array("Name" => "Eklenti Kur/Kaldır", "URL" => "Eklenti_Kontrol", "Header" => 1, "Status" => 1),
		"Dosya_Duzenle"		=> Array("Name" => "Dosya Düzenle", "URL" => "Dosya_Duzenle", "Header" => 1, "Status" => 1),
		"Admin_Listesi"		=> Array("Name" => "Admin Listesi", "URL" => "Admin_Listesi", "Header" => 1, "Status" => 1),
		"Admin_Ekle"		=> Array("Name" => "Admin Ekle", "URL" => "Admin_Ekle", "Header" => 1, "Status" => 1),
		"Bildirim_Listesi"	=> Array("Name" => "Bildirim Listesi", "URL" => "Bildirim_Listesi", "Header" => 1, "Status" => 1),
		"Bildirim_Goster"	=> Array("Name" => "Bildirim Göster", "URL" => "Bildirim_Goster", "Header" => 1, "Status" => 1),
		"Bildirim_Gonder"	=> Array("Name" => "Bildirim Gönder", "URL" => "Bildirim_Gonder", "Header" => 1, "Status" => 1),
		"Admin_Duzenle"		=> Array("Name" => "Admin Duzenle", "URL" => "Admin_Duzenle", "Header" => 1, "Status" => 1),
		"Yonetici_Paneli"	=> Array("Name" => "Yönetici Paneli", "URL" => "Yonetici_Paneli", "Header" => 1, "Status" => 1),
		"Sunucu_Sec"		=> Array("Name" => "Sunucu Seç", "URL" => "Sunucu_Sec","Header" => 1,"Status" => 1),
		"Anasayfa"			=> Array("Name" => "Anasayfa", "URL" => "Anasayfa", "Header" => 1, "Status" => 1),
		"Kiralik_Sunucular"	=> Array("Name" => "Kiralık Sunucu Listesi", "URL" => "Kiralik_Sunucular", "Header" => 1, "Status" => 1)
	);

	$adm_pages = Array(
		"Giris"					=> Array("Name" => "Giriş", "URL" => "Giris", "Header" => 0, "Status" => 0),
		"Adm_Anasayfa"			=> Array("Name" => "Anasayfa", "URL" => "Anasayfa", "Header" => 1, "Status" => 1),
		"Adm_Kullanicilar"		=> Array("Name" => "Kullanıcılar", "URL" => "Kullanicilar", "Header" => 1, "Status" => 1, "Perm" => "ShowUsers"),
		"Adm_Kullanici_Duzenle"	=> Array("Name" => "Kullanıcı Düzenle", "URL" => "Kullanici_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowUsers"),
		"Adm_Kullanici_Ekle"	=> Array("Name" => "Kullanıcı Ekle", "URL" => "Kullanici_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowUsers"),
		"Adm_Kullanici_Sunucu_Ekle"	=> Array("Name" => "Kullanıcıya Sunucu Ekle", "URL" => "Kullanici_Sunucu_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowUsers"),
		"Adm_Kullanici_Sunucu_Duzenle"	=> Array("Name" => "Kullanıcının Sunucusunu Düzenle", "URL" => "Kullanici_Sunucu_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowUsers"),
		"Adm_Bildirim_Listesi"	=> Array("Name" => "Bildirim Listesi", "URL" => "Bildirim_Listesi", "Header" => 1, "Status" => 1, "Perm" => "ShowTickets"),
		"Adm_Bildirim_Goster"	=> Array("Name" => "Bildirim Göster", "URL" => "Bildirim_Goster", "Header" => 1, "Status" => 1, "Perm" => "ShowTickets"),
		"Adm_Eklenti_Listesi"	=> Array("Name" => "Eklenti Listesi", "URL" => "Eklenti_Listesi", "Header" => 1, "Status" => 1, "Perm" => "ShowPlugins"),
		"Adm_Eklenti_Duzenle"	=> Array("Name" => "Eklenti Düzenle", "URL" => "Eklenti_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowPlugins"),
		"Adm_Eklenti_Ekle"		=> Array("Name" => "Eklenti Ekle", "URL" => "Eklenti_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowPlugins"),
		"Adm_Makineler"			=> Array("Name" => "Makine Listesi", "URL" => "Makineler", "Header" => 1, "Status" => 1, "Perm" => "ShowMachine"),
		"Adm_Makine_Duzenle"	=> Array("Name" => "Makine Düzenle", "URL" => "Makine_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowMachine"),
		"Adm_Makine_Ekle"		=> Array("Name" => "Makine Ekle", "URL" => "Makine_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowMachine"),
		"Adm_Sunucular"			=> Array("Name" => "Sunucu Listesi", "URL" => "Sunucular", "Header" => 1, "Status" => 1, "Perm" => "ShowServers"),
		"Adm_Sunucu_Duzenle"	=> Array("Name" => "Sunucu Düzenle", "URL" => "Sunucu_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowServers"),
		"Adm_Sunucu_Ekle"		=> Array("Name" => "Sunucu Ekle", "URL" => "Sunucu_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowServers"),
		"Adm_Duyurular"			=> Array("Name" => "Duyuru Listesi", "URL" => "Duyurular", "Header" => 1, "Status" => 1, "Perm" => "ShowAnnouncements"),
		"Adm_Duyuru_Duzenle"	=> Array("Name" => "Duyuru Düzenle", "URL" => "Duyuru_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowAnnouncements"),
		"Adm_Duyuru_Ekle"		=> Array("Name" => "Duyuru Ekle", "URL" => "Duyuru_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowAnnouncements"),
		"Adm_Dosyalar"			=> Array("Name" => "Dosya Listesi", "URL" => "Dosyalar", "Header" => 1, "Status" => 1, "Perm" => "ShowFiles"),
		"Adm_Dosya_Duzenle"		=> Array("Name" => "Dosya Düzenle", "URL" => "Dosya_Duzenle", "Header" => 1, "Status" => 1, "Perm" => "ShowFiles"),
		"Adm_Dosya_Ekle"		=> Array("Name" => "Dosya Ekle", "URL" => "Dosya_Ekle", "Header" => 1, "Status" => 1, "Perm" => "ShowFiles"),
		"Adm_Cikis"				=> Array("Name" => "Çıkış", "URL" => "Cikis", "Header" => 0, "Status" => 1),
		"Adm_Sifre_Degistir"	=> Array("Name" => "Şifre Değiştir", "URL" => "Sifre_Degistir", "Header" => 1, "Status" => 1),
		"Adm_Profil"			=> Array("Name" => "Profil Bilgileri", "URL" => "Profil", "Header" => 1, "Status" => 1),
	);

	$page = new PageFrmwork($pages,$oGCP['web']['siteadres']);

	if(isset($_SESSION["OGCP_UserLogged"])) {
		// User Control
		$userinf = ControlUser();
		if($userinf == false) $page->GoLocation($page->CreatePageLink($page->DefaultPage()) );

		// User Admin Control
		$_SESSION["OGCP_UserAdmin"] = IsUserAdmin((int)$userinf["UserGroup"]);

		// Server Control
		if($_SESSION["OGCP_UserAdmin"] != true) { // Kullanıcı Admin değilse kontrol et.
			$servers = GetUserServers();
			if($servers == false) { @session_destroy(); $page->GoLocation($page->CreatePageLink('Giris','Hata=2')); }
			$servern = count($servers);
			$now = time();
			$status = $servern;
			if($status > 1) $status = 2;
			switch($status) {
				case 1: {
					foreach($servers as $server_one) {
						$_SESSION["OGCP_SelectedServer"] = (int)$server_one["UserServerID"];
					}
				}
				case 2: {
					if(@$_SESSION["OGCP_SelectedServer"] == 0 && ContSunucuSecPage() ) {
						$_SESSION["OGCP_SelectedServer"] = 0;
						$_GET["Page"] = "Sunucu_Sec";
					}
				}
				default: {
					if(@$_SESSION["OGCP_SelectedServer"] != 0) {
						if($servers[@$_SESSION["OGCP_SelectedServer"]]["UserServerPriceTime"] < time()) {
							if($status == 1) { @session_destroy(); }
							else if($status == 2) {  $_GET["Page"] = "Sunucu_Sec"; $_GET["Durum"] = "Sure_Doldu!"; }
						}
					}
				}
			} // switch($status)
		} else if($_SESSION["OGCP_UserAdmin"] == true && @$_SESSION["OGCP_SelectedServer"] != 0) {
			$servers = Adm_GetContServer();
			if($servers == false) { $_SESSION["OGCP_SelectedServer"] = 0; $page->GoLocation($page->CreatePageLink('Anasayfa')); }
			//$serverinfo = $servers[$_SESSION["OGCP_SelectedServer"]];
		} else {
			$page = new PageFrmwork($adm_pages,$oGCP['web']['siteadres']);
			$_GET["Page"] = "Adm_".$_GET["Page"];
		} // if($_SESSION["OGCP_UserAdmin"] != true)
	} // if(isset($_SESSION["OGCP_UserLogged"]))
	if(@$_GET["Page"] == "") $page->GoLocation($page->CreatePageLink($page->DefaultPage()));
	if( $page->pageControl() && (@$_SESSION["OGCP_UserAdmin"] ? $page->Adm_PermControl(@$userinf,@$_GET["Page"]) : true) )  {
				@$cur_page = @$_GET["Page"];
				if((@$_SESSION["OGCP_UserAdmin"] == true && @$_SESSION["OGCP_SelectedServer"] == 0 ? $adm_pages[$cur_page]["Header"] : @$pages[$cur_page]["Header"]) == 1) { require_once("page_func/ust.php"); include("page_tpl/ust.tpl"); }
				require_once($page->LoadFunction_File($cur_page));
				include($page->LoadTemplate_File(@$cur_page));
				if((@$_SESSION["OGCP_UserAdmin"] == true && @$_SESSION["OGCP_SelectedServer"] == 0 ? $adm_pages[$cur_page]["Header"] : @$pages[$cur_page]["Header"]) == 1) { require_once("page_func/alt.php"); include("page_tpl/alt.tpl"); }
	}	else {
		$page->GoLocation($page->CreatePageLink('404'));
	}
?>
