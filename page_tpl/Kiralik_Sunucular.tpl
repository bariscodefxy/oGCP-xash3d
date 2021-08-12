<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Kiralık Server Listesi</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead><tr>
<th style="text-align:center">Adres</th>
<th style="text-align:center">Max. Oyuncu</th>
<th style="text-align:center">Paket</th>
<th style="text-align:center">Fiyat</th>
<th style="text-align:center">İşlem</th>
</tr></thead>
<tbody>
<?php foreach($servers as $server): ?>
<?php if($server["UserCount"] == '0'): ?>
<tr>
<td style="text-align:center"><b><a href="#"><?=$server["ServerIP"]?></b></a></td>
<td style="text-align:center"><b><?=$server["ServerMaxPlayers"]?></b></td>
<td style="text-align:center"><b><?=$server["ServerPacket"]?></b></td>
<td style="text-align:center"><b><font color="red"><?=$server["PacketFiyat"]?></font> TL</b></td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink('Kiralik_Sunucular','Islem=Kirala&ID='.$server["ServerID"])?>" onclick="return confirm('<?=$server["ServerIP"]?> IP adresli Serveri Satın Almak İstediğinize Eminmisiniz? Not: Bu İşlemin Geri Dönüşü Yoktur!')"><button class="btn btn-mini btn-danger">Satın Al!</button></a></td>
</tr>
<?php endif; ?>
<?php endforeach; ?>
<tr>
<td style="text-align:center" colspan=5>Sayfa Boş ise Kiralik IP yok demektir :)</td>
</tr>
</table>
</div></div></div>