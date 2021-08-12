<?php 
	if(@$_SESSION["OGCP_UserAdmin"] == true) {
		@$_SESSION["OGCP_SelectedServer"] = 0;
	}
	
	$page->GoLocation($page->CreatePageLink('Anasayfa'));
?>