<?php if(count($servers) < 2) header("Location:".$page->CreatePageLink($page->DefaultPage())); 
	if(@$_GET["ID"] != "") {
		if( isset($servers[(int)$_GET["ID"]]) && ( intval($servers[(int)$_GET["ID"]]["UserServerPriceTime"]) - time() > 0 ) ) {
			$_SESSION["OGCP_SelectedServer"] = (int)$_GET["ID"];
			$page->GoLocation($page->CreatePageLink($page->DefaultPage()));
		} else {
			print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Seçtiğiniz sunucunun size süresi dolmuş..! </div>');
		}
	}
?>