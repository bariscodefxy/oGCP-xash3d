	<script type="text/javascript" src="http://panel.hepoyuncu.com/theme/js/ajax.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_group").change(function() {
		if( document.getElementById('user_group').value == "2" ) {
			$("#personel_yetki").show(500);
		} else {
			$("#personel_yetki").hide(500);
		}
		if( document.getElementById('user_group').value > 1) {
			$("#unvan").show(500);
		} else {
			$("#unvan").hide(500);
		}
	});
	
	if( document.getElementById('user_group').value == "2") {
		$("#personel_yetki").show(500);
	}
	if( document.getElementById('user_group').value > 1) {
		$("#unvan").show(500);
	}
});
</script>
<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 100%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Kullanıcı Düzenle - [#<?=$user["UserID"]?>]</h5></div>
<form action="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"]);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Adı Soyadı:</label>
<div class="controls"><input type="text" value="<?=$user["UserName"]?>" name="user_name"></div>
</div>
<div class="control-group">
<label class="control-label">Kullanıcı Adı:</label>
<div class="controls"><input type="text" value="<?=$user["UserEmail"]?>" name="user_email"></div>
</div>
<div class="control-group">
<label class="control-label">E-posta Adresi:</label>
<div class="controls"><input type="text" value="<?=$user["UserEmail2"]?>" name="user_email2"></div>
</div>
<div class="control-group">
<label class="control-label">Kullanıcı Şifre:</label>
<div class="controls"><input type="text" name="user_password" placeholder="Boş bırakıldığında değiştirilmez."></div>
</div>
<div class="control-group">
<label class="control-label">Bakiye *(sadece rakam):</label>
<div class="controls"><input type="text" value="<?=$user["bakiye"]?>" name="bakiye"></div>
</div>
<div class="control-group">
<label class="control-label">Şehir:</label>
<div class="controls"><input type="text" value="<?=$user["UserCity"]?>" name="user_city"></div>
</div>
<div class="control-group">
<label class="control-label">Adres:</label>
<div class="controls"><input type="text" value="<?=$user["UserAddress"]?>" name="user_address"></div>
</div>
<div class="control-group">
<label class="control-label">Telefon:</label>
<div class="controls"><input type="text" value="<?=$user["UserTelephone"]?>" name="user_telephone"></div>
</div>
<div class="control-group">
<label class="control-label">Not:</label>
<div class="controls"><input type="text" value="<?=$user["UserComment"]?>" name="user_comment"></div>
</div>
<div class="control-group">
<label class="control-label">Üye Grubu:</label>
<div class="controls">
<select id="user_group" name="user_group" style="width:206px;">
	<?php if($userinf["UserGroup"] > 2): ?>
	<option value="0"<?=$user["UserGroup"] == 0 ? " selected" : ""?>>Yasaklı</option>
	<?php endif; ?>
	<option value="1"<?=$user["UserGroup"] == 1 ? " selected" : ""?>>Müşteri</option>
	<?php if($userinf["UserGroup"] > 2): ?>
	<option value="2"<?=$user["UserGroup"] == 2 ? " selected" : ""?>>Personel</option>
	<option value="3"<?=$user["UserGroup"] == 3 ? " selected" : ""?>>Yönetici</option>
	<?php endif; ?>
</select>
</div>
</div>
<div id="unvan" style="display:none;">
<div class="control-group">
<label class="control-label">Ünvan:</label>
<div class="controls"><input type="text" value='<?=addslashes($user["UserPrefix"])?>' name="user_prefix"></div>
</div></div>
<div id="personel_yetki" style="display:none;">
<div class="control-group">
<label class="control-label">Makineleri görebilir:</label>
<div class="controls">
<select id="ShowMachine" name="ShowMachine" style="width:206px;">
	<option value="0"<?=$user["ShowMachine"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowMachine"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Sunucuları görebilir:</label>
<div class="controls">
<select id="ShowServers" name="ShowServers" style="width:206px;">
	<option value="0"<?=$user["ShowServers"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowServers"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Kullanıcıları görebilir:</label>
<div class="controls">
<select id="ShowUsers" name="ShowUsers" style="width:206px;">
	<option value="0"<?=$user["ShowUsers"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowUsers"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Duyuruları görebilir:</label>
<div class="controls">
<select id="ShowAnnouncements" name="ShowAnnouncements" style="width:206px;">
	<option value="0"<?=$user["ShowAnnouncements"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowAnnouncements"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Bildirimleri görebilir:</label>
<div class="controls">
<select id="ShowTickets" name="ShowTickets" style="width:206px;">
	<option value="0"<?=$user["ShowTickets"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowTickets"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Eklentileri görebilir:</label>
<div class="controls">
<select id="ShowPlugins" name="ShowPlugins" style="width:206px;">
	<option value="0"<?=$user["ShowPlugins"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowPlugins"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Ayar Dosyalarını görebilir:</label>
<div class="controls">
<select id="ShowFiles" name="ShowFiles" style="width:206px;">
	<option value="0"<?=$user["ShowFiles"] == 0 ? " selected" : ""?>>Hayır</option>
	<option value="1"<?=$user["ShowFiles"] == 1 ? " selected" : ""?>>Evet</option>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_edituser">Kaydet</button>
</div>
</form>
</div>
</div>
</div>
<?php if($user["UserGroup"] < 2 && $user["UserGroup"] != 0): ?>
<br />
<hr style="border: 1px solid #ccc;">
<br />
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5 style="font-family:'Open Sans',sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp; Kullanıcının Sunucuları</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead>
<tr><th colspan="10" style="text-align:center"><a href="<?=$page->CreatePageLink('Adm_Kullanici_Sunucu_Ekle','ID='.(int)@$_GET["ID"])?>">Sunucu Ekle</a></th></tr>
<tr><th style="text-align:center">Sunucu IP</th>
<th style="text-align:center">Harita</th>
<th style="text-align:center">Max. Player</th>
<th style="text-align:center">Paket</th>
<th style="text-align:center">Eklenti Yönetimi</th>
<th style="text-align:center">Web FTP</th>
<th style="text-align:center">Kalan Süre</th>
<th style="text-align:center">Banka</th>
<th style="text-align:center">Ücret</th>
<th style="text-align:center">Kaldır</th>
</tr>
</thead>
<tbody>
<?php if(@$servers != false || @$servers != ""): foreach($servers as $server): ?>
<tr>
<td style="text-align:center"><b><a href="<?=$page->CreatePageLink('Adm_Kullanici_Sunucu_Duzenle','ID='.$server["UserServerID"])?>"><?=$server["ServerIP"].":".$server["ServerPort"]?></a></b></td>
<td style="text-align:center"><?=$server["ServerMap"]?></td>
<td style="text-align:center"><?=$server["ServerMaxPlayers"]?></td>
<td style="text-align:center"><?=$server["ServerPacket"]?></td>
<td style="text-align:center"><?=$server["ServerPluginCon"] ? "Açık" : "Kapalı"?></td>
<td style="text-align:center"><?=$server["ServerFTPCon"] ? "Açık" : "Kapalı" ?></td>
<td style="text-align:center"><?=serverkalanzaman(time(),$server["UserServerPriceTime"])?></td>
<td style="text-align:center"><?=$bankalar[$server["UserServerBank"]]?></td>
<td style="text-align:center"><?=$server["UserServerPrice"]." TL"?></td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"].'&Islem=SunucuSil&SID='.$server["UserServerID"])?>"><button class="btn btn-mini btn-danger">Kaldır</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="10" style="text-align:center;"><b>Kullanıcının yetkili olduğu sunucu bulunmamaktadır..</b></td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>
<?php endif; ?>
