<?php
	if(isset($_POST["ogcp_changepass"],$_POST["password"],$_POST["password_confirm"],$_POST["password_confirm2"])) {
		$crypted_pass = md5(md5($_POST["password"]));

		if($crypted_pass == $_SESSION["OGCP_UserPass"] && $_POST["password_confirm"] == $_POST["password_confirm2"] && $_POST["password_confirm"] != "") {
			if( ChangePassword(md5(md5($_POST["password_confirm"]))) != false ) {
				unset($_POST["ogcp_changepass"],$_POST["password"],$_POST["password_confirm"],$_POST["password_confirm2"]);
				$tamam = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Şifreniz değiştirildi..! </div>';
			} else {
				$hata = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Şifre değiştirilemedi..! </div>';
			}
		} else {
			$hata = '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Alanları kontrol ediniz..! </div>';
		}
	}
?>