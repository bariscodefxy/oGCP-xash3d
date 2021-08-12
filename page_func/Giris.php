<?php
$title =  $pages[$cur_page]["Name"]." - ".$oGCP['web']['default-title'];

if( isset($_POST["ogcp_submit"],$_POST["ogcp_email"],$_POST["ogcp_pass"]) ) {
	if(@$_POST["beni_hatirla"] == "on") { setcookie("OGCP_Login_Mail",addslashes($_POST["ogcp_email"])); }
	else if(@$_POST["beni_hatirla"] == "") { setcookie("OGCP_Login_Mail",""); }

	if(LoginUser($_POST["ogcp_email"],$_POST["ogcp_pass"]) == true) {
		$page->GoLocation($page->CreatePageLink("Anasayfa"));
	} else {
		$page->GoLocation($page->CreatePageLink("Giris","Hata=1"));
	}
}

switch(@$_GET["Hata"]) {
	case 1: {
		print('<center><div class="alert alert-error" style="max-width:500px;"><button type="button" class="close" data-dismiss="alert">×</button>Yanlış Kullanıcı Adı/Şifre Kombinasyonu!</div></center>');
		break;
	}
	case 2: {
		print('<center><div class="alert alert-error" style="max-width:500px;"><button type="button" class="close" data-dismiss="alert">×</button>Kullanıcının yönetebileceği sunucusu bulunmamaktadır!</div></center>');
		break;
	}
}
?>