<?php 
	$name	= $userinf["UserName"];
	$group	= $yetkiler[$userinf["UserGroup"]];
	$regd	= date('d-m-Y',strtotime($userinf["UserCreateTime"]));
	$email	= $userinf["UserEmail"];
	$email2	= $userinf["UserEmail2"];
	$city	= $userinf["UserCity"];
	$comment= $userinf["UserComment"];
	$address= $userinf["UserAddress"];
	$onckg	= $userinf["UserLastLogin2"] == 0 ? "---" : date('d-m-Y',$userinf["UserLastLogin2"]);
	$telephone = substr($userinf["UserTelephone"],0,1)." ".substr($userinf["UserTelephone"],1,3)." ".substr($userinf["UserTelephone"],4,3)." ".substr($userinf["UserTelephone"],7);
?>