<script type="text/javascript" src="http://panel.hepoyuncu.com/theme/js/ajax.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_group").change(function() {
		if( document.getElementById('user_group').value == "2" ) {
			$("#personel_yetki").show(500);
		} else {
			$("#personel_yetki").hide(500);
		}
	});
	
	if( document.getElementById('user_group').value == "2") {
		$("#personel_yetki").show(500);
	}
});
</script>
<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Yeni Kullanıcı Ekle</h5></div>
<form action="<?=$page->CreatePageLink($cur_page);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Adı Soyadı:</label>
<div class="controls"><input type="text" name="user_name"></div>
</div>
<div class="control-group">
<label class="control-label">Kullanıcı Adı:</label>
<div class="controls"><input type="text" name="user_email"></div>
</div>
<div class="control-group">
<label class="control-label">E-posta Adresi:</label>
<div class="controls"><input type="text" name="user_email2"></div>
</div>
<div class="control-group">
<label class="control-label">Kullanıcı Şifresi:</label>
<div class="controls"><input type="text" name="user_pass"></div>
</div>
<div class="control-group">
<label class="control-label">Bakiye *(sadece rakam):</label>
<div class="controls"><input type="text" name="bakiye"></div>
</div>
<div class="control-group">
<label class="control-label">Şehir:</label>
<div class="controls"><input type="text" name="user_city"></div>
</div>
<div class="control-group">
<label class="control-label">Adres:</label>
<div class="controls"><input type="text" name="user_address"></div>
</div>
<div class="control-group">
<label class="control-label">Telefon:</label>
<div class="controls"><input type="text" name="user_telephone"></div>
</div>
<div class="control-group">
<label class="control-label">Not:</label>
<div class="controls"><input type="text" name="user_comment"></div>
</div>
<div class="control-group">
<label class="control-label">Üye Grubu:</label>
<div class="controls">
<select id="user_group" name="user_group" style="width:206px;">
	<option value="1">Müşteri</option>
	<?php if($userinf["UserGroup"] > 2): ?>
	<option value="2">Personel</option>
	<option value="3">Yönetici</option>
	<?php endif; ?>
</select>
</div>
</div>
<div id="personel_yetki" style="display:none;">
<div class="control-group">
<label class="control-label">Makineleri görebilir:</label>
<div class="controls">
<select id="ShowMachine" name="ShowMachine" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Sunucuları görebilir:</label>
<div class="controls">
<select id="ShowServers" name="ShowServers" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Kullanıcıları görebilir:</label>
<div class="controls">
<select id="ShowUsers" name="ShowUsers" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Duyuruları görebilir:</label>
<div class="controls">
<select id="ShowAnnouncements" name="ShowAnnouncements" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Bildirimleri görebilir:</label>
<div class="controls">
<select id="ShowTickets" name="ShowTickets" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Eklentileri görebilir:</label>
<div class="controls">
<select id="ShowPlugins" name="ShowPlugins" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Ayar Dosyalarını görebilir:</label>
<div class="controls">
<select id="ShowFiles" name="ShowFiles" style="width:206px;">
	<option value="0">Hayır</option>
	<option value="1">Evet</option>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_adduser">Ekle</button>
</div>
</form>
</div>
</div></div>