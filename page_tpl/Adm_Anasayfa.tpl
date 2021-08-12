<div class="row-fluid"><div class="widget widget-padding span6"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sistem Istatistikleri</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<tbody>
<tr><td style="text-align:left;width:30%;">Kullanıcı Sayısı</td><td><?=@$stats["KullaniciSayisi"]?></td></tr>
<tr><td style="text-align:left;width:30%;">Eklenti Sayısı</td><td><?=@$stats["PluginSayisi"]?></td></tr>
<tr><td style="text-align:left;width:30%;">Paket Sayısı</td><td><?=@$stats["PaketSayisi"]?></td></tr>
<tr><td style="text-align:left;width:30%;">Duyuru Sayısı</td><td><?=@$stats["DuyuruSayisi"]?></td></tr>
<tr><td style="text-align:left;width:30%;">Bildirim Sayısı</td><td><?=@$stats["TicketSayisi"]?></td></tr>
<tr><td style="text-align:left;width:30%;">Ayar Dosya Sayısı</td><td><?=@$stats["AyarSayisi"]?></td></tr>
</tbody>
</table>
</div></div>
<div class="widget widget-padding span6"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucu Istatistikleri</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<tbody>
<tr><td style="text-align:left;width:40%;">Makine Sayısı</td><td><?=@$stats["MakineSayisi"]?></td></tr>
<tr><td style="text-align:left;width:40%;">Sunucu Sayısı</td><td><?=@$stats["ServerSayisi"]?></td></tr>
<tr><td style="text-align:left;width:40%;">Satılmış Sunucu Sayısı</td><td><?=@$sunucudurum["ServerSayisi"]?></td></tr>
<tr><td style="text-align:left;width:40%;">Satılmamış Sunucu Sayısı</td><td><?=@$stats["ServerSayisi"] - @$sunucudurum["ServerSayisi"]?></td></tr>
<tr><td style="text-align:left;width:40%;">Max. Slot</td><td><?=$maxslot?></td></tr>
<tr><td style="text-align:left;width:40%;">Ödenen Miktar</td><td><?=(int)@$sunucudurum["ToplamPara"]." TL"?></td></tr>
</tbody>
</table>
</div></div>
</div>

<?php if($userinf["UserGroup"] > 2): ?>
<div class="row-fluid">
<div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucu Islemleri</h5></div>  
<div class="widget-body">
<table class="table table-striped">
<tr>
<td><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS">Sunucuları Durdur</span></td>
<td><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sunuculari_Durdur')?>"><button class="btn btn-small btn-inverse">Uygula!</button></a></td>
</tr>
<tr>
<td><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS">Sunucuları Çalıştır</span></td>
<td><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sunuculari_Calistir')?>"><button class="btn btn-small btn-inverse">Uygula!</button></a></td>
</tr>
<tr>
<td><span style="font-size: 13px;font-weight: bold;font-family: Trebuchet MS">Sunucuları Yeniden Başlat</span></td>
<td><a href="<?=$page->CreatePageLink($cur_page,'Islem=Sunuculari_YenidenBaslat')?>"><button class="btn btn-small btn-inverse">Uygula!</button></a></td>
</tr>
</table>
</div></div>
</div>
<?php endif; ?>