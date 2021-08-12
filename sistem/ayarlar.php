<?php
/* oGCP - Oynucaz Game Control Panel
   Version: 1.1
   Dosya: "ayarlar.php"
   Yapımcı: Oynucaz Dev Team - Edited: CounterMerkezi.Net */

## - Veritabani - ##
error_reporting(0);
date_default_timezone_set('Europe/Istanbul');
$oGCP['veritabani']['host'] = "0.0.0.0";
$oGCP['veritabani']['kadi'] = "root";
$oGCP['veritabani']['sifre'] = "";
$oGCP['veritabani']['vtadi'] = "ogcp";

function SiteDizin(){
$dizin = $_SERVER["HTTP_HOST"];
return 'http://'.$dizin.'/';
}

## - Web Site Ayarlari * ##
$oGCP['web']['siteadres'] = SiteDizin().""; // "ogcp" yazan yer kurulduğu klasördür. örnegin: site.com/ogcp
$oGCP['web']['panel'] = "oGCP bariscodefx";
$oGCP['web']['version'] = "1.0.1";
$oGCP['web']['yapimci'] = "bariscodefx";
$oGCP['web']['default-title'] = $oGCP['web']['panel']." ".$oGCP['web']['version'];

?>
