<?php

$ssh2 = new ogcp_ssh2();
if($ssh2->ConnectwAuth($serverinfo["MachIP"],(int)$serverinfo["MachPort"],$serverinfo["MachUser"],$serverinfo["MachPass"])) {
	$filelink = $ssh2->SFTP_FileLink($serverinfo["ServerPath"].'/cstrike/server.cfg');
} else { 
	$filelink = "server.cfg"; 
}

class oServerDetails {
    var $degisken;
    var $degiskennormal;
    var $yereldosya;
    public $icerik;

	function degiskenbul($satirbasi,$kackarakter,$dosya) {
		$this->icerik = '';
		$ac = @fopen ($dosya, 'r+') or die ("Dosya açılamadı Hata Kodu : hepoyuncu-237wds");
		while (!feof($ac)) {
			$satir = @fgets ($ac); 
			if (substr($satir,0,$kackarakter) == $satirbasi)
			{
				$degisken = explode($satirbasi , $satir);
				$degisken = $degisken[1];
				$degisken = trim($degisken);
        		if (substr($degisken,0,1) == '"') 
				{ 
					$degisken = explode('"',$degisken);
					$degisken = $degisken[1];
					$degisken = str_replace('"','',$degisken);
				}
				$this->degisken= $degisken; 
				$this->degiskennormal = $satirbasi.' "'.$degisken.'"';
				$satir = $this->degiskennormal;                              
			}        
			$this->icerik .= $satir;
		} 
		@fclose ($ac);
	}
}

$oServerDetails = new oServerDetails;
$oGCP['server.cfg']['dosya'] = $filelink;

$oServerDetails->degiskenbul("hostname","8",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['hostname'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("rcon_password","13",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['rcon_password'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("sv_contact","10",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['sv_contact'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_timelimit","12",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_timelimit'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_roundtime","12",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_roundtime'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_freezetime","13",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_freezetime'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_startmoney","13",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_startmoney'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_buytime","10",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_buytime'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_c4timer","10",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_c4timer'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_autoteambalance","18",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_autoteambalance'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_limitteams","13",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_limitteams'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("sv_voiceenable","14",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['sv_voiceenable'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("sv_voicequality","16",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['sv_voicequality'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("sv_voicecodec","13",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['sv_voicecodec'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("allow_spectators","16",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['allow_spectators'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("sv_alltalk","10",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['sv_alltalk'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_footsteps","12",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_footsteps'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_flashlight","13",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_flashlight'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_friendlyfire","15",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_friendlyfire'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_autokick","11",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_autokick'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_tkpunish","10",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_tkpunish'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_forcecamera","14",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_forcecamera'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("mp_playerid","11",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['mp_playerid'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("decalfrequency","14",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['decalfrequency'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("__sxei_required","15",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['__sxei_required'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("__sxei_16bpp","12",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['__sxei_16bpp'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("__sxei_antiwall","15",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['__sxei_antiwall'] = $oServerDetails->degisken;

$oServerDetails->degiskenbul("__sxei_antispeed","16",$oGCP['server.cfg']['dosya']);
$oGCP['server.cfg']['__sxei_antispeed'] = $oServerDetails->degisken;

switch(@$_GET["Durum"]) {
	case "Duzenlendi": {
		print('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarılı!</strong> Yapmış olduğunuz değişiklikler kaydedilmiştir!!</div>');
		break;
	}
	case "Duzenlenemedi": {
		print('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarısız!</strong> Yapmış olduğunuz değişiklikler bir hata sonucu kaydedilemedi!!</div>');
		break;
	}
}

if(isset($_POST["yardir"]) && file_exists($oGCP['server.cfg']['dosya'])) {
	$oGCP['dosya']['icerik'] = $oServerDetails->icerik;
	$oGCP['dosya']['icerik'] = str_replace('hostname "'.$oGCP['server.cfg']['hostname'].'"','hostname "'.$_POST["hostname"].'"',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('rcon_password "'.$oGCP['server.cfg']['rcon_password'].'"','rcon_password "'.$_POST["rcon_password"].'"',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_contact "'.$oGCP['server.cfg']['sv_contact'].'"','sv_contact "'.$_POST["sv_contact"].'"',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_timelimit '.$oGCP['server.cfg']['mp_timelimit'].'','mp_timelimit '.$_POST["mp_timelimit"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_roundtime '.$oGCP['server.cfg']['mp_roundtime'].'','mp_roundtime '.$_POST["mp_roundtime"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_freezetime '.$oGCP['server.cfg']['mp_freezetime'].'','mp_freezetime '.$_POST["mp_freezetime"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_startmoney '.$oGCP['server.cfg']['mp_startmoney'].'','mp_startmoney '.$_POST["mp_startmoney"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_buytime '.$oGCP['server.cfg']['mp_buytime'].'','mp_buytime '.$_POST["mp_buytime"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_c4timer '.$oGCP['server.cfg']['mp_c4timer'].'','mp_c4timer '.$_POST["mp_c4timer"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_autoteambalance '.$oGCP['server.cfg']['mp_autoteambalance'].'','mp_autoteambalance '.$_POST["mp_autoteambalance"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_limitteams '.$oGCP['server.cfg']['mp_limitteams'].'','mp_limitteams '.$_POST["mp_limitteams"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_voiceenable '.$oGCP['server.cfg']['sv_voiceenable'].'','sv_voiceenable '.$_POST["sv_voiceenable"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_voicequality '.$oGCP['server.cfg']['sv_voicequality'].'','sv_voicequality '.$_POST["sv_voicequality"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_voicecodec '.$oGCP['server.cfg']['sv_voicecodec'].'','sv_voicecodec '.$_POST["sv_voicecodec"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_alltalk '.$oGCP['server.cfg']['sv_alltalk'].'','sv_alltalk '.$_POST["sv_alltalk"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_footsteps '.$oGCP['server.cfg']['mp_footsteps'].'','mp_footsteps '.$_POST["mp_footsteps"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_flashlight '.$oGCP['server.cfg']['mp_flashlight'].'','mp_flashlight '.$_POST["mp_flashlight"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_friendlyfire '.$oGCP['server.cfg']['mp_friendlyfire'].'','mp_friendlyfire '.$_POST["mp_friendlyfire"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_autokick '.$oGCP['server.cfg']['mp_autokick'].'','mp_autokick '.$_POST["mp_autokick"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_voicecodec '.$oGCP['server.cfg']['sv_voicecodec'].'','sv_voicecodec '.$_POST["sv_voicecodec"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('sv_alltalk '.$oGCP['server.cfg']['sv_alltalk'].'','sv_alltalk '.$_POST["sv_alltalk"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_footsteps '.$oGCP['server.cfg']['mp_footsteps'].'','mp_footsteps '.$_POST["mp_footsteps"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_flashlight '.$oGCP['server.cfg']['mp_flashlight'].'','mp_flashlight '.$_POST["mp_flashlight"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_friendlyfire '.$oGCP['server.cfg']['mp_friendlyfire'].'','mp_friendlyfire '.$_POST["mp_friendlyfire"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_autokick '.$oGCP['server.cfg']['mp_autokick'].'','mp_autokick '.$_POST["mp_autokick"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_tkpunish '.$oGCP['server.cfg']['mp_tkpunish'].'','mp_tkpunish '.$_POST["mp_tkpunish"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_forcecamera '.$oGCP['server.cfg']['mp_forcecamera'].'','mp_forcecamera '.$_POST["mp_forcecamera"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('mp_playerid '.$oGCP['server.cfg']['mp_playerid'].'','mp_playerid '.$_POST["mp_playerid"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('__sxei_required '.$oGCP['server.cfg']['__sxei_required'].'','__sxei_required '.$_POST["__sxei_required"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('__sxei_16bpp '.$oGCP['server.cfg']['__sxei_16bpp'].'','__sxei_16bpp '.$_POST["__sxei_16bpp"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('__sxei_antiwall '.$oGCP['server.cfg']['__sxei_antiwall'].'','__sxei_antiwall '.$_POST["__sxei_antiwall"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('__sxei_antispeed '.$oGCP['server.cfg']['__sxei_antispeed'].'','__sxei_antispeed '.$_POST["__sxei_antispeed"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('allow_spectators '.$oGCP['server.cfg']['allow_spectators'].'','allow_spectators '.$_POST["allow_spectators"].'',$oGCP['dosya']['icerik']);
	$oGCP['dosya']['icerik'] = str_replace('decalfrequency '.$oGCP['server.cfg']['decalfrequency'].'','decalfrequency '.$_POST["decalfrequency"].'',$oGCP['dosya']['icerik']);
	$ssh2->SFTP_DownloadFile($serverinfo["ServerPath"].'/cstrike/server.cfg',"cfgdosyalari/".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_".(int)$_SESSION["OGCP_UserID"]."_server.cfg");
	$dosya = "cfgdosyalari/".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_".(int)$_SESSION["OGCP_UserID"]."_server.cfg";
	$dt = fopen($dosya, 'w');
	fwrite($dt, $oGCP['dosya']['icerik']);
	fclose($dt);
	if( $ssh2->SFTP_UploadFile("cfgdosyalari/".$serverinfo["ServerIP"]."_".$serverinfo["ServerPort"]."_".(int)$_SESSION["OGCP_UserID"]."_server.cfg",$serverinfo["ServerPath"].'/cstrike/server.cfg') ) {
		$ssh2->Exec("screen -S {$serverinfo['Screen']} -X -p0 eval \"stuff 'exec server.cfg'^m\"");
		$page->GoLocation($page->CreatePageLink($cur_page,"Durum=Duzenlendi"));
	} else {
		$page->GoLocation($page->CreatePageLink($cur_page,"Durum=Duzenlenemedi"));
		
	}
}

?>