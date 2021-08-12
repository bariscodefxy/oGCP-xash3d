<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucularım</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead>
<tr><th style="text-align:center">Sunucu IP</th>
<th style="text-align:center">Harita</th>
<th style="text-align:center">Max. Player</th>
<th style="text-align:center">Paket</th>
<th style="text-align:center">Eklenti Yönetimi</th>
<th style="text-align:center">Web FTP</th>
<th style="text-align:center">Kalan Süre</th>
<th style="text-align:center">#</th></tr>
</thead>
<tbody>
<?php if(@$servers != false || @$servers != ""): foreach($servers as $server): ?>
<tr>
<td style="text-align:center"><b><?=$server["ServerIP"].":".$server["ServerPort"]?></b></td>
<td style="text-align:center"><?=$server["ServerMap"]?></td>
<td style="text-align:center"><?=$server["ServerMaxPlayers"]?></td>
<td style="text-align:center"><?=$server["ServerPacket"]?></td>
<td style="text-align:center"><?=$server["ServerPluginCon"] ? "Açık" : "Kapalı"?></td>
<td style="text-align:center"><?=$server["ServerFTPCon"] ? "Açık" : "Kapalı" ?></td>
<td style="text-align:center"><?=serverkalanzaman(time(),$server["UserServerPriceTime"])?></td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink($cur_page,"ID=".$server["UserServerID"])?>"><button class="btn btn-success">Seç</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="7" style="text-align:center;"><b>Sunucunuz bulunmamaktadır..</b></td></tr>
<?php endif; ?>
</tbody>
</table>
</div></div></div>