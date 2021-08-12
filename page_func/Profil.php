<?php 
	$name	= $userinf["UserName"];
	$email	= $userinf["UserEmail"];
	$email2	= $userinf["UserEmail2"];
	$bakiye	= $userinf["bakiye"];
	$city	= $userinf["UserCity"];
	$address= $userinf["UserAddress"];
	$regd	= date('d-m-Y',strtotime($userinf["UserCreateTime"]));
	$onckg	= $userinf["UserLastLogin2"] == 0 ? "---" : date('d-m-Y',$userinf["UserLastLogin2"]);
	$servc = count($servers);
	$toplam = 0;
	$telephone = substr($userinf["UserTelephone"],0,1)." ".substr($userinf["UserTelephone"],1,3)." ".substr($userinf["UserTelephone"],4,3)." ".substr($userinf["UserTelephone"],7);
	$odeme = "";
	foreach($servers as $server) {
		$toplam += (int)$server["UserServerPrice"];
		$odeme .= "<tr style='font-weight:bold;'><td><span style='color:blue'>".$server["ServerIP"].":".$server["ServerPort"]."</span></td><td><span style='color:red'>".date('d/m/Y',(int)$server["UserServerPriceTime"])."</span></td><td>".$server["UserServerPrice"]." TL</td><td><span style='color:orange'>".$bankalar[$server["UserServerBank"]]."</span></td></tr>";
	}
?>