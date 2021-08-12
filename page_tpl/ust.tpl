<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="XrouRamein">
    <link rel="shortcut icon" href="<?=$page->LoadTheme_File('ico/favicon.png')?>">
    <link href="<?=$page->LoadTheme_File('css/bootstrap.css')?>" rel="stylesheet">
    <link href="<?=$page->LoadTheme_File('css/theme.css')?>" rel="stylesheet">
    <link href="<?=$page->LoadTheme_File('css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=$page->LoadTheme_File('css/alertify.css')?>" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
    <link rel="Favicon Icon" href="favicon.ico">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrap">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="logo" style="color: #DDDDDD">
            XashServers.tk (OGCP)
          </div>

          <div class="top-menu visible-desktop">
            <ul class="pull-left">
              <?php if(!@$_SESSION["OGCP_UserAdmin"]) { ?><li><a href="<?=$page->CreatePageLink('Adm_Sunucular')?>"><i class="icon-envelope"></i> Sunucular</a></li>
			  <li><div style="color: #DDDDDD;margin: 12px"><?=@$kalan?></div></li><?php } ?>
            </ul>
            <ul class="pull-right">
              <li><a href="<?=$cikis_link?>"><i class="icon-off"></i> Çıkış</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <!-- Side menu -->
      <div class="sidebar-nav nav-collapse collapse">
        <div class="user_side clearfix">
          <h5><?=$userinf["UserName"]?></h5>
		  <span style="color: #DDDDDD;font-size: 12px">Bakiye: <b><font color="#E28271"><?=$userinf["bakiye"]?></b></font> TL<br>
          <span style="color: #DDDDDD;font-size: 12px">IP Adresiniz: <?=$user_current_ip?><br>
          Önceki Giriş: <?=$userinf["UserLastLogin2"] == 0 ? "--" : date("d.m.Y",(int)$userinf["UserLastLogin2"]) ?></span>
        </div>
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle active b_F79999" href="<?=$anasayfa_link?>"><i class="icon-home"></i> <span>Anasayfa</span></a>
            </div>
          </div>
		<?php if($_SESSION["OGCP_UserAdmin"] != true || @$_SESSION["OGCP_SelectedServer"] != 0): if($sunucudurum == 1): ?>
	   <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F6F1A2" href="<?=$sunucularim_link?>"><i class="icon-dashboard"></i> <span>Sunucu Seç</span></a>
            </div>
          </div>
		<?php endif; ?>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_C3F7A7 collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse1"><i class="icon-magic"></i> <span>Genel Ayarlar</span></a>
            </div>
            <div id="collapse1" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$sunucuayarlari_link?>">Sunucu Ayarları</a>
				<a class="accordion-toggle" href="<?=$sunucuislemleri_link?>">Sunucu İşlemleri</a>
				<a class="accordion-toggle" href="<?=$haritalistesi_link?>">Harita Listesi</a>
				<a class="accordion-toggle" href="<?=$dosyaduzenle_link?>">Dosya Düzenle</a>
                <a class="accordion-toggle" href="<?=$sunucureklam_link?>">Sunucu Reklamları</a>
                <a class="accordion-toggle" href="<?=$komutgond_link?>">Komut Gönder</a>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse2"><i class="icon-bullhorn"></i> <span>Adminlik</span></a>
            </div>
            <div id="collapse2" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$adminekle_link?>"> Admin Ekle</a>
                <a class="accordion-toggle" href="<?=$adminlist_link?>"> Adminler</a>
              </div>
            </div>
          </div>
		  <div class="accordion-group"><div class="accordion-heading">
          <a class="accordion-toggle b_C1F8A9" href="<?=$webftp_link?>"><i class="icon-bar-chart"></i> <span>Web FTP</span></a>
          </div></div>
         <div class="accordion-group"><div class="accordion-heading">
         <a class="accordion-toggle b_F6F1A2" href="<?=$eklentik_link?>"><i class="icon-tasks"></i> <span>Eklenti Kur/Kaldır</span></a>
         </div></div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse3"><i class="icon-bullhorn"></i> <span>Bildirim</span></a>
            </div>
            <div id="collapse3" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$bildirimg_link?>"> Mesaj Gönder</a>
                <a class="accordion-toggle" href="<?=$bildirim_link?>"> Mesajlar</a>
                <a class="accordion-toggle" href="<?=$duyurular_link?>"> Duyurular</a>
             <a class="accordion-toggle" href="<?=$paketler_link?>"> Paketler ve Özellikleri</a>
              </div>
            </div>
          </div>
		  <?php if($_SESSION["OGCP_UserAdmin"]): ?>
		  <div class="accordion-group"><div class="accordion-heading">
          <a class="accordion-toggle b_C1F8A9" href="<?=$page->CreatePageLink('Yonetici_Paneli')?>"><i class="icon-bar-chart"></i> <span>Yönetici Paneli</span></a>
          </div></div>
		  <?php endif; else: ?>
			<?php if($userinf["ShowMachine"]): ?>
		    <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#makinelermenu" href="#makinelermenu"><i class="icon-desktop"></i> <span>Makineler</span></a>
            </div>
            <div id="makinelermenu" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$makineler_link?>"> Makine Listesi</a>
                <a class="accordion-toggle" href="<?=$makineekle_link?>"> Makine Ekle</a>
              </div>
            </div>
          </div>
		  <?php endif; if($userinf["ShowServers"]): ?>
		  <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#sunucularmenu" href="#sunucularmenu"><i class="icon-dashboard"></i> <span>Sunucular</span></a>
            </div>
            <div id="sunucularmenu" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$sunucular_link?>"> Sunucu Listesi</a>
                <a class="accordion-toggle" href="<?=$sunucuekle_link?>"> Sunucu Ekle</a>
              </div>
            </div>
          </div>
		  <?php endif; if($userinf["ShowUsers"]): ?>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse3"><i class="icon-user"></i> <span>Kullanıcılar</span></a>
            </div>
            <div id="collapse3" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$kullanicilar_link?>"> Kullanıcı Listesi</a>
                <a class="accordion-toggle" href="<?=$kullaniciekle_link?>"> Kullanıcı Ekle</a>
              </div>
            </div>
          </div>
		  <?php endif; if($userinf["ShowAnnouncements"]): ?>
		  <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#duyuru" href="#duyurumenu"><i class="icon-bell"></i> <span>Duyurular</span></a>
            </div>
            <div id="duyurumenu" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$duyurular_link?>"> Duyuru Listesi</a>
                <a class="accordion-toggle" href="<?=$duyuruekle_link?>"> Duyuru Ekle</a>
              </div>
            </div>
          </div>
		  <?php endif; if($userinf["ShowTickets"]): ?>
		  <div class="accordion-group"><div class="accordion-heading">
          <a class="accordion-toggle b_C1F8A9" href="<?=$bildirimler_link?>"><i class="icon-bullhorn"></i> <span>Bildirimler</span></a>
          </div></div>
		  <?php endif; if($userinf["ShowPlugins"]): ?>
		  <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#eklentimenu" href="#eklentimenu"><i class="icon-download"></i> <span>Eklentiler</span></a>
            </div>
            <div id="eklentimenu" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$eklentiler_link?>"> Eklenti Listesi</a>
                <a class="accordion-toggle" href="<?=$eklentiekle_link?>"> Eklenti Ekle</a>
              </div>
            </div>
          </div>
		  <?php endif; if($userinf["ShowFiles"]): ?>
		  <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_C3F7A7 collapsed" data-toggle="collapse" data-parent="#dosyamenu" href="#dosyamenu"><i class="icon-book"></i> <span>Dosyalar</span></a>
            </div>
            <div id="dosyamenu" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$dosyalar_link?>"> Dosya Listesi</a>
                <a class="accordion-toggle" href="<?=$dosyaekle_link?>"> Dosya Ekle</a>
              </div>
            </div>
          </div>
		  <?php endif; ?>
		  <?php endif; ?>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_9FDDF6 collapsed" data-toggle="collapse" data-parent="#accordion4" href="#collapse4"><i class="icon-star-empty"></i> <span> Profil</span></a>
            </div>
            <div id="collapse4" class="accordion-body collapse">
              <div class="accordion-inner">
                <a class="accordion-toggle" href="<?=$profil_link?>"> Profil Bilgileri</a>
                <a class="accordion-toggle" href="<?=$sifredeg_link?>"> Şifre Değiştir</a>

              </div>
            </div>
			<div class="accordion-group"><div class="accordion-heading">
          <a class="accordion-toggle b_C1F8A9" href="<?=$kiralik_link?>"><i class="icon-bullhorn"></i> <span>Kiralık Sunucular</span></a>
          </div></div>
          </div>
        </div>
      </div>
      <!-- /Side menu -->
     <div class="main_container" id="dashboard_page"><br>
