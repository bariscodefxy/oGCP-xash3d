<div align="center">
<div class="row-fluid" style="width: 100%">
<div style="width: 75%">
<div class="widget-header"><i class="icon-list-alt"></i><h5>Sunucu Düzenle - [ID #<?=$server["ServerID"]?>]</h5></div>
<form action="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"]);?>" method="POST" id="register_form1" class="form-horizontal" novalidate="novalidate">
<div class="widget-body">
<div class="widget-forms clearfix"><br/>
<div class="control-group">
<label class="control-label">Sunucu IP:</label>
<div class="controls"><input type="text" value="<?=$server["ServerIP"]?>" name="server_ip"></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Port:</label>
<div class="controls"><input type="text" value="<?=$server["ServerPort"]?>" name="server_port"></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Makinesi:</label>
<div class="controls">
	<select name="server_mach" style="width:206px;">
	<?php if($machines != false): foreach($machines as $machine): ?>
	<option value="<?=$machine["MachID"]?>"<?=$server["ServerMachID"] == $machine["MachID"] ? " selected" : "" ?>><?=$machine["MachIP"].":".$machine["MachPort"]?></option>
	<?php endforeach; else:?>
	<option value="0">---</option>
	<?php endif; ?>
	</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Paketi:</label>
<div class="controls">	
	<select name="server_packet" style="width:206px;">
	<?php if($packets != false): foreach($packets as $packet): ?>
	<option value="<?=$packet["PacketID"]?>"<?=$server["ServerPacket"] == $packet["PacketID"] ? " selected" : "" ?>><?=$packet["PacketName"]?></option>
	<?php endforeach; else:?>
	<option value="0">---</option>
	<?php endif; ?>
	</select></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Map:</label>
<div class="controls"><input type="text" name="server_map" value="<?=$server["ServerMap"]?>"></div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Max.Slot:</label>
<div class="controls">
	<select name="server_maxslot" style="width:206px;">
		<option value="10"<?=(int)$server["ServerMaxPlayers"] == 10 ? " selected" : "" ?>>10 Oyuncu</option>
		<option value="11"<?=(int)$server["ServerMaxPlayers"] == 11 ? " selected" : "" ?>>11 Oyuncu</option>
		<option value="12"<?=(int)$server["ServerMaxPlayers"] == 12 ? " selected" : "" ?>>12 Oyuncu</option>
		<option value="13"<?=(int)$server["ServerMaxPlayers"] == 13 ? " selected" : "" ?>>13 Oyuncu</option>
		<option value="14"<?=(int)$server["ServerMaxPlayers"] == 14 ? " selected" : "" ?>>14 Oyuncu</option>
		<option value="15"<?=(int)$server["ServerMaxPlayers"] == 15 ? " selected" : "" ?>>15 Oyuncu</option>
		<option value="16"<?=(int)$server["ServerMaxPlayers"] == 16 ? " selected" : "" ?>>16 Oyuncu</option>
		<option value="17"<?=(int)$server["ServerMaxPlayers"] == 17 ? " selected" : "" ?>>17 Oyuncu</option>
		<option value="18"<?=(int)$server["ServerMaxPlayers"] == 18 ? " selected" : "" ?>>18 Oyuncu</option>
		<option value="19"<?=(int)$server["ServerMaxPlayers"] == 19 ? " selected" : "" ?>>19 Oyuncu</option>
		<option value="20"<?=(int)$server["ServerMaxPlayers"] == 20 ? " selected" : "" ?>>20 Oyuncu</option>
		<option value="21"<?=(int)$server["ServerMaxPlayers"] == 21 ? " selected" : "" ?>>21 Oyuncu</option>
		<option value="22"<?=(int)$server["ServerMaxPlayers"] == 22 ? " selected" : "" ?>>22 Oyuncu</option>
		<option value="23"<?=(int)$server["ServerMaxPlayers"] == 23 ? " selected" : "" ?>>23 Oyuncu</option>
		<option value="24"<?=(int)$server["ServerMaxPlayers"] == 24 ? " selected" : "" ?>>24 Oyuncu</option>
		<option value="25"<?=(int)$server["ServerMaxPlayers"] == 25 ? " selected" : "" ?>>25 Oyuncu</option>
		<option value="26"<?=(int)$server["ServerMaxPlayers"] == 26 ? " selected" : "" ?>>26 Oyuncu</option>
		<option value="27"<?=(int)$server["ServerMaxPlayers"] == 27 ? " selected" : "" ?>>27 Oyuncu</option>
		<option value="28"<?=(int)$server["ServerMaxPlayers"] == 28 ? " selected" : "" ?>>28 Oyuncu</option>
		<option value="29"<?=(int)$server["ServerMaxPlayers"] == 29 ? " selected" : "" ?>>29 Oyuncu</option>
		<option value="30"<?=(int)$server["ServerMaxPlayers"] == 30 ? " selected" : "" ?>>30 Oyuncu</option>
		<option value="31"<?=(int)$server["ServerMaxPlayers"] == 31 ? " selected" : "" ?>>31 Oyuncu</option>
		<option value="32"<?=(int)$server["ServerMaxPlayers"] == 32 ? " selected" : "" ?>>32 Oyuncu</option>
	</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Sunucu Dizini:</label>
<div class="controls"><input type="text" value="<?=$server["ServerPath"]?>" name="server_path"></div>
</div>
<div class="control-group">
<label class="control-label"></label>
<div class="controls">
	<a class="btn btn-small btn-inverse" href="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"].'&Islem=Sunucu_Calistir')?>">Çalıstır!</a>
	<a class="btn btn-small btn-inverse" href="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"].'&Islem=Sunucu_Durdur')?>">Durdur!</a>
	<a class="btn btn-small btn-inverse" href="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"].'&Islem=Sunucu_YenidenCalistir')?>">Yeniden Baslat!</a>
	<a class="btn btn-small btn-inverse" href="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"].'&Islem=Sunucu_Yonet')?>">Yönet!</a>
</div>
</div>
</div>
</div>
<div class="widget-footer">
<button type="submit" class="pull-right btn btn-info btn-small" name="ogcp_editserver">Ekle</button>
</div>
</form>
</div>
</div></div>
<br />
<hr style="border: 1px solid #ccc;">
<br />
<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5 style="font-family:'Open Sans',sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp; Sunucunun Kullanıcıları</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead>
<th style="text-align:center">Ad Soyad</th>
<th style="text-align:center">Kullanıcı Adı</th>
<th style="text-align:center">E-posta</th>
<th style="text-align:center">Ücret</th>
<th style="text-align:center">Banka</th>
<th style="text-align:center">Kalan Süre</th>
<th style="text-align:center">Kaldır</th>
</tr>
</thead>
<tbody>
<?php if(@$users != false || @$users != ""): foreach($users as $user): ?>
<tr>
<td style="text-align:center"><b><a href="<?=$page->CreatePageLink('Adm_Kullanici_Duzenle','ID='.$user["UserID"])?>"><?=$user["UserName"]?></a></b></td>
<td style="text-align:center"><?=$user["UserEmail"]?></td>
<td style="text-align:center"><?=$user["UserEmail2"]?></td>
<td style="text-align:center"><?=$user["UserServerPrice"]?></td>
<td style="text-align:center"><?=$bankalar[$user["UserServerBank"]]?></td>
<td style="text-align:center"><?=serverkalanzaman(time(),$user["UserServerPriceTime"])?></td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink($cur_page,'ID='.$_GET["ID"].'&Islem=SunucuSil&SID='.$user["UserServerID"])?>"><button class="btn btn-mini btn-danger">Kaldır</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="10" style="text-align:center;"><b>Sunucuda yetkili kullanıcı bulunmamaktadır..</b></td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>