<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucu Durumu</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>
<div class="widget-body">
<table class="table table-striped">
<div align="center" style="border: 1px dashed #000;height: 50px;line-height: 50px;color: #000;font-size: 16px">Bildirimler Yanıtlanmıştır, Saygılarımızla..</div>
<tr>
<td>IP Adresi & Port:</td>
<td><b><?=@$info["ip"]?></b></td>
</tr>
<tr>
<td>Sunucu Adı:</td>
<td><b><?=@$info["hostname"]?></b></td>
</tr>
<tr>
<td>Oynanan Harita:</td>
<td><b><?=@$info["map"]?></b></td>
</tr>
<tr>
<td>Haritada Kalan Süre:</td>
<td><b><?=@$rules["amx_timeleft"]?></b></td>
</tr>
<tr>
<td>Harita Süresi:</td>
<td><b><?=@$rules["mp_timelimit"] == 0 ? "Sınırsız" : @$rules["mp_timelimit"]." Dakika"?></b></td>
</tr>
<td>Tur Süresi:</td>
<td><b><?=@$rules["mp_roundtime"]?></b></td>
</tr>
    <!--
<tr>
<td>sXe Durumu:</td>
<td><b><?=@$rules["__sxei_required"]?></b></td>
</tr> -->
<tr>
<td>Oyuncular:</td>
<td><b><span style='color:red'><?=(@$info["players"] == "" ? 0 : $info["players"])."</span> / ".(@$info["mplayers"] == "" ? 0 : $info["mplayers"])?></b></td>
</tr>
</table>
</div></div></div>

<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucu Izinleri</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>
<div class="widget-body">
<table class="table table-striped">
<tr>
<td>Eklenti Yönetimi:</td>
<td><?=$plugincon?></td>
</tr>
<tr>
<td>Web FTP:</td>
<td><?=$ftpcon?></td>
</tr>
</table>
</div></div></div>

<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucu Sifresi (sv_password)</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>
<div class="widget-body">
<table class="table table-striped">

<tr>
<td>Sunucu Şifresi:</td>
<td><b><?=@$info["password"] != "" ? "Şifre Var! [Şifre: ".$info["password"] ."] "."<a href=".$page->CreatePageLink($cur_page,'Process=Remove_Pass').">" : "Şifre Yok!" ?></b></td>
</tr>
<form method="POST" >
<tr>
<td style="padding-top: 3%">Şifre Oluştur:</td>
<td style="padding-top: 2%"><input class="span7" type="text" placeholder="Şifre Giriniz…">&nbsp;&nbsp;<button class="btn">Gönder</button></td>
</tr>
</form>
</table>
</div></div></div>

<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Oyuncular</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>
<div class="widget-body">
<table class="table table-striped">
<thead>
<tr><th style="text-align:center">Nick</th>
<th style="text-align:center">Skor</th>
<th style="text-align:center">Süre</th>
<th style="text-align:center">İşlem</th></tr>
</thead>
<tbody>
<?php if(@$info["players"] != 0): foreach($players as $a_player): ?>
<tr>
<td style="text-align:center"><?=str_replace('l ','',$a_player["name"])?></td>
<td style="text-align:center"><?=$a_player["frag"]?></td>
<td style="text-align:center"><?=str_replace('l ','',$a_player["time"])?></td>
<td style="text-align:center"><form method="POST" action="<?=$page->CreatePageLink($cur_page)?>"><input type="hidden" name="username" value="<?=$a_player["name"]?>">
<input type="hidden" name="address" value="<?=$a_player["adress"]?>">
<button class="btn btn-warning" name="kick">Kick</button>
<button class="btn btn-danger" name="ban">Ban</button>
<!--<button class="btn btn-inverse" name="ban_sxe">sXe ID Ban</button>--></form></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="6" style="text-align:center;"><b>Sunucuda oyuncu bulunmuyor...</b></td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>
