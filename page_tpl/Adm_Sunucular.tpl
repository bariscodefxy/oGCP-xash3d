<div class="row-fluid"><div class="widget widget-padding span12"><div class="widget-header">
<h5>&nbsp;&nbsp;&nbsp;&nbsp;Sunucular</h5>
<div class="widget-buttons"><a href="#" data-title="Gizle/Göster" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
</div></div>  
<div class="widget-body">
<table class="table table-striped">
<thead><tr>
<th style="width:30px;">#</th>
<th style="text-align:center">Adres</th>
<th style="text-align:center">Harita</th>
<th style="text-align:center">Max. Oyuncu</th>
<th style="text-align:center">Makine</th>
<th style="text-align:center">Paket</th>
<th style="text-align:center">Kiralık</th>
<th style="text-align:center">Kaldır</th>
</tr></thead>
<tbody>
<?php if($servers != false): foreach($servers as $server): ?>
<tr>
<td><?=$server["ServerID"]?></td>
<td><a href="<?=$page->CreatePageLink('Adm_Sunucu_Duzenle','ID='.$server["ServerID"])?>"><?=$server["ServerIP"].":".$server["ServerPort"]?></a></td>
<td style="text-align:center"><?=$server["ServerMap"]?></td>
<td style="text-align:center"><?=$server["ServerMaxPlayers"]?></td>
<td><?="[#".$server["ServerMachID"]."] ".$server["MachIP"]?></td>
<td style="text-align:center"><?=$server["ServerPacket"]?></td>
<td><?=$server["UserCount"] == 0 ? "Evet" : "Hayır"?></td>
<td style="text-align:center"><a href="<?=$page->CreatePageLink('Adm_Sunucular','Islem=Sil&ID='.$server["ServerID"])?>"><button class="btn btn-mini btn-danger">Kaldır</button></a></td>
</tr>
<?php endforeach; else: ?>
<tr>
<td style="text-align:center" colspan=3>Bildiriminiz bulunmamaktadır..</td>
</tr>
<?php endif; ?>
</table>
</div></div></div>