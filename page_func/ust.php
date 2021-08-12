<?php 
	$title =  ($_SESSION["OGCP_UserAdmin"] == true && @$_SESSION["OGCP_SelectedServer"] == 0 ? $adm_pages[$cur_page]["Name"] : $pages[$cur_page]["Name"])." - ".$oGCP['web']['default-title'];
	
	// Menu Links
	if($_SESSION["OGCP_UserAdmin"] != true || @$_SESSION["OGCP_SelectedServer"] != 0) {
		$anasayfa_link	= $page->CreatePageLink('Anasayfa');
		$sunucularim_link 	= $page->CreatePageLink('Sunucu_Sec');
		$sunucuayarlari_link	= $page->CreatePageLink('Sunucu_Ayarlari');	
		$sunucuislemleri_link= $page->CreatePageLink('Sunucu_Islemleri');
		$dosyaduzenle_link	= $page->CreatePageLink('Dosya_Duzenle');	
		$sunucureklam_link	= $page->CreatePageLink('Sunucu_Reklamlari');
		$haritalistesi_link	= $page->CreatePageLink('Harita_Listesi');
		$komutgond_link	= $page->CreatePageLink('Komut_Gonder');	
		$webtop15_link	= $page->CreatePageLink('Web_TOP15');
		$adminekle_link	= $page->CreatePageLink('Admin_Ekle');
		$adminlist_link	= $page->CreatePageLink('Admin_Listesi');
		$webftp_link		= $page->CreatePageLink('Web_FTP');
		$eklentik_link	= $page->CreatePageLink('Eklenti_Kontrol');
		$bildirimg_link	= $page->CreatePageLink('Bildirim_Gonder');
		$bildirim_link	= $page->CreatePageLink('Bildirim_Listesi');
		$duyurular_link	= $page->CreatePageLink('Duyurular');
		$paketler_link	= $page->CreatePageLink('Paketler_ve_Ozellikleri');
		$profil_link	= $page->CreatePageLink('Profil');
		$kiralik_link	= $page->CreatePageLink('Kiralik_Sunucular');
		$sifredeg_link	= $page->CreatePageLink('Sifre_Degistir');
		$cikis_link 		= $page->CreatePageLink('Cikis');
		$sunucudurum 		= count(@$servers) > 1 ? 1 : 0;
		$kalan 		= (int)@$_SESSION["OGCP_SelectedServer"] == 0 ? "" : "Sunucunuzun Süresinin Bitmesine <b>".serverkalanzaman(time(),(int)$servers[$_SESSION["OGCP_SelectedServer"]]["UserServerPriceTime"])."</b> Kaldı";
		if(isset($_SESSION["OGCP_SelectedServer"]) && @$_SESSION["OGCP_SelectedServer"] != 0) $serverinfo = $servers[$_SESSION["OGCP_SelectedServer"]];
	} else {
		$anasayfa_link		= $page->CreatePageLink('Adm_Anasayfa');
		$kullanicilar_link 	= $page->CreatePageLink('Adm_Kullanicilar');
		$kullaniciekle_link = $page->CreatePageLink('Adm_Kullanici_Ekle');
		$bildirimler_link 	= $page->CreatePageLink('Adm_Bildirim_Listesi');
		$eklentiler_link 	= $page->CreatePageLink('Adm_Eklenti_Listesi');
		$eklentiekle_link 	= $page->CreatePageLink('Adm_Eklenti_Ekle');
		$duyurular_link 	= $page->CreatePageLink('Adm_Duyurular');
		$duyuruekle_link 	= $page->CreatePageLink('Adm_Duyuru_Ekle');
		$sunucular_link 	= $page->CreatePageLink('Adm_Sunucular');
		$sunucuekle_link 	= $page->CreatePageLink('Adm_Sunucu_Ekle');
		$makineler_link 	= $page->CreatePageLink('Adm_Makineler');
		$makineekle_link 	= $page->CreatePageLink('Adm_Makine_Ekle');
		$dosyalar_link 		= $page->CreatePageLink('Adm_Dosyalar');
		$dosyaekle_link 	= $page->CreatePageLink('Adm_Dosya_Ekle');
		$profil_link		= $page->CreatePageLink('Adm_Profil');
		$sifredeg_link		= $page->CreatePageLink('Adm_Sifre_Degistir');
		$cikis_link			= $page->CreatePageLink('Adm_Cikis');
		$sunucudurum		= Adm_GetServersSum();
	}
	$user_current_ip 	= $_SERVER['REMOTE_ADDR'];
?>