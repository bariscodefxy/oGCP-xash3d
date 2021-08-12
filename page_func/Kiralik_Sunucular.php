<?php
error_reporting(0);
@session_start();
date_default_timezone_set('Europe/Istanbul');
$veritabani = array( 
    'host'         => $oGCP['veritabani']['host'], 
    'kullanici'    => $oGCP['veritabani']['kadi'],      
    'sifre'        => $oGCP['veritabani']['sifre'],      
    'veritabani'   => $oGCP['veritabani']['vtadi']);      

$bakbakim = mysql_connect($veritabani['host'],$veritabani['kullanici'],$veritabani['sifre']);
if (!$bakbakim) {echo "MySQL Bağlantı Hatası!";die();}
$vt_baglan = mysql_select_db($veritabani['veritabani'],$bakbakim);
if (!$vt_baglan) {echo "Veritabana Bağlanılamadı!";;die();}	

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");

	$servers = CounterMerkezi_KiralikIP();
	if(@$_GET["Islem"] == "Kirala" && (int)@$_GET["ID"] != 0 && isset($servers[(int)@$_GET["ID"]]) ) {
		
	
	
	
	
################################################################	
	
	
	
	$cekkardas ="SELECT * FROM ogcp_servers where ServerID = '".$_GET['ID']."'";
        $result = mysql_query($cekkardas);
        while ( $row = mysql_fetch_assoc($result)) {
		$paketcek   = $row ['ServerPacket'];
		}
		
		$query2 ="SELECT * FROM ogcp_packets where PacketID = '".$paketcek."'";
        $result2 = mysql_query($query2);
        while ( $row2 = mysql_fetch_assoc($result2)) {
        $fiyatisoyle    = $row2 ['PacketFiyat'];
        $paketisim      = $row2 ['PacketName'];		
			
		
		}
		 $serverkontrol = mysql_query("SELECT * FROM ogcp_userservers WHERE ServerID='" . $_GET['ID'] . "'");
 if ($dev = mysql_fetch_array($serverkontrol)){
     
     echo '<div class="alert alert-danger"><div>
	 <b>Bu Server Kiralık Değildir!</div></div><meta http-equiv="refresh" content="3;URL='.$kiralik_link.'">';
    die();
 }
        
		$gelenveri = $fiyatisoyle;
        $bakiye    = $userinf["bakiye"];
			
			
            $varmifiyat = $fiyatisoyle;

            if($varmifiyat>$bakiye){

                echo '<div class="alert alert-danger"><div>
<b>Hesabınızda Yeterli Bakiye YOK! Gereken Bakiye: <font color="red">'.$varmifiyat.'</font> TL</b></div></div>
<meta http-equiv="refresh" content="3;URL='.$kiralik_link.'">';

            }

            else{

// Çıkarma İşlemi
                $sayi1  = $bakiye;
                $sayi2  = $varmifiyat;
                $kalan  = $sayi1 - $sayi2;

// Tarih uzat +1 ay
               // Tarih uzat +1 ay
                date_default_timezone_set('Europe/Istanbul');
				$tarihsoyle = date('d-m-Y');
                $time = strtotime($tarihsoyle);
                $final = date("d-m-Y", strtotime("+31 day", $time));
				
				$sure = DateTime::createFromFormat('d-m-Y',$final);
			    $serversuresi2 = $sure->getTimestamp();

                echo '<center><div class="alert alert-success"><div>
<b>Tebrikler! Hesabınızdan <font color="red">'.$varmifiyat.'</font> TL Çekilerek Serverini Satın Aldınız.</br>
Hesabınızda Kalan Bakiye : <font color="red">'.$kalan.'</font> TL</br>
Serverinizin Bir sonradaki ödeme tarihi : <font color="red">'.$final.'</font></br>Sayfaya Yönlendiriliyorsunuz..</b> </div></div></div></center><meta http-equiv="refresh" content="4;URL='.$sunucularim_link.'">';
                $alti = "6";
				$bir = "1";
                $bakiyedus = mysql_query("UPDATE  `ogcp_users` SET `bakiye` = '".$kalan."' WHERE UserID = '".$_SESSION["OGCP_UserID"]."'  LIMIT 100;") or die(mysql_error());

			    $serveri_al = mysql_query("INSERT INTO `ogcp_userservers` (`UserID`, `ServerID`, `UserServerStatus`, `ServerFTPCon`, `ServerPluginCon`, `UserServerPrice`, `UserServerPriceTime`, `UserServerBank`) VALUES ('".(int)$_SESSION["OGCP_UserID"]."','".(int)$_GET['ID']."','".(int)$bir."', '".(int)$bir."', '".(int)$bir."', '".(int)$varmifiyat."', '".(int)$serversuresi2."','".(int)$alti."')") or die(mysql_error());
			
			
      die();          		
	}
        		
			
			
			
		}
	


?>