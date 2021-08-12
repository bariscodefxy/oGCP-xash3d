<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Kullanıcının Sunucusunu Düzenle - #<?=$userserver[0]?></h5></div>
<form action="<?=$page->CreatePageLink($cur_page,'ID='.(int)@$_GET["ID"]);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Kullanıcı Adı:</label>
<div class="controls"><?=$userserver["UserName"]?></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Seç:</label>
<div class="controls"><select name="sunucu_sec" style="width:206px">	
	<?php if($servers != false): foreach($servers as $server): ?>
	<option value="<?=$server["ServerID"]?>"<?=$userserver["ServerID"] == $server["ServerID"] ? " selected" : ""?>><?=$server["ServerIP"].":".$server["ServerPort"]?></option>
	<?php endforeach; else:?>
	<option value="0">---</option>
	<?php endif; ?></select></div>
</div>

<div class="control-group">
<label class="control-label">Sunucu Durumu:</label>
<div class="controls"><select name="server_status" style="width:206px">
<option value="1"<?=$userserver["UserServerStatus"] == 0 ? " selected" : ""?>>Aktif</option>
<option value="0"<?=$userserver["UserServerStatus"] == 0 ? " selected" : ""?>>Pasif</option></select></div>
</div>
<div class="control-group">
<label class="control-label">Eklenti Kontrolü:</label>
<div class="controls"><select name="plugin_cont" style="width:206px">
<option value="1"<?=$userserver["ServerPluginCon"] == 0 ? " selected" : ""?>>Aktif</option>
<option value="0"<?=$userserver["ServerPluginCon"] == 0 ? " selected" : ""?>>Pasif</option></select></div>
</div>
<div class="control-group">
<label class="control-label">FTP Kontrolü:</label>
<div class="controls"><select name="ftp_cont" style="width:206px">
<option value="1"<?=$userserver["ServerFTPCon"] == 0 ? " selected" : ""?>>Aktif</option>
<option value="0"<?=$userserver["ServerFTPCon"] == 0 ? " selected" : ""?>>Pasif</option></select></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Ücreti:</label>
<div class="controls"><input type="text" value="<?=$userserver["UserServerPrice"]?>" name="server_price" placeholder="Örnek: 60 (TL'ye gerek yok!)"/></div>
</div>
<div class="control-group">
<label class="control-label">Bitiş Süresi:</label>
<div class="controls"><input type="text" value="<?=date('d-m-Y',$userserver["UserServerPriceTime"])?>" name="server_time" placeholder="Örnek: GG-AA-YYYY"/></div>
</div>
<div class="control-group">
<label class="control-label">Ödeme Türü:</label>
<div class="controls">
	<select name="bank_type" style="width:206px">
		<option value="0"<?=$userserver["UserServerBank"] == 0 ? " selected" : ""?>><?=$bankalar[0]?></option>
		<option value="1"<?=$userserver["UserServerBank"] == 1 ? " selected" : ""?>><?=$bankalar[1]?></option>
		<option value="2"<?=$userserver["UserServerBank"] == 2 ? " selected" : ""?>><?=$bankalar[2]?></option>
		<option value="3"<?=$userserver["UserServerBank"] == 3 ? " selected" : ""?>><?=$bankalar[3]?></option>
		<option value="4"<?=$userserver["UserServerBank"] == 4 ? " selected" : ""?>><?=$bankalar[4]?></option>
		<option value="5"<?=$userserver["UserServerBank"] == 5 ? " selected" : ""?>><?=$bankalar[5]?></option>
	</select>
</div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_edituserserver">Kaydet</button>
</div>
</form>
</div>
</div></div>