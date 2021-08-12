<?php
/* oGCP - Oynucaz Game Control Panel
   Version: 1.0
   Dosya: "baglan.php"
   Yapımcı: Oynucaz Dev Team */

require_once("ayarlar.php");
try { 
	$baglan = new PDO("mysql:host=".$oGCP['veritabani']['host'].";dbname=".$oGCP['veritabani']['vtadi']."",$oGCP['veritabani']['kadi'],$oGCP['veritabani']['sifre']); 
	$baglan->query("SET NAMES 'utf8'"); 
	$baglan->query("SET CHARACTER SET utf8"); 
	$baglan->query("SET COLLATION_CONNECTION = 'utf8_bin'");
}
catch(PDOException $e) { echo $e->getMessage(); exit; }
?>